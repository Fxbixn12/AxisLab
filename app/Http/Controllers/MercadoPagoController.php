<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use App\Models\Pedido;

class MercadoPagoController extends Controller
{
    public function crearPago($id_pedido)
    {
        $pedido = Pedido::findOrFail($id_pedido);

        MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));

        $client = new PreferenceClient();

        $preference = $client->create([
            "items" => [
                [
                    "title" => "Pedido #" . $pedido->id_pedido,
                    "quantity" => 1,
                    "unit_price" => (float) $pedido->monto_total,
                    "currency_id" => "PEN",
                ]
            ],

            "back_urls" => [
                "success" => route('mercadopago.success'),
                "failure" => route('mercadopago.failure'),
                "pending" => route('mercadopago.pending'),
            ],
        ]);

        return redirect($preference->init_point);
    }

    public function success()
    {
        return "Pago exitoso";
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