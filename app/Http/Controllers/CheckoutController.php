<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

class CheckoutController extends Controller
{
    public function procesar(Request $request)
    {
        // 1. Recibimos la información empaquetada del JSON
        $items = $request->input('items');
        $direccion = $request->input('direccion');
        $telefono = $request->input('telefono');
        
        if (empty($items)) {
            return response()->json(['success' => false, 'message' => 'El carrito está vacío.']);
        }

        // 2. Iniciamos una transacción para asegurar que se guarde todo o nada
        DB::beginTransaction();

        try {
            // Calcular el total real sumando los precios desde la BD (por seguridad)
            $totalGeneral = 0;
            foreach ($items as $item) {
                // Buscamos el producto por su ID real en MySQL
                $producto = Producto::find($item['id']); 
                if (!$producto || $producto->stock < $item['quantity']) {
                    return response()->json([
                        'success' => false, 
                        'message' => "Stock insuficiente o producto no encontrado: " . ($producto->nombre ?? 'ID ' . $item['id'])
                    ]);
                }
                $totalGeneral += $producto->precio * $item['quantity'];
            }

            // 3. Insertar la cabecera en la tabla 'pedidos' (usamos el usuario logueado o un ID simulado si no hay auth)
            $idPedido = DB::table('pedidos')->insertGetId([
                'id_usuario' => auth()->id() ?? 1, // Si no hay login, usa el usuario de prueba 1
                'fecha' => now(),
                'total' => $totalGeneral,
                'estado' => 'Pendiente',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // 4. Insertar cada fila en la tabla 'detalle_pedidos' y restar el stock
            foreach ($items as $item) {
                $producto = Producto::find($item['id']);

                DB::table('detalle_pedidos')->insert([
                    'id_pedido' => $idPedido,
                    'id_producto' => $producto->id_producto,
                    'cantidad' => $item['quantity'],
                    'precio_unitario' => $producto->precio,
                ]);

                // Restamos el stock correspondiente en el almacén
                $producto->decrement('stock', $item['quantity']);
            }

            // Si todo salió bien, guardamos los cambios definitivamente en MySQL
            DB::commit();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            // Si algo falla, revertimos todo para no dejar datos corruptos
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Muestra la vista de éxito tras completar la compra
    public function exito()
    {
        return view('success');
    }
}