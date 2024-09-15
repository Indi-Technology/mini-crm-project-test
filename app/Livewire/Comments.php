<?php

namespace App\Livewire;

use App\Models\Comments as ModelsComments;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class Comments extends Component
{
    public $comment;
    public $user_id;
    public $ticket_id;
    public $comments_data;

    public function mount($ticket_id)
    {
        $this->user_id = Auth::id();
        $this->ticket_id = $ticket_id;
    }

    public function store()
    {
        $rule = [
            'comment' => 'required',
            'user_id' => 'required',
            'ticket_id' => 'required',
        ];

        $message = [
            'comment.required' => 'comment field cannot be empty'
        ];

        $validation = $this->validate($rule, $message);
        ModelsComments::create($validation);
        // ModelsComments::create([
        //     'user_id' => $this->user_id,
        //     'ticket_id' => $this->ticket_id,
        //     'comment' => $this->comment
        // ]);

        $this->clear();
    }

    public function clear()
    {
        $this->comment = '';
    }

    public function render()
    {
        $this->comments_data = Ticket::find($this->ticket_id)->ticket_comment;
        return view('livewire.comments');
    }
}
