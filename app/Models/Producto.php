<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- Añadido para soporte de seeders
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Tabla asociada mapeada explícitamente
    protected $table = 'productos';
    
    // Primary key personalizada de la base de datos
    protected $primaryKey = 'id_producto';

    // Columnas habilitadas para inserción masiva desde el AdminController
    protected $fillable = [
        'id_categoria',
        'nombre',
        'precio',
        'stock',
        'imagen',
        'descripcion',
    ];

    // Relación: Un producto pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }
}