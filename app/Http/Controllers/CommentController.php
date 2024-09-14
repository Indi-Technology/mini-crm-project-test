<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Ticket;
use App\Models\TicketLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function save(Request $request)
    {
        $validate = $request->validate([
            'comment' => 'required|min:3',
            'ticket_id' => 'required',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg|max:2048'
        ]);

        $ticket = Ticket::find($validate['ticket_id']);

        if ($ticket->status == "close") {
            return redirect("/tickets/detail/" . $validate['ticket_id'] . "#comment")->with('error', 'Ticket status is closed');
        }

        $comment = Comment::create([
            'comment_text' => $validate['comment'],
            'user_id' => Auth::id(),
            'ticket_id' =>  $validate['ticket_id']
        ]);

        $attachments = $request->file('attachments');


        if ($attachments) {
            foreach ($attachments as $attachment) {
                $path = $attachment->store('comments', 'public');

                $comment->attachments()->create([
                    'file_name' => $attachment->getClientOriginalName(),
                    'file_path' => $path,
                ]);
            }
        }

        TicketLog::create([
            'ticket_id' => $validate['ticket_id'],
            'user_id' => Auth::id(),
            'action' => 'commented'
        ]);

        return redirect("/tickets/detail/" . $validate['ticket_id'] . "#comment")->with('success', 'Comment added');
    }
}
