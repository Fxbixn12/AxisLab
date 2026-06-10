<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = "carrito";
    protected $primaryKey = 'id_carrito';
    protected $fillable = ["id_usuario"];

    public function usuario(){
        return $this->belongsTo(User::class, "id_usuario", "id");
    }
    
    public function detalle_carrito(){
        return $this->hasMany(DetalleCarrito::class,"id_carrito","id_carrito");
    }
}
