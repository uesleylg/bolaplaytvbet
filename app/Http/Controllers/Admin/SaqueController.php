<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Saque;
use App\Models\User;
use App\Models\Configuracao;

class SaqueController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');
        $status = $request->input('status');
        $periodo = $request->input('periodo');

        $query = Saque::with('user');

        if ($busca) {
            $query->where(function ($q) use ($busca) {
                $q->where('id', 'LIKE', "%$busca%")
                  ->orWhereHas('user', function ($userQuery) use ($busca) {
                      $userQuery->where('name', 'LIKE', "%$busca%");
                  });
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($periodo == 'hoje') {
            $query->whereDate('created_at', today());
        } elseif ($periodo == '7dias') {
            $query->whereDate('created_at', '>=', now()->subDays(7));
        } elseif ($periodo == '30dias') {
            $query->whereDate('created_at', '>=', now()->subDays(30));
        }

        $saques = $query->orderBy('id', 'DESC')->paginate(20);

        // Estatísticas
        $totalSolicitado = Saque::sum('valor');
        $totalAprovado   = Saque::where('status', 'Aprovado')->sum('valor');
        $totalPendente   = Saque::where('status', 'Pendente')->sum('valor');

        // PEGAR LIMITE SALVO
        $limiteSaque = Configuracao::get('limite_saque', 0);

        return view('Paginas.Admin.saques', compact(
            'saques',
            'totalSolicitado',
            'totalAprovado',
            'totalPendente',
            'limiteSaque'
        ));
    }


    public function validarSaque(Request $request, $id)
{
    $request->validate([
        'acao' => 'required|in:aprovar,rejeitar',
    ]);

    $saque = Saque::findOrFail($id);

    if ($saque->status !== 'pendente') {
        return back()->with('error', 'Este saque já foi processado.');
    }

    $saque->status = $request->acao === 'aprovar'
        ? 'aprovado'
        : 'rejeitado';

    $saque->save();

    return back()->with('success', 'Saque processado com sucesso!');
}


    // 🔥 SALVAR LIMITE DO MODAL
    public function salvarLimite(Request $request)
    {
        $request->validate([
            'limite_saque' => 'required|numeric|min:0',
        ]);

        Configuracao::updateOrCreate(
            ['chave' => 'limite_saque'],
            ['valor' => $request->limite_saque]
        );

        return back()->with('success', 'Limite de saque atualizado com sucesso!');
    }
}
