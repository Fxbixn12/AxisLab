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

    // Carga el historial de compras del cliente autenticado asegurando valores exactos sin duplicados
    public function misPedidos()
    {
        $pedidos = Pedido::with(['distrito', 'detalles.producto'])
            ->where('id_usuario', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($pedidos as $pedido) {
            $temporal = [];

            foreach ($pedido->detalles as $detalle) {
                // Generamos una clave única por combinación de pedido y producto
                $idProducto = $detalle->producto ? $detalle->producto->getKey() : 'removido';
                $key = 'pedido_' . $pedido->id_pedido . '_prod_' . $idProducto;

                if (!isset($temporal[$key])) {
                    $itemAgrupado = new \stdClass();
                    $itemAgrupado->nombre_producto = $detalle->producto->nombre ?? 'Producto Removido';
                    $itemAgrupado->imagen_producto = isset($detalle->producto->imagen) ? asset($detalle->producto->imagen) : asset('img/productos/default.jpg');
                    $itemAgrupado->precio_unitario = $detalle->precio_unitario ?? ($detalle->producto->precio ?? 0);
                    
                    // ASIGNACIÓN DIRECTA: Se toma el valor original ignorando sumas repetidas de registros clonados
                    $itemAgrupado->text = $detalle->cantidad; // Mapeado interno por si acaso
                    $itemAgrupado->cantidad = $detalle->cantidad;
                    $itemAgrupado->subtotal = $detalle->subtotal;

                    $temporal[$key] = $itemAgrupado;
                } else {
                    // Si el bucle lee un duplicado que milagrosamente guardó una cantidad mayor, prioriza la más alta
                    if ($detalle->cantidad > $temporal[$key]->cantidad) {
                        $temporal[$key]->cantidad = $detalle->cantidad;
                        $temporal[$key]->subtotal = $detalle->subtotal;
                    }
                }
            }

            // Pasamos las tarjetas limpias de este pedido a la vista Blade
            $pedido->detalles_agrupados = array_values($temporal);
        }

        return view('pedidos-mis-pedidos', compact('pedidos'));
    }
}