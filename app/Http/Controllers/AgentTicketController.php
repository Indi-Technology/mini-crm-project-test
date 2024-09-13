<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Label;
use App\Models\Ticket;
use App\Models\TicketLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AgentTicketController extends Controller
{
    public function list()
    {
        $data = [
            'title' => 'Support Tickets',
            'tickets' => Ticket::where('assigned_agent_id', Auth::id())->with(['categories', 'labels'])->orderBy('created_at', 'desc')->paginate(10)
        ];

        return view('agent.tickets.list', $data);
    }
    public function detail($id)
    {
        $ticket = Ticket::with(['categories', 'labels', 'assigned_agent', 'attachments', 'comments' => function ($query) {
            $query->orderBy('created_at', 'asc')->with('user');
        }])->findOrFail($id);

        if ($ticket->assigned_agent_id != Auth::id()) {
            return redirect('/agent/tickets')->with('error', 'You are not authorized for this ticket');
        }

        $data = [
            'title' => 'Support Ticket Detail',
            'ticket' => $ticket
        ];

        return view('agent.tickets.detail', $data);
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

        $ticket_id = $request->ticket_id;

        $ticket = Ticket::find($ticket_id);

        if ($ticket->assigned_agent_id != Auth::id()) {
            return redirect('/agent/tickets')->with('error', 'You are not authorized to update this ticket');
        }

        $ticket->update([
            'title' => $validate['title'],
            'description' => $validate['description'],
            'priority' => $validate['priority'],
            'status' => $validate['status'],

        ]);

        $labels = array_map('intval', $request->labels);
        $categories = array_map('intval', $request->categories);

        $ticket->labels()->sync($labels);
        $ticket->categories()->sync($categories);

        TicketLog::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'action' => 'updated'
        ]);

        return redirect('/agent/tickets')->with('success', 'Ticket successfully updated');
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


        return view('agent.tickets.edit', $data);
    }
    public function changestatus(Request $request)
    {
        $ticket = Ticket::findOrFail($request->id);

        if ($ticket->assigned_agent_id != Auth::id()) {
            return redirect('/agent/tickets')->with('error', 'You are not authorized for this ticket');
        }

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

        TicketLog::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'action' => 'updated'
        ]);

        return redirect('/agent/tickets/detail/' . $ticket->id)->with('success', 'Ticket status successfully changed');
    }
}
