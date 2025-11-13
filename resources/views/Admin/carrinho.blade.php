@extends('Layout/AppAdmin')

@section('title', 'Carrinhos de Apostas')

@section('content')


<div class="container-fluid">

  <!-- Cabeçalho da página -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">🎟️ Gerenciamento de Carrinhos</h4>
  
  </div>

  <!-- Cards de estatísticas -->
  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Total de Carrinhos</small>
          <h4 class="fw-bold mb-0">{{ $totalCarrinhos ?? 0 }}</h4>
        </div>
        <i class="fa-solid fa-layer-group fa-2x text-primary"></i>
      </div>
    </div>
    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Pendentes</small>
          <h4 class="fw-bold text-warning mb-0">{{ $totalPendentes ?? 0 }}</h4>
        </div>
        <i class="fa-solid fa-clock fa-2x text-warning"></i>
      </div>
    </div>
    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Pagos</small>
          <h4 class="fw-bold text-success mb-0">{{ $totalPagos ?? 0 }}</h4>
        </div>
        <i class="fa-solid fa-check-circle fa-2x text-success"></i>
      </div>
    </div>
  </div>

  <!-- Tabela de Carrinhos -->
  <div class="card stat-card p-3">
    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2" style="border-color: var(--border-dark) !important;">
      <h5 class="fw-bold mb-0">Lista de Carrinhos</h5>
      <div>
        <button class="btn btn-outline-secondary btn-sm me-2">
          <i class="fa-solid fa-rotate"></i> Atualizar
        </button>
        <button class="btn btn-outline-secondary btn-sm">
          <i class="fa-solid fa-filter"></i> Filtros
        </button>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-borderless align-middle mb-0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Rodada</th>
            <th>Qtd. Bilhetes</th>
            <th>Valor Total</th>
            <th>Status</th>
            <th>Criado em</th>
            <th class="text-end">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($carrinhos as $carrinho)
          <tr>
            <td>#{{ $carrinho->id }}</td>
            <td>{{ $carrinho->usuario->name ?? '—' }}</td>
            <td>{{ $carrinho->rodada->nome ?? '—' }}</td>
            <td>{{ $carrinho->quantidade_bilhetes }}</td>
            <td>R$ {{ number_format($carrinho->valor_total, 2, ',', '.') }}</td>
            <td>
              @if ($carrinho->status === 'pendente')
                <span class="badge bg-warning text-dark">Pendente</span>
              @elseif ($carrinho->status === 'pago')
                <span class="badge bg-success">Pago</span>
              @elseif ($carrinho->status === 'cancelado')
                <span class="badge bg-danger">Cancelado</span>
              @else
                <span class="badge bg-secondary">{{ ucfirst($carrinho->status) }}</span>
              @endif
            </td>
            <td>{{ $carrinho->created_at->format('d/m/Y H:i') }}</td>
            <td class="text-end">

              <!-- Editar -->
<button 
  class="btn btn-sm btn-outline-secondary me-2 btn-edit-carrinho"
  title="Editar"
  data-bs-toggle="modal"
  data-bs-target="#ModalCarrinho"
  data-id="{{ $carrinho->id }}"
  data-usuario_nome="{{ $carrinho->usuario->name }}"
  data-rodada_nome="{{ $carrinho->rodada->nome }}"
  data-status="{{ $carrinho->status }}"
  data-combinacoes="{{ $carrinho->combinacoes_compactadas }}"
  data-valor="{{ $carrinho->valor_total }}"
>
  <i class="fa-solid fa-pen"></i>
</button>


              <!-- Excluir -->
              <button 
                data-bs-toggle="modal"
                data-bs-target="#ModalConfirmDelete"
                class="btn btn-sm btn-outline-danger btn-delete-carrinho" 
                title="Excluir"
                data-id="{{ $carrinho->id }}" 
                data-nome="Carrinho #{{ $carrinho->id }}">
                <i class="fa-solid fa-trash"></i>
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- ==========================
     FIM DA PÁGINA DE CARRINHOS
=========================== -->
@include('Admin.Modal.ModalDeleteCarrinho')
@include('Admin.Modal.ModalCarrinho')

@endsection
