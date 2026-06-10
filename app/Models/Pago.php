<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = "pagos";
    protected $primaryKey = 'id_pago'; 
    protected $fillable = ["id_pedido","monto","estado_pago"];
    
    public function pedido(){
        return $this->belongsTo(Pedido::class, "id_pedido","id_pedido");
    }
}
