<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session; 
use App\Models\Producto;
use App\Models\Distrito; 

class CheckoutController extends Controller
{
    /**
     * Muestra la vista del checkout con los distritos agrupados
     */
    public function index()
    {
        // Recuperamos los registros activos desde la BD mapeando la columna 'zona_tipo'
        $distritos_metro = Distrito::where('activo', 1)
                                   ->where('zona_tipo', 'Metropolitana')
                                   ->get();

        $distritos_prov = Distrito::where('activo', 1)
                                  ->where('zona_tipo', 'Provincia')
                                  ->get();

        // Enviamos las variables exactas que la vista Blade espera recibir
        return view('checkout', compact('distritos_metro', 'distritos_prov'));
    }

    /**
     * Procesa el formulario de despacho y registra la compra
     */
    public function procesar(Request $request)
    {
        $carrito = Session::get('carrito', []);
        
        // 🔥 CORREGIDO: Validación de los datos del formulario de despacho
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'id_distrito' => 'required|integer',
            'direccion'   => 'required|string|max:255',
            'correo'      => 'required|email|max:255',
            'telefono'    => 'required|string|max:20',
        ]);

        $nombre = $request->input('nombre');
        $idDistrito = $request->input('id_distrito'); 
        $direccion = $request->input('direccion');
        $correo = $request->input('correo');
        $telefono = $request->input('telefono');
        
        if (empty($carrito)) {
            return redirect()->route('carrito')->with('error', 'Tu carrito está vacío. No podemos procesar el despacho.');
        }

        $distrito = Distrito::where('id_distrito', $idDistrito)->where('activo', 1)->first();

        if (!$distrito) {
            return back()->with('error', 'El distrito seleccionado no es válido o no se encuentra disponible.');
        }

        $costoEnvio = $distrito->precio_envio;

        DB::beginTransaction();

        try {
            $totalProductos = 0;
            foreach ($carrito as $id_producto => $item) {
                $producto = Producto::where('id_producto', $id_producto)->first(); 
                
                if (!$producto || $producto->stock < $item['qty']) {
                    DB::rollBack();
                    return back()->with('error', "No hay stock suficiente para el artículo: " . ($producto->nombre ?? 'Desconocido'));
                }
                $totalProductos += $producto->precio * $item['qty'];
            }

            $totalGeneral = $totalProductos + $costoEnvio;

            // 🔥 CORREGIDO: Ahora el registro guarda la información de a dónde y a quién enviar
            // (Verifica que los nombres de las columnas coincidan con tu tabla 'pedidos')
            $idPedido = DB::table('pedidos')->insertGetId([
                'id_usuario'    => auth()->id() ?? 1, 
                'monto_total'   => $totalGeneral,     
                'estado_pedido' => 'proceso',
                'nombre'        => $nombre,       // Mapeado
                'id_distrito'   => $idDistrito,   // Mapeado
                'direccion'     => $direccion,    // Mapeado
                'correo'        => $correo,       // Mapeado
                'telefono'      => $telefono,     // Mapeado
                'created_at'    => now(), 
                'updated_at'    => now()
            ]);

            foreach ($carrito as $id_producto => $item) {
                $producto = Producto::where('id_producto', $id_producto)->first();

                DB::table('detalle_pedido')->insert([
                    'id_pedido'       => $idPedido,
                    'id_producto'     => $producto->id_producto,
                    'cantidad'        => $item['qty'],            
                    'precio_unitario' => $producto->precio,
                    'subtotal'        => $producto->precio * $item['qty'], 
                    'created_at'      => now(),
                    'updated_at'      => now()
                ]);

                $producto->decrement('stock', $item['qty']);
            }

            DB::commit();

            return redirect('/pagar/' . $idPedido);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error crítico en el checkout: ' . $e->getMessage());
        }
    }

    public function exito()
    {
        return view('success');
    }
}