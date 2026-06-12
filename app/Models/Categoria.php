<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- Añadido para soporte de seeders
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Tabla asociada mapeada explícitamente
    protected $table = 'categorias';
    
    // Primary key personalizada de la base de datos
    protected $primaryKey = 'id_categoria';

    // Columnas que se pueden llenar mediante código o formularios
    protected $fillable = [
        'nombre',
    ];

    // Relación: Una categoría tiene muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria', 'id_categoria');
    }
}