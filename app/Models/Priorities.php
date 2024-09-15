<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priorities extends Model
{
    use HasFactory;

    protected $table = "priorities";

    protected $primaryKey = 'id_priorities';

    protected $guarded = [];
}
