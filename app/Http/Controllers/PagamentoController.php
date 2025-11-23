<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;

class PagamentoController extends Controller
{
    public function gerarPix(Request $request)
    {
        // Configurar o token secreto do Mercado Pago
        MercadoPagoConfig::setAccessToken(env('MP_ACCESS_TOKEN'));

        $client = new PaymentClient();

        try {
            // Criar o pagamento PIX
            $payment = $client->create([
                "transaction_amount" => (float) $request->valor ?? 5.00,
                "description" => "Pagamento PIX - BolaPlayTV",
                "payment_method_id" => "pix",
                "payer" => [
                    "email" => $request->email ?? "email@email.com",
                    "first_name" => $request->nome ?? "Cliente"
                ],
            ]);

            return response()->json([
                "status" => "success",
                "id" => $payment->id,
                "qr_code" => $payment->point_of_interaction->transaction_data->qr_code,
                "qr_code_base64" => $payment->point_of_interaction->transaction_data->qr_code_base64,
                "copia_cola" => $payment->point_of_interaction->transaction_data->qr_code,
                "status_pagamento" => $payment->status
            ]);

        } catch (MPApiException $e) {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage()
            ], 400);
        }
    }
}
