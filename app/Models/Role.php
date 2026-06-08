<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    
    // Indicamos la llave primaria exacta
    protected $primaryKey = 'id_rol';

    // Desactivamos los timestamps ya que tu .sql no los incluyó en esta tabla
    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];
}