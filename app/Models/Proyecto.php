<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = [
        'id',   
        'nombre',
        'fecha_inicio',
        'estado',
        'responsable',
        'monto'
    ];
}
