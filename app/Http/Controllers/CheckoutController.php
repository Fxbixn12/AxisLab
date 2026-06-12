<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session; // Manejo del carrito de compras mediante sesiones del servidor
use App\Models\Producto;

class CheckoutController extends Controller
{
    /**
     * Procesa el formulario de despacho y registra la compra en la base de datos
     */
    public function procesar(Request $request)
    {
        // Recibo los datos enviados desde mi formulario POST del checkout
        $carrito = Session::get('carrito', []);
        $nombre = $request->input('nombre');
        $tipoEnvio = $request->input('tipo_envio');
        $direccion = $request->input('direccion');
        $correo = $request->input('correo');
        $telefono = $request->input('telefono');
        
        // Validación de seguridad por si el carrito se vacía antes de procesar
        if (empty($carrito)) {
            return redirect()->route('carrito')->with('error', 'Tu carrito está vacío. No podemos procesar el despacho.');
        }

        // Calculo el costo de envío en el backend según la opción seleccionada
        $costoEnvio = 0;
        if ($tipoEnvio === 'lima_metro') {
            $costoEnvio = 7.00;
        } elseif ($tipoEnvio === 'lima_prov') {
            $costoEnvio = 15.00;
        }

        // Inicio una transacción ACID para asegurar que se guarden la cabecera y el detalle correctamente
        DB::beginTransaction();

        try {
            // Calculo el total acumulado validando los precios y el stock real en la base de datos
            $totalProductos = 0;
            foreach ($carrito as $id_producto => $item) {
                // Busco el producto por su clave primaria personalizada
                $producto = Producto::where('id_producto', $id_producto)->first(); 
                
                // Si el producto no existe o no tiene stock suficiente, cancelo la operación
                if (!$producto || $producto->stock < $item['qty']) {
                    DB::rollBack();
                    return back()->with('error', "No hay stock suficiente para el artículo: " . ($producto->nombre ?? 'Desconocido'));
                }
                $totalProductos += $producto->precio * $item['qty'];
            }

            $totalGeneral = $totalProductos + $costoEnvio;

            // Inserto la cabecera haciendo match con las columnas reales de mi tabla 'pedidos'
            $idPedido = DB::table('pedidos')->insertGetId([
                'id_usuario'    => auth()->id() ?? 1, // Vinculo al usuario logueado o asigno el de respaldo
                'monto_total'   => $totalGeneral,     // CORREGIDO: En mi BD se llama monto_total
                'estado_pedido' => 'proceso',         // CORREGIDO: Uso el valor 'proceso' de mi ENUM estructural
                'created_at'    => now(), 
                'updated_at'    => now()
            ]);

            // Recorro mi carrito para registrar el detalle de la venta y actualizar el inventario
            foreach ($carrito as $id_producto => $item) {
                $producto = Producto::where('id_producto', $id_producto)->first();

                // Inserto cada fila haciendo match con las columnas reales de mi tabla 'detalle_pedido'
                DB::table('detalle_pedido')->insert([
                    'id_pedido'       => $idPedido,
                    'id_producto'     => $producto->id_producto,
                    'cantidad'        => $item['qty'],             // CORREGIDO: Se llama cantidad en mi tabla
                    'precio_unitario' => $producto->precio,
                    'subtotal'        => $producto->precio * $item['qty'], // Asigno el cálculo directo al subtotal
                    'created_at'      => now(),
                    'updated_at'      => now()
                ]);

                // Descuento el stock del producto directamente en el servidor
                $producto->decrement('stock', $item['qty']);
            }

            // Si todas las inserciones SQL fueron exitosas, confirmo los cambios en la base de datos
            DB::commit();

            // SOLUCIÓN: Redirijo usando la URL directa en PHP para evitar fallos si el name de la ruta de Fabián cambia
            return redirect('/pagar/' . $idPedido);

        } catch (\Exception $e) {
            // Si ocurre cualquier error, restauro el estado anterior para evitar datos huérfanos o corruptos
            DB::rollBack();
            return back()->with('error', 'Error crítico en el checkout: ' . $e->getMessage());
        }
    }

    /**
     * Renderiza mi vista de agradecimiento tras la confirmación de la pasarela
     */
    public function exito()
    {
        return view('success');
    }
}