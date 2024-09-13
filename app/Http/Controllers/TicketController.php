<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Label;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    public function list()
    {
        $data = [
            'title' => 'Support Tickets',
            'tickets' => Ticket::with(['categories', 'labels'])->where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10)
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
