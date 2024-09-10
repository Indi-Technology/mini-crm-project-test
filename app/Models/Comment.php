<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_text',
        'ticket_id',
        'user_id',
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
