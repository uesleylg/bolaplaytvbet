@extends('Layout/Admin/AppAdmin')

@section('title', 'Saques')

@section('content')

<!-- ==========================
     PÁGINA DE SAQUES (ESTÁTICA)
=========================== -->
<div class="container-fluid">

  <!-- Cabeçalho da página -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">💸 Gerenciamento de Saques</h4>

    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalConfigSaque">
      <i class="fa-solid fa-gear me-2"></i> Configurações
    </button>
  </div>

  <!-- Cards -->
  <div class="row g-3 mb-4">

    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Total Solicitado</small>
          <h4 class="fw-bold mb-0">R$ {{ number_format($totalSolicitado, 2, ',', '.') }}</h4>
        </div>
        <i class="fa-solid fa-hand-holding-dollar fa-2x text-primary"></i>
      </div>
    </div>

    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Aprovados</small>
          <h4 class="fw-bold text-success mb-0">R$ {{ number_format($totalAprovado, 2, ',', '.') }}</h4>

        </div>
        <i class="fa-solid fa-circle-check fa-2x text-success"></i>
      </div>
    </div>

    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Pendentes</small>
<h4 class="fw-bold text-warning mb-0">R$ {{ number_format($totalPendente, 2, ',', '.') }}</h4>
        </div>
        <i class="fa-solid fa-hourglass-half fa-2x text-warning"></i>
      </div>
    </div>

  </div>

  <!-- FILTROS -->
 <form method="GET" class="row g-3 align-items-end mb-4">

    <div class="col-12 col-md-4">
      <div class="input-group shadow-sm">
        <span class="input-group-text bg-dark text-white border-0">
          <i class="fas fa-magnifying-glass"></i>
        </span>
        <input type="text" name="busca" value="{{ request('busca') }}" class="form-control bg-dark text-white border-0"
               placeholder="Buscar por usuário ou ID">
      </div>
    </div>

    <div class="col-6 col-md-3">
      <select name="status" class="form-select bg-dark text-white border-0 shadow-sm">
        <option value="">Status</option>
        <option value="Pendente"  {{ request('status')=='Pendente' ? 'selected' : '' }}>Pendentes</option>
        <option value="Aprovado"   {{ request('status')=='Aprovado' ? 'selected' : '' }}>Aprovados</option>
        <option value="Rejeitado"  {{ request('status')=='Rejeitado' ? 'selected' : '' }}>Rejeitados</option>
      </select>
    </div>

    <div class="col-6 col-md-3">
      <select name="periodo" class="form-select bg-dark text-white border-0 shadow-sm">
        <option value="">Recentes</option>
        <option value="hoje"   {{ request('periodo')=='hoje' ? 'selected' : '' }}>Hoje</option>
        <option value="7dias"  {{ request('periodo')=='7dias' ? 'selected' : '' }}>Últimos 7 dias</option>
        <option value="30dias" {{ request('periodo')=='30dias' ? 'selected' : '' }}>Últimos 30 dias</option>
      </select>
    </div>

    <div class="col-6 col-md-2 d-flex gap-2">
      <a href="{{ route('admin.index.saques') }}" class="btn btn-outline-light flex-fill">Limpar</a>
      <button class="btn btn-primary flex-fill">Aplicar</button>
    </div>

</form>


  <!-- TABELA -->
  <div class="card stat-card p-3">

    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2" style="border-color: var(--border-dark) !important;">
      <h5 class="fw-bold mb-0">Lista de Saques</h5>
    </div>

    <div class="table-responsive">
      <table class="table table-borderless align-middle mb-0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Valor</th>
            <th>Método</th>
            <th>Data</th>
            <th>Status</th>
            <th class="text-end">Ações</th>
          </tr>
        </thead>

        <tbody>

         @foreach ($saques as $saque)
<tr>
    <td>#{{ $saque->id }}</td>
    <td>{{ $saque->user->name ?? 'Usuário removido' }}</td>
    <td>R$ {{ number_format($saque->valor, 2, ',', '.') }}</td>
    <td>{{ $saque->metodo }}</td>
    <td>{{ $saque->created_at->format('d/m/Y') }}</td>

    <td>
        @if($saque->status == 'Pendente')
          <span class="badge bg-warning text-dark">Pendente</span>
        @elseif($saque->status == 'Aprovado')
          <span class="badge bg-success">Aprovado</span>
        @else
          <span class="badge bg-danger">Rejeitado</span>
        @endif
    </td>

    <td class="text-end">
        @if($saque->status == 'Pendente')
          <button class="btn btn-sm btn-outline-primary me-2"
                  data-id="{{ $saque->id }}"
                  data-bs-toggle="modal" data-bs-target="#ModalAprovar">
            <i class="fa-solid fa-check"></i>
          </button>

          <button class="btn btn-sm btn-outline-danger"
                  data-id="{{ $saque->id }}"
                  data-bs-toggle="modal" data-bs-target="#ModalAprovar">
            <i class="fa-solid fa-xmark"></i>
          </button>
        @else
          <button class="btn btn-sm btn-outline-secondary" disabled>
            <i class="fa-solid fa-ban"></i>
          </button>
        @endif
    </td>
</tr>
@endforeach


        </tbody>

      </table>
    </div>

  </div>

</div>


<!-- ==========================
     MODAL APROVAR / REJEITAR (ESTÁTICO)
=========================== -->
<div class="modal fade" id="ModalAprovar" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 12px;">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Confirmar Ação</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="mb-0">Tem certeza que deseja aprovar ou rejeitar este saque?</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-danger">Rejeitar</button>
        <button class="btn btn-success">Aprovar</button>
      </div>
    </div>
  </div>
</div>


<!-- ==========================
     MODAL CONFIGURAÇÕES (ESTÁTICO)
=========================== -->
<div class="modal fade" id="ModalConfigSaque" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 12px;">

      <div class="modal-header bg-warning">
        <h5 class="modal-title">Configurações de Saque</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('admin.saques.limite') }}" method="POST">
        @csrf

        <div class="modal-body">

          <label class="form-label fw-semibold">Limite mínimo para saque (R$)</label>

          <input 
              type="number"
              step="0.01"
              name="limite_saque"
              class="form-control"
              value="{{ $limiteSaque }}"
              placeholder="Ex: 50.00"
              required
          >

        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Salvar Configurações</button>
        </div>

      </form>

    </div>
  </div>
</div>


@endsection
