<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'raza',
        'nombres',
        'sexo',
        'peso',
        'color',
        'enfermedades',
        'alergias',
        'cirugias',
        'nro_partos',
        'esteril',
        'edad',
        'clientes_id',
        'tipo_animals_id'
    ];
}
