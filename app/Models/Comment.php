<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'tickets_id', 'user_id'];

    public function ticket()
    {
        return $this->belongsTo(Tickets::class, 'tickets_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
