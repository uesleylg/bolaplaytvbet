<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CarrinhoPalpite;
use App\Models\Pagamento;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;

class PagamentoController extends Controller
{
    public function gerarPix(Request $request)
    {
        $userId = auth()->id();

        $carrinhoIds = $request->input('carrinho_ids');

        if (!is_array($carrinhoIds) || empty($carrinhoIds)) {
            return response()->json(['erro' => 'IDs do carrinho inválidos'], 400);
        }

        $carrinhos = CarrinhoPalpite::whereIn('id', $carrinhoIds)
            ->where('usuario_id', $userId)
            ->get();

        if ($carrinhos->count() !== count($carrinhoIds)) {
            return response()->json(['erro' => 'Carrinhos inválidos ou não pertencem ao usuário'], 403);
        }

        $valorTotal = $carrinhos->sum('valor_total');

        $paymentId = Str::uuid();

        // =============================
        // MERCADO PAGO - GERAR PIX REAL
        // =============================

        MercadoPagoConfig::setAccessToken(env('MP_ACCESS_TOKEN'));

        $client = new PaymentClient();

        $payment = $client->create([
            "transaction_amount" => floatval($valorTotal),
            "description"        => "Pagamento BolaoPlay",
            "payment_method_id"  => "pix",
            "external_reference" => $paymentId,
            "payer" => [
                "email" => auth()->user()->email
            ]
        ]);

        // Respostas do Mercado Pago
        $qrBase64      = $payment->point_of_interaction->transaction_data->qr_code_base64 ?? null;
        $copiaCola     = $payment->point_of_interaction->transaction_data->qr_code ?? null;

        // SALVAR NO BANCO
        $pagamento = Pagamento::create([
            'usuario_id'       => $userId,
            'payment_id'       => $paymentId,
            'status'           => 'pendente',
            'valor'            => $valorTotal,
            'pix_qr_base64'    => $qrBase64,
            'pix_copia_cola'   => $copiaCola,
            'carrinho_ids'     => json_encode($carrinhoIds),
        ]);

        return response()->json([
            'success'       => true,
            'payment_id'    => $paymentId,
            'valor'         => $valorTotal,
            'pagamento_id'  => $pagamento->id,
            'qr'            => $qrBase64,
            'copia_cola'    => $copiaCola
        ]);
    }
}
