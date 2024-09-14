<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function userdashboard()
    {
        $data = [
            'title' => 'Dashboard',
            'ticket_total' => Ticket::where(['user_id' => Auth::id()])->count()
        ];

        return view("user.dashboard", $data);
    }

    public function admindashboard()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'ticket_status' => [
                'open' => Ticket::where([
                    'status' => 'open'
                ])->count(),
                'close' => Ticket::where([
                    'status' => 'close'
                ])->count(),
                'unassigned_agent' => Ticket::where([
                    'status' => 'open',
                    'assigned_agent_id' => null
                ])->count(),
            ],
            'ticket_priorities' => [
                'low' => Ticket::where([
                    'status' => 'open',
                    'priority' => 'low'
                ])->count(),
                'normal' => Ticket::where([
                    'status' => 'open',
                    'priority' => 'normal'
                ])->count(),
                'high' => Ticket::where([
                    'status' => 'open',
                    'priority' => 'high'
                ])->count(),
                'urgent' => Ticket::where([
                    'status' => 'open',
                    'priority' => 'urgent'
                ])->count()
            ]
        ];

        return view("admin.dashboard", $data);
    }

    public function agentdashboard()
    {
        $data = [
            'title' => 'Agent Dashboard',
            'ticket_total' => Ticket::where(['assigned_agent_id' => Auth::id()])->count()
        ];

        return view("agent.dashboard", $data);
    }
}
