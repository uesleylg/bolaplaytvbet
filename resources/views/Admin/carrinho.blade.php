@extends('Layout/Admin/AppAdmin')

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



<!-- ==========================
     FILTROS MODERNOS 2025
========================== -->



  <!-- ==========================
       FIM DO FILTRO NOVO
     ========================== -->


<!-- Tabela de Carrinhos com Filtro -->
<div class="card stat-card p-4 mb-4" style="background-color: #1b1f2a; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">

  <!-- Cabeçalho -->
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2" style="border-color: var(--border-dark) !important;">
    <h5 class="fw-bold mb-0 text-white">Lista de Carrinhos</h5>
    <div>
      <button class="btn btn-outline-secondary btn-sm me-2">
        <i class="fa-solid fa-rotate"></i> Atualizar
      </button>
     
    </div>
  </div>

  <!-- Formulário de Filtro -->
  <form class="row g-3 align-items-end mb-4">

    <!-- Busca -->
    <div class="col-12 col-md-4">
      <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
        <span class="input-group-text bg-dark text-white border-0">
          <i class="fas fa-magnifying-glass"></i>
        </span>
        <input type="text" class="form-control border-0 bg-dark text-white" placeholder="Buscar por ID ou usuário" style="border-radius: 0;">
      </div>
    </div>

    <!-- Status -->
    <div class="col-6 col-md-2">
      <select class="form-select bg-dark text-white border-0 shadow-sm" style="border-radius: 10px;">
        <option selected>Status (todos)</option>
        <option>Pendente</option>
        <option>Pago</option>
        <option>Cancelado</option>
      </select>
    </div>

    <!-- Rodada -->
    <div class="col-6 col-md-2">
      <select class="form-select bg-dark text-white border-0 shadow-sm" style="border-radius: 10px;">
        <option selected>Rodada (todas)</option>
        <option>Rodada 1</option>
        <option>Rodada 2</option>
        <option>Rodada 3</option>
      </select>
    </div>

    <!-- Recentes -->
    <div class="col-6 col-md-2">
      <select class="form-select bg-dark text-white border-0 shadow-sm" style="border-radius: 10px;">
        <option selected>Recentes</option>
        <option>Hoje</option>
        <option>Últimos 7 dias</option>
        <option>Últimos 30 dias</option>
      </select>
    </div>

    <!-- Botões -->
    <div class="col-6 col-md-2 d-flex gap-2">
      <button type="button" class="btn btn-outline-light flex-fill" style="border-radius: 10px; transition: 0.3s;">
        <i class="fas fa-rotate"></i> Limpar
      </button>
      <button type="button" class="btn btn-primary flex-fill" style="border-radius: 10px; transition: 0.3s;">
        <i class="fas fa-filter"></i> Aplicar
      </button>
    </div>

  </form>

  <!-- Tabela -->
  <div class="table-responsive">
    <table class="table table-borderless align-middle mb-0">
      <thead>
        <tr class="text-white">
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
        <tr class="text-white">
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
              data-valor="{{ $carrinho->valor_total }}">
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
