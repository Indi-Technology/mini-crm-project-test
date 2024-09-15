<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Log;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($comment) {
            Log::create([
                'ticket_id' => $comment->ticket_id,
                'user_id' => auth()->id(),
                'action' => 'created comment',
            ]);
        });

        static::updated(function ($comment) {
            Log::create([
                'ticket_id' => $comment->ticket_id,
                'user_id' => auth()->id(),
                'action' => 'updated comment',
            ]);
        });

        static::deleting(function ($comment) {
            $comment->attachments()->each(function ($attachment) {
                $attachment->delete();
            });
        });
    }
}
