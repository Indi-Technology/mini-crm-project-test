<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


        return redirect('/agent/tickets/detail/' . $ticket->id)->with('success', 'Ticket status successfully changed');
    }
}
