<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'id_pedido';

    // Campos permitidos para asignación masiva incluyendo el nuevo codigo
    protected $fillable = [
        'id_usuario',
        'codigo',
        'monto_total',
        'estado_pedido',
        'nombre',
        'id_distrito',
        'direccion',
        'correo',
        'telefono'
    ];

    // Retorna el texto formal sin emojis según el número de estado
    public function getEstadoTextoAttribute()
    {
        $estados = [
            1 => 'Preparación de materiales',
            2 => 'Imprimiendo',
            3 => 'Pedido ya impreso',
            4 => 'Pedido en camino',
            5 => 'Pedido entregado',
        ];

        return $estados[$this->estado_pedido] ?? 'Estado desconocido';
    }

    // Relación con el usuario que realizó la compra
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    // Relación con el desglose de productos del pedido
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido', 'id_pedido');
    }

    // Relación con el distrito de entrega para el delivery
    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'id_distrito', 'id_distrito');
    }
}