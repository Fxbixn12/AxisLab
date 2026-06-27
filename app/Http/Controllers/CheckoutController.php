<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session; 
use App\Models\Producto;
use App\Models\Distrito; 

class CheckoutController extends Controller
{
    public function index()
    {
        $distritos_metro = Distrito::where('activo', 1)
                                   ->where('zona_tipo', 'Lima Metropolitana')
                                   ->orderBy('nombre')
                                   ->get();

        $distritos_prov = Distrito::where('activo', 1)
                                  ->where('zona_tipo', 'Provincia')
                                  ->orderBy('nombre')
                                  ->get();

        return view('checkout', compact('distritos_metro', 'distritos_prov'));
    }

    // NUEVO MÉTODO: Actualiza el coste en caliente recargando la página sin JS
    public function updateTarifa(Request $request)
    {
        $idDistrito = $request->input('id_distrito');
        $distrito = Distrito::where('id_distrito', $idDistrito)->where('activo', 1)->first();

        if ($distrito) {
            Session::put('checkout_costo_envio', $distrito->precio_envio);
            Session::put('checkout_id_distrito', $idDistrito);
            Session::put('checkout_direccion', $request->input('direccion'));
            Session::put('checkout_telefono', $request->input('telefono'));
        }

        return back()->withInput();
    }

    public function procesar(Request $request)
    {
        $carrito = Session::get('carrito', []);
        
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

            $idPedido = DB::table('pedidos')->insertGetId([
                'id_usuario'    => auth()->id() ?? 1, 
                'monto_total'   => $totalGeneral,     
                'estado_pedido' => 1,
                'nombre'        => $nombre,       
                'id_distrito'   => $idDistrito,   
                'direccion'     => $direccion,    
                'correo'        => $correo,       
                'telefono'      => $telefono,     
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

            // Limpiamos los datos flash temporales al proceder al pago seguro
            Session::forget(['checkout_costo_envio', 'checkout_id_distrito', 'checkout_direccion', 'checkout_telefono']);

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