<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketLog;
use Illuminate\Http\Request;

class AdminTicketLogController extends Controller
{
    public function list()
    {
        $data = [
            'title' => 'Ticket Logs',
            'tickets' => Ticket::with(['categories', 'labels'])->orderBy('created_at', 'desc')->paginate(10)
        ];


        return view('admin.logs.list', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Ticket Logs',
            'ticket' => Ticket::orderBy('created_at', 'asc')->with(['logs' => function ($query) {
                $query->with('user');
            }, 'user', 'assigned_agent'])->findOrFail($id)
        ];

        return view('admin.logs.detail', $data);
    }
}
