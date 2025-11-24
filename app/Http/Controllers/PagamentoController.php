<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use App\Models\Bilhete;

class PagamentoController extends Controller
{
    public function gerarPix(Request $request)
    {
        // Recebe os IDs dos bilhetes
        $bilheteIds = $request->bilhetes;

        if (!is_array($bilheteIds) || count($bilheteIds) === 0) {
            return response()->json([
                "status" => "error",
                "message" => "Nenhum bilhete recebido."
            ], 400);
        }

        // Soma o valor total dos bilhetes
        $valorTotal = Bilhete::whereIn('id', $bilheteIds)->sum('valor');

        if ($valorTotal <= 0) {
            return response()->json([
                "status" => "error",
                "message" => "Valor dos bilhetes inválido."
            ], 400);
        }

        // Configura Mercado Pago
        MercadoPagoConfig::setAccessToken(env('MP_ACCESS_TOKEN'));
        $client = new PaymentClient();

        try {
            // Criação do pagamento PIX
            $payment = $client->create([
                "transaction_amount" => (float) $valorTotal,
                "description" => "Pagamento PIX - BolaPlayTV",
                "payment_method_id" => "pix",
                "payer" => [
                    "email" => $request->email ?? "email@cliente.com",
                    "first_name" => $request->nome ?? "Cliente"
                ],
            ]);

            // Salva o ID do pagamento nos bilhetes
            Bilhete::whereIn('id', $bilheteIds)
                ->update([
                    "payment_id" => $payment->id
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
