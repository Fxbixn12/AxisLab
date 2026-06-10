<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto'; 
    protected $fillable = ['id_categoria','nombre','precio','stock','imagen','descripcion'];

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria','id_categoria');
    }
    
    public function detalle_carrito(){
        return $this->hasMany(DetalleCarrito::class, 'id_producto', 'id_producto');
    }
}
