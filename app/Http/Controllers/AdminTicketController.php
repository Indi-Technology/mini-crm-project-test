<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Label;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminTicketController extends Controller
{
    public function list()
    {
        $data = [
            'title' => 'Support Tickets',
            'tickets' => Ticket::with(['categories', 'labels'])->orderBy('created_at', 'desc')->paginate(10)
        ];

        return view('admin.tickets.list', $data);
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Tickets',
            'ticket' => Ticket::with(['categories', 'labels', 'assigned_agent', 'user'])->findOrFail($id),
            'labels' => Label::orderBy('label_name', 'asc')->get(),
            'categories' => Category::orderBy('category_name', 'asc')->get(),
            'agents' => User::where(['role' => 'agent'])->orderBy('id', 'asc')->get()
        ];


        return view('admin.tickets.edit', $data);
    }
    public function detail($id)
    {
        $ticket = Ticket::with(['categories', 'labels', 'assigned_agent', 'attachments', 'comments' => function ($query) {
            $query->orderBy('created_at', 'asc')->with('user');
        }])->findOrFail($id);

        $data = [
            'title' => 'Support Ticket Detail',
            'ticket' => $ticket
        ];

        return view('admin.tickets.detail', $data);
    }
    public function update(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|min:5',
            'description' => 'required',
            'labels' => 'required|array|min:1',
            'categories' => 'required|array|min:1',
            'priority' => [
                'required',
                Rule::in(['low', 'normal', 'high', 'urgent'])
            ],
            'status' => ['required', Rule::in(['open', 'close'])]
        ]);



        $agent = User::find($request->assigned_agent);
        $ticket_id = $request->ticket_id;


        if ($agent && $agent->role != 'agent') {
            return redirect('/admin/tickets/edit/' . $ticket_id)->with('error', 'You assign user with role other than agent');
        }

        $ticket = Ticket::find($ticket_id);

        if ($agent) {
            $data = [
                'title' => $validate['title'],
                'description' => $validate['description'],
                'priority' => $validate['priority'],
                'assigned_agent_id' => $request->assigned_agent,
                'status' => $validate['status'],
            ];
        } else {
            $data = [
                'title' => $validate['title'],
                'description' => $validate['description'],
                'priority' => $validate['priority'],
                'status' => $validate['status'],

            ];
        }

        $ticket->update($data);

        $labels = [];
        foreach ($request->labels as $label) {
            array_push($labels, [
                'ticket_id' => $ticket_id,
                'label_id' => (int)$label
            ]);
        }

        $categories = [];
        foreach ($request->categories as $category) {
            array_push($categories, [
                'ticket_id' => $ticket_id,
                'category_id' => (int)$category
            ]);
        }

        $ticket->labels()->sync($labels);
        $ticket->categories()->sync($categories);

        return redirect('/admin/tickets')->with('success', 'Ticket successfully updated');
    }
    public function delete(Request $request)
    {
        $id = $request->id;

        Ticket::where('id', $id)->delete();

        return redirect("/admin/tickets")->with('success', "Ticket Successfully Deleted");
    }
    public function changestatus(Request $request)
    {
        $ticket = Ticket::findOrFail($request->id);

        $current_status = $ticket->status;

        if ($current_status == "open") {
            $data = [
                'status' => 'close'
            ];
        } else {
            $data = [
                'status' => 'open'
            ];
        }

        $ticket->update($data);


        return redirect('/admin/tickets/detail/' . $ticket->id)->with('success', 'Ticket status successfully changed');
    }
}
