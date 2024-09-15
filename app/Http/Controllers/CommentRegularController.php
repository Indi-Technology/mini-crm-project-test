<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment; // Pastikan model Comment di-import
use Illuminate\Support\Facades\Auth; // Untuk mengambil user yang sedang login

class CommentRegularController extends Controller
{
    /**
     * Store a newly created comment in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $ticketId)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        Comment::create([
            'comment' => $request->input('comment'),
            'ticket_id' => $ticketId,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('tickets.show', $ticketId)->with('success', 'Comment added successfully.');
    }
}
