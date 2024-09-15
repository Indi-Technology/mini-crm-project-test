<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
        'attachment_file',
        'users_id',
        'assigned_to'
    ];

    public function tiket_label()
    {
        return $this->belongsToMany(Labels::class, 'ticket_label')->withTimestamps();
    }
    public function tiket_category()
    {
        return $this->belongsToMany(Categories::class, 'ticket_category', 'ticket_id', 'category_id')->withTimestamps();
    }
    public function ticket_user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function ticket_comment()
    {
        return $this->hasMany(Comments::class);
    }
}
