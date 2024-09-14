<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Label;
use App\Models\Ticket;
use App\Models\TicketLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    public function list(Request $request)
    {
        $selected_category = $request->query('category');
        $selected_priority = $request->query('priority');
        $selected_status = $request->query('status');

        $query = Ticket::with(['categories', 'labels'])->where('user_id', Auth::id());


        if ($selected_category) {
            $query->whereHas('categories', function ($category) use ($selected_category) {
                $category->where('category_id', $selected_category);
            });
        }

        if ($selected_priority && in_array($selected_priority, ['low', 'normal', 'high', 'urgent'])) {
            $query->where('priority', $selected_priority);
        }

        if ($selected_status && in_array($selected_status, ['open', 'close'])) {
            $query->where('status', $selected_status);
        }

        $data = [
            'title' => 'Support Tickets',
            'tickets' => $query->orderBy('created_at', 'desc')->paginate(10),
            'categories' => Category::orderBy('category_name', 'asc')->get(),
            'selected_category' => $selected_category,
            'selected_priority' => $selected_priority,
            'selected_status' => $selected_status
        ];

        return view('user.tickets.list', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Create Support Ticket',
            'labels' => Label::orderBy('label_name', 'asc')->get(),
            'categories' => Category::orderBy('category_name', 'asc')->get()
        ];


        return view('user.tickets.create', $data);
    }
    public function save(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|min:5',
            'description' => 'required',
            'labels' => 'required|array|min:1',
            'categories' => 'required|array|min:1',
            'priority' => ['required', Rule::in(['low', 'normal', 'high', 'urgent'])],
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg|max:2048'
        ]);


        $ticket = Ticket::create([
            'title' => $validate['title'],
            'description' => $validate['description'],
            'status' => 'open',
            'priority' => $validate['priority'],
            'user_id' => Auth::id(),
        ]);

        $ticketId = $ticket->id;

        $labels = [];
        foreach ($request->labels as $label) {
            array_push($labels, [
                'ticket_id' => $ticketId,
                'label_id' => (int)$label
            ]);
        }

        $categories = [];
        foreach ($request->categories as $category) {
            array_push($categories, [
                'ticket_id' => $ticketId,
                'category_id' => (int)$category
            ]);
        }

        $attachments = $request->file('attachments');

        if ($attachments) {
            foreach ($attachments as $attachment) {
                $path = $attachment->store('tickets', 'public');

                $ticket->attachments()->create([
                    'file_name' => $attachment->getClientOriginalName(),
                    'file_path' => $path,
                ]);
            }
        }



        $ticket->labels()->attach($labels);
        $ticket->categories()->attach($categories);

        TicketLog::create([
            'ticket_id' => $ticketId,
            'user_id' => Auth::id(),
            'action' => 'created'
        ]);

        return redirect('/tickets')->with('success', 'Ticket successfully created');
    }

    public function detail($id)
    {
        $ticket = Ticket::with(['categories', 'labels', 'assigned_agent', 'attachments', 'comments' => function ($query) {
            $query->orderBy('created_at', 'asc')->with('user');
        }])->findOrFail($id);


        if ($ticket->user_id != Auth::id()) {
            return redirect('/tickets')->with('error', "You are not authorized to access this ticket");
        }

        $data = [
            'title' => 'Support Ticket Detail',
            'ticket' => $ticket
        ];

        return view('user.tickets.detail', $data);
    }
}
