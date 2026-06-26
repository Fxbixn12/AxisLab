<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class AdminPedidoController extends Controller
{
    // Listado general de pedidos para el administrador
    public function index()
    {
        $pedidos = Pedido::with(['usuario', 'distrito'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin-pedidos', compact('pedidos'));
    }

    // Actualiza la fase del pedido validando el rango del flujo (1 al 5)
    public function updateEstado(Request $request, $id_pedido)
    {
        $request->validate([
            'estado_pedido' => 'required|integer|between:1,5',
        ]);

        $pedido = Pedido::findOrFail($id_pedido);
        
        $pedido->update([
            'estado_pedido' => $request->input('estado_pedido')
        ]);

        return redirect()->route('admin.pedidos.index')
            ->with('success', 'El pedido #' . $pedido->id_pedido . ' ahora se encuentra en: ' . $pedido->estado_texto);
    }

    // Detalle completo del pedido para control interno y despacho
    public function show($id_pedido)
    {
        $pedido = Pedido::with(['usuario', 'distrito', 'detalles.producto'])->findOrFail($id_pedido);
        
        return view('admin-pedidos-detalle', compact('pedido'));
    }

    // Carga el historial de compras del cliente autenticado
    public function misPedidos()
    {
        $pedidos = Pedido::with(['distrito', 'detalles.producto'])
            ->where('id_usuario', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pedidos-mis-pedidos', compact('pedidos'));
    }
}