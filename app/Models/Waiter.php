<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waiter extends Model
{
    protected $table = "waiters";

    protected $fillable = [
        'id_location',
        'name'
    ];
}
