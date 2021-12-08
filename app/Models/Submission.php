<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = "submissions";

    protected $fillable = [
        'cliente_nombre',
        'cliente_email',
        'cliente_telefono',
        'responses->enabled'
    ];

    protected $casts = [
        'responses' => 'array'
    ];
}
