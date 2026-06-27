<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use App\Models\Pedido;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MercadoPagoController extends Controller
{
    public function crearPago($id_pedido)
    {
        $pedido = Pedido::findOrFail($id_pedido);

        // Aseguramos la carga del token desde el archivo de configuración o .env
        $token = config('services.mercadopago.access_token') ?? env('MERCADO_PAGO_ACCESS_TOKEN');

        MercadoPagoConfig::setAccessToken($token);

        $client = new PreferenceClient();

        // Forzamos el monto total a un flotante limpio de 2 decimales
        $montoFormat = (float) number_format($pedido->monto_total, 2, '.', '');

        try {
            $preference = $client->create([
                "external_reference" => (string) $pedido->id_pedido,

                "items" => [
                    [
                        "title" => "Pedido #" . $pedido->id_pedido,
                        "quantity" => 1,
                        "unit_price" => $montoFormat,
                        "currency_id" => "PEN",
                    ]
                ],

                // Uso de URLs externas para pasar la validación de formato de la API en local
                "back_urls" => [
                    "success" => "https://www.google.com/mercadopago/success",
                    "failure" => "https://www.google.com/mercadopago/failure",
                    "pending" => "https://www.google.com/mercadopago/pending",
                ],
                
                // Sin auto_return para evitar errores de validación de protocolo SSL en desarrollo
            ]);

            return redirect($preference->init_point);

        } catch (\MercadoPago\Exceptions\MPApiException $e) {
            $response = $e->getApiResponse();
            $content = $response->getContent();
            
            $mensajeDetallado = is_array($content) ? json_encode($content, JSON_PRETTY_PRINT) : $content;
            
            return response()->json([
                'error' => 'Error crítico al crear la preferencia en Mercado Pago',
                'detalle_api' => json_decode($mensajeDetallado) ?? $mensajeDetallado
            ], 400);
        }
    }

    public function success(Request $request)
    {
        // Recuperamos el ID del pedido desde la query string devuelta por la pasarela
        $idPedido = $request->query('external_reference');

        if ($idPedido) {
            $pedido = Pedido::find($idPedido);

            if ($pedido) {
                // Usamos una transacción de base de datos para asegurar integridad absoluta
                DB::transaction(function () use ($pedido) {
                    // 1. Actualizamos la fase del pedido a 'Imprimiendo' (estado 2)
                    $pedido->estado_pedido = 2;
                    $pedido->save();

                    // 2. Registramos la auditoría financiera total (Productos + Envío del Distrito)
                    DB::table('pagos')->insert([
                        'id_pedido'   => $pedido->id_pedido,
                        'monto'       => $pedido->monto_total,
                        'estado_pago' => 'pagado',
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);

                    // 3. Recuperamos el desglose de productos desde el carrito de la sesión
                    $carrito = Session::get('carrito', []);

                    foreach ($carrito as $idProducto => $item) {
                        DB::table('detalle_pedido')->insert([
                            'id_pedido'       => $pedido->id_pedido,
                            'id_producto'     => $idProducto,
                            'cantidad'        => $item['qty'], // Sincronizado con la clave utilizada en CatalogoController
                            'precio_unitario' => $item['price'],
                            'subtotal'        => $item['qty'] * $item['price'],
                            'created_at'      => now(),
                            'updated_at'      => now(),
                        ]);
                    }

                    // 4. Limpiamos las tablas del carrito en la base de datos si el usuario está autenticado
                    if (Auth::check()) {
                        $idCarrito = DB::table('carrito')->where('id_usuario', Auth::id())->value('id_carrito');
                        if ($idCarrito) {
                            DB::table('detalle_carrito')->where('id_carrito', $idCarrito)->delete();
                        }
                    }
                });

                // Seteamos las variables en sesión para la vista success.blade.php
                Session::flash('success_code', $pedido->codigo);
                Session::flash('success_total', $pedido->monto_total);
            }
        }

        // Limpiamos el carrito de compras del servidor de forma definitiva
        Session::forget('carrito');

        return redirect()->route('checkout.success');
    }

    public function failure()
    {
        return "Pago fallido";
    }

    public function pending()
    {
        return "Pago pendiente";
    }
}