<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'asunto',
        'fecha_agenda',
        'animals_id',
        'medico_id',
        'servicio_id'
    ];

}
