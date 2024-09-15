<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Log;


class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($ticket) {
            Log::create([
                'ticket_id' => $ticket->id,
                'user_id' => auth()->id(),
                'action' => 'created',
            ]);
        });

        static::updated(function ($ticket) {
            Log::create([
                'ticket_id' => $ticket->id,
                'user_id' => auth()->id(),
                'action' => 'updated',
            ]);
        });

        static::deleting(function ($ticket) {
            $ticket->comments()->each(function ($comment) {
                $comment->delete();
            });
        });
    }
}