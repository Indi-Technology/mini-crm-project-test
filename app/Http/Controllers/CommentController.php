<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'ticket_id' => 'required|exists:tickets,id',
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'mimes:pdf,jpeg,png,jpg', 'max:2048']
        ]);

        $comment = Comment::create([
            'body' => $request->body,
            'ticket_id' => $request->ticket_id,
            'user_id' => auth()->id(),
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $originalName = pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $attachment->getClientOriginalExtension();
                $uniqueName = $originalName . '_' . Str::uuid() . '.' . $extension;
                $path = $attachment->storeAs('attachments', $uniqueName, 'public');
                $comment->attachments()->create([
                    'file_path' => $path,
                    'original_name' => $originalName,
                    'extension' => $extension,
                    'size' => $attachment->getSize(),
                ]);
            }
        }

        return back()->with('message', 'Comment added successfully');
    }
}
