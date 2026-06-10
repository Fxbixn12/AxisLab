<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    protected $table = "envios";
    protected $primaryKey = 'id_envio'; 
    protected $fillable = ["id_pedido","direccion","tipo_envio","estado_envio","fecha_envio","fecha_entrega"];
    
    public function pedido(){
        return $this->belongsTo(Pedido::class,"id_pedido","id_pedido");
    }
}
