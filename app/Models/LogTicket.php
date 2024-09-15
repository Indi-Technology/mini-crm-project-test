<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogTicket extends Model
{
    use HasFactory;

    protected $table = 'ticket_log';

    protected $fillable = [
        'ticket_title',
        'ticket_priority',
        'ticket_status',
        'action',
        'updated_by',
        'updater_name',
    ];
}
