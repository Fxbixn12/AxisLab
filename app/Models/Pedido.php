<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = "pedidos";
    protected $primaryKey = 'id_pedido';
    protected $fillable = ['id_usuario','monto_total','estado_pedido'];

    public function usuario(){
        return $this->belongsTo(User::class,'id_usuario','id');
    }
    public function detalle_pedido(){
        return $this->hasMany(DetallePedido::class,"id_pedido","id_pedido");
    }
    public function pago(){
        return $this->hasOne(Pago::class,"id_pedido","id_pedido");
    }
    public function envio(){
        return $this->hasOne(Envio::class,"id_pedido","id_pedido");
    }
}
