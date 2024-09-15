<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Label;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'agent') {
            $ticket = Ticket::where('agent_id', auth()->id());
            $open = $ticket->where('status', 'open')->count();
        } elseif (auth()->user()->role === 'user') {
            $ticket = Ticket::where('user_id', auth()->id());
            $open = $ticket->where('status', 'open')->count();

        } else {
            $ticket = Ticket::query();
            $open = Ticket::where('status', 'open')->count();
        }
        // $data = [
        //     'tickets' => Ticket::count(),
        //     'labels' => Label::count(),
        //     'categories' => Category::count(),
        //     'users' => User::count(),
        //     'unassigned' => Ticket::whereNull('agent_id')->count(),
        //     'assigned' => Ticket::whereNotNull('agent_id')->count(),
        //     'open' => Ticket::where('status', 'open')->count(),
        //     'closed' => Ticket::where('status', 'closed')->count(),
        // ];
        $data = [
            'tickets' => $ticket->count(),
            'labels' => Label::count(),
            'categories' => Category::count(),
            'users' => User::count(),
            'unassigned' => Ticket::whereNull('agent_id')->count(),
            'assigned' => Ticket::whereNotNull('agent_id')->count(),
            'open' => $open,
            'closed' => Ticket::where('status', 'closed')->count(),
        ];
        return view('dashboard', compact('data'));
    }
}