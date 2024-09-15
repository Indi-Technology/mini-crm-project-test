<?php

namespace App\Models;

use App\Models\User;
use App\Models\Labels;
use App\Models\Categories;
use App\Models\Priorities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tickets extends Model
{

    use HasFactory;

    protected $table = "tickets";

    protected $primaryKey = 'id_tickets';

    protected $guarded = [];

    public function labels()
    {
        return $this->belongsTo(Labels::class, 'id_label');
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'id_categories');
    }

    public function priorities()
    {
        return $this->belongsTo(Priorities::class, 'id_priorities');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignedAgent()
    {
        return $this->belongsTo(User::class, 'assign_user');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'tickets_id');
    }
}
