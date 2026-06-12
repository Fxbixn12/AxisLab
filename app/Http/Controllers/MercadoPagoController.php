<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Manejo de sesiones para limpiar mi carrito en el servidor
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use App\Models\Pedido;

class MercadoPagoController extends Controller
{
    /**
     * Inicializa la transacción y genera el enlace de la pasarela de Mercado Pago
     */
    public function crearPago($id_pedido)
    {
        // Busco el pedido en mi base de datos por su ID único
        $pedido = Pedido::findOrFail($id_pedido);

        // Access Token directo
        $tokenReal = "APP_USR-7661828497929777-061212-8f5779c7e71e097ff9c543051fdaa3c0-3470154742";
        MercadoPagoConfig::setAccessToken($tokenReal);

        // Inicializo el cliente de preferencias
        $client = new PreferenceClient();

        // Forzamos que sea un float puro sin intermediarios
        $precioFinal = (float) $pedido->monto_total;

        // Construyo la preferencia con los campos mínimos obligatorios del API
        $preference = $client->create([
            "items" => [
                [
                    "title"       => "Compra AxisLab", // Nombre genérico corto sin caracteres especiales
                    "quantity"    => 1,
                    "unit_price"  => $precioFinal,
                    "currency_id" => "PEN",
                ]
            ],
            "back_urls" => [
                "success" => url('/mercadopago/success'),
                "failure" => url('/mercadopago/failure'),
                "pending" => url('/mercadopago/pending'),
            ],
            "auto_return" => "approved",
        ]);

        // Redirijo de forma síncrona
        return redirect($preference->init_point);
    }

    /**
     * Retorno exitoso: Se ejecuta cuando la pasarela confirma el cobro
     */
    public function success()
    {
        // Limpio el carrito de la sesión de mi servidor ya que la venta ha sido pagada de verdad
        Session::forget('carrito');

        // Renderizo de forma síncrona mi vista física de éxito inyectándole el mensaje del servidor
        return view('success')->with('success_order', 'Tu pedido ha sido pagado y procesado de manera conforme.');
    }

    /**
     * Retorno fallido: Se ejecuta si la tarjeta es rechazada o el cliente cancela
     */
    public function failure()
    {
        return "Pago fallido";
    }

    /**
     * Retorno pendiente: Se ejecuta si el pago queda en verificación (efectivo/agentes)
     */
    public function pending()
    {
        return "Pago pendiente";
    }
}