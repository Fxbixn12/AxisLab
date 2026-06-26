<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use App\Models\Pedido;
use Illuminate\Support\Facades\Session;

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

                // Usamos URLs con HTTPS falso para pasar la validación inicial de formato de la API
                "back_urls" => [
                    "success" => "https://www.google.com/mercadopago/success",
                    "failure" => "https://www.google.com/mercadopago/failure",
                    "pending" => "https://www.google.com/mercadopago/pending",
                ],
                
                // Removemos el auto_return para evitar el error 400 en entornos locales de desarrollo
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
                // Seteamos las variables en sesión para la vista success.blade.php
                Session::flash('success_code', $pedido->codigo);
                Session::flash('success_total', $pedido->monto_total);
            }
        }

        // Limpiamos el carrito de compras del servidor
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