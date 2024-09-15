<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    public function ticket_categories(): HasMany
    {
        return $this->hasMany(TicketCategory::class);
    }

    public function ticket_labels(): HasMany
    {
        return $this->hasMany(TicketLabel::class);
    }

    public function activity_logs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function user_regular(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_regular_id');
    }

    public function user_agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_agent_id');
    }
}
