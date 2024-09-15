<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labels extends Model
{
    use HasFactory;

    protected $table = 'labels_list';

    protected $fillable = [
        'label_name',
    ];

    public function tiket()
    {
        return $this->belongsToMany(Ticket::class, 'ticket_label')->withTimestamps();
    }
}
