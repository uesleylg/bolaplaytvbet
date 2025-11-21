@extends('Layout/Admin/AppAdmin')


@section('title', 'BolaPlay Bet')

@section('content')
    <style>
        body {
            background: #0d1117;
            color: #e5e7eb;
        }

        .page-title {
            font-size: 1.6rem;
            font-weight: 600;
            color: #f1f5f9;
        }

        .card-log {
            background: #161b22;
            border: 1px solid #1f2937;
            border-radius: 10px;
        }

        .table-dark-custom {
            background-color: #0d1117;
            color: #e5e7eb;
        }

        .table-dark-custom thead {
            background: #111827;
        }

        .table-dark-custom tbody tr:hover {
            background: #1f2937;
            transition: 0.2s;
        }

        .badge-log {
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
        }

        .badge-info { background: #2563eb; }
        .badge-success { background: #059669; }
        .badge-warning { background: #eab308; color: #000; }
        .badge-danger { background: #dc2626; }
    </style>


    <!-- Título -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title"><i class="fa-solid fa-clipboard-list"></i> Logs do Sistema</h2>
        <button class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-rotate-right"></i> Atualizar
        </button>
    </div>

    <!-- Filtros -->
  <form action="{{ route('admin.index.logs') }}" method="GET">
    <div class="card card-log p-3 mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control bg-dark text-light" 
                       placeholder="Pesquisar por usuário, IP, ação..."
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <select name="tipo" class="form-select bg-dark text-light">
                    <option value="">Tipo de Log</option>
                    <option value="Login" {{ request('tipo') == 'Login' ? 'selected' : '' }}>Login</option>
                    <option value="Cadastro" {{ request('tipo') == 'Cadastro' ? 'selected' : '' }}>Cadastro</option>
                    <option value="Reset de Senha" {{ request('tipo') == 'Reset de Senha' ? 'selected' : '' }}>Reset de Senha</option>
                    <option value="Erro Backend" {{ request('tipo') == 'Erro Backend' ? 'selected' : '' }}>Erro Backend</option>
                </select>
            </div>

            <div class="col-md-3">
                <select name="ordenar" class="form-select bg-dark text-light">
                    <option value="">Ordenar por</option>
                    <option value="recente" {{ request('ordenar') == 'recente' ? 'selected' : '' }}>Mais Recentes</option>
                    <option value="antigo" {{ request('ordenar') == 'antigo' ? 'selected' : '' }}>Mais Antigos</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    <i class="fa-solid fa-magnifying-glass"></i> Filtrar
                </button>
            </div>
        </div>
    </div>
</form>


    <!-- Tabela -->
    <div class="card card-log p-3">
        <div class="d-flex justify-content-end gap-2">
 

    <button class="btn btn-outline-danger">
        <i class="fa-solid fa-file-pdf"></i> Baixar PDF
    </button>
</div>

        <div class="table-responsive">
          <table class="table table-borderless align-middle mb-0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Ação</th>
            <th>Tipo</th>
            <th>IP</th>
            <th>Dispositivo</th>
            <th>Data</th>
        </tr>
    </thead>

    <tbody>

        @forelse ($logs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->usuario }}</td>
                <td>{{ $log->acao }}</td>

                <td>
                    @php
                        $badgeClasses = [
                            'Login' => 'bg-primary',
                            'Cadastro' => 'bg-success',
                            'Falha' => 'bg-secondary',
                            'Erro Backend' => 'bg-danger',
                            'Reset de Senha' => 'bg-warning text-dark',
                            'Atualização' => 'bg-info',
                            'Exclusão' => 'bg-dark',
                            'Sistema' => 'bg-danger'
                        ];
                    @endphp

                    <span class="badge {{ $badgeClasses[$log->tipo] ?? 'bg-secondary' }}">
                        {{ $log->tipo }}
                    </span>
                </td>

                <td>{{ $log->ip }}</td>

                <td>
                    {{ $log->dispositivo !== '-' ? $log->dispositivo : '-' }}
                </td>

                <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
            </tr>

        @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-3">
                    Nenhum log encontrado.
                </td>
            </tr>
        @endforelse

    </tbody>
</table>
<div class="mt-3">
    <p class="text-muted mb-0">
        Mostrando {{ $logs->firstItem() }} até {{ $logs->lastItem() }} de {{ $logs->total() }} resultados
    </p>

    {{ $logs->links('pagination::bootstrap-5') }}
</div>



        </div>
    </div>


@endsection