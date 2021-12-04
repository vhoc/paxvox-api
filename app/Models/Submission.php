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
        'nombre_mesero',
        'frecuencia_visita',
        'atencion_mesero',
        'rapidez_servicio',
        'calidad_comida',
        'experiencia_general'
    ];
}
