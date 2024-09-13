<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'priority',
        'user_id',
        'assigned_agent_id',
        'status'
    ];

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(TicketLog::class, "ticket_id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function assigned_agent(): BelongsTo
    {
        return $this->belongsTo(User::class, "assigned_agent_id", "id");
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'ticket_category');
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'ticket_label');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, "ticket_id");
    }
}
