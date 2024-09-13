<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCommentController extends Controller
{
    public function save(Request $request)
    {
        $validate = $request->validate([
            'comment' => 'required|min:3',
            'ticket_id' => 'required',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg|max:2048'
        ]);

        $comment = Comment::create([
            'comment_text' => $validate['comment'],
            'user_id' => Auth::id(),
            'ticket_id' =>  $validate['ticket_id']
        ]);

        $attachments = $request->file('attachments');


        if ($attachments) {
            foreach ($attachments as $attachment) {
                $path = $attachment->store('attachments', 'public');

                $comment->attachments()->create([
                    'file_name' => $attachment->getClientOriginalName(),
                    'file_path' => $path,
                ]);
            }
        }

        return redirect("/admin/tickets/detail/" . $validate['ticket_id'] . "#comment")->with('success', 'Comment added');
    }
}
