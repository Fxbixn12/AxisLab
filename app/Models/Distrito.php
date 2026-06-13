<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    // Le decimos a Laravel el nombre exacto de la tabla
    protected $table = 'distritos';

    // Especificamos la clave primaria personalizada
    protected $primaryKey = 'id_distrito';

    // Los campos que permitiremos llenar en masa (útil para el futuro CRUD)
    protected $fillable = [
        'nombre',
        'precio_envio',
        'zona_tipo',
        'activo'
    ];
}