<?php

namespace App\Http\Controllers;

use App\Models\Labels;
use App\Models\Tickets;
use App\Models\Categories;
use App\Models\Priorities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketsAgentController extends Controller
{
    private function checkAgentRole()
    {
        if (!Auth::check() || Auth::user()->role !== 'agent') {
            abort(403, 'Unauthorized action.');
        }
    }

    public function index()
    {
        $this->checkAgentRole();

        $user = Auth::user();
        $tickets = Tickets::where('assign_user', $user->id)
            ->orWhereNull('assign_user')
            ->oldest()
            ->get();

        return view('agent.tickets-agent.index', ['data' => $tickets]);
    }

    public function show(Tickets $ticket)
    {
        //
    }

    public function edit(Tickets $ticket)
    {
        $this->checkAgentRole();

        // Debug information
        Log::info('Ticket assign_user: ' . $ticket->assign_user);
        Log::info('Current user ID: ' . Auth::id());

        if ($ticket->assign_user && $ticket->assign_user != Auth::id()) {
            abort(403, 'Unauthorized access to this ticket.');
        }

        $labels = Labels::all();
        $categories = Categories::all();
        $priorities = Priorities::all();

        return view('agent.tickets.edit', compact('ticket', 'labels', 'categories', 'priorities'));
    }

    public function update(Request $request, Tickets $ticket)
    {
        $this->checkAgentRole();

        // Debug information
        Log::info('Ticket assign_user: ' . $ticket->assign_user);
        Log::info('Current user ID: ' . Auth::id());

        // Cek apakah user yang membuat tiket sama dengan user yang sedang login
        if ($ticket->assign_user && $ticket->assign_user != Auth::id()) {
            abort(403, 'Unauthorized access to this ticket.');
        }

        // Validasi data
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'id_label' => 'required|integer',
            'id_categories' => 'required|integer',
            'id_priorities' => 'required|integer',
            'status' => 'required|in:open,close',
            'attachment' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update data tiket
        $ticket->title = $request->input('title');
        $ticket->message = $request->input('message');
        $ticket->id_label = $request->input('id_label');
        $ticket->id_categories = $request->input('id_categories');
        $ticket->id_priorities = $request->input('id_priorities');
        $ticket->status = $request->input('status');

        // Handle file upload
        if ($request->hasFile('attachment')) {
            // Hapus file lama jika ada
            if ($ticket->attachment) {
                Storage::disk('public')->delete('images/' . $ticket->attachment);
            }

            $attachment = $request->file('attachment');
            $attachmentPath = $attachment->store('images', 'public');
            $ticket->attachment = basename($attachmentPath);
        }

        // Simpan perubahan
        $ticket->save();

        // Redirect dengan pesan sukses
        return redirect()->route('agent.tickets.index')->with('success', 'Ticket updated successfully!');
    }
}
