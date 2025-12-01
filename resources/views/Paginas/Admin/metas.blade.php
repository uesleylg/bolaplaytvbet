@extends('Layout/Admin/AppAdmin')

@section('title', 'Metas')

@section('content')

<style>
  .stat-card {
    background-color: #1b1f2a;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    transition: .2s;
  }
  .stat-card:hover {
    transform: translateY(-2px);
  }
  .badge-status {
    padding: 6px 12px;
    font-size: 12px;
    border-radius: 8px;
  }
  .badge-ativo { background: #16a34a; }
  .badge-inativo { background: #6b7280; }
</style>

<div class="container-fluid">

  <!-- Cabeçalho -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0 text-white">🎯 Gerenciamento de Metas</h4>


       <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalMeta" data-mode="create">
  <i class="fa-solid fa-plus"></i> Nova Meta
</button>

  </div>

  <!-- Cards -->
  <div class="row g-3 mb-4">

    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Total de Metas</small>
          <h4 class="fw-bold mb-0 text-white">12</h4>
        </div>
        <i class="fa-solid fa-bullseye fa-2x text-primary"></i>
      </div>
    </div>

    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Metas Ativas</small>
          <h4 class="fw-bold text-success mb-0">8</h4>
        </div>
        <i class="fa-solid fa-check-circle fa-2x text-success"></i>
      </div>
    </div>

    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Inativas</small>
          <h4 class="fw-bold text-warning mb-0">4</h4>
        </div>
        <i class="fa-solid fa-clock fa-2x text-warning"></i>
      </div>
    </div>

  </div>



  <!-- ==========================
          FILTROS – IGUAL AO ORIGINAL
       ========================== -->

  <div class="card stat-card p-4 mb-4">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
      <h5 class="fw-bold mb-0 text-white">Lista de Metas</h5>
      <button class="btn btn-outline-secondary btn-sm">
        <i class="fa-solid fa-rotate"></i> Atualizar
      </button>
    </div>

    <!-- Filtros -->
 <form class="row g-3 align-items-end mb-4">

  <!-- Busca -->
  <div class="col-12 col-md-4">
    <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
      <span class="input-group-text bg-dark text-white border-0">
        <i class="fas fa-magnifying-glass"></i>
      </span>
      <input 
        type="text"
        class="form-control border-0 bg-dark text-white"
        placeholder="Buscar por descrição ou nível">
    </div>
  </div>

  <!-- Status -->
  <div class="col-6 col-md-2">
    <select class="form-select bg-dark text-white border-0 shadow-sm" style="border-radius: 10px;">
      <option>Status (todos)</option>
      <option>Ativo</option>
      <option>Inativo</option>
    </select>
  </div>

  <!-- Ordenação -->
  <div class="col-6 col-md-2">
    <select class="form-select bg-dark text-white border-0 shadow-sm" style="border-radius: 10px;">
      <option>Ordenar por</option>
      <option>Nível (menor → maior)</option>
      <option>Nível (maior → menor)</option>
    </select>
  </div>

  <!-- Espaço adicional para completar 12 colunas -->
  <div class="col-6 col-md-2">
    <select class="form-select bg-dark text-white border-0 shadow-sm" style="border-radius: 10px;">
      <option>Filtrar por</option>
      <option>Descrição</option>
      <option>Nível</option>
    </select>
  </div>

  <!-- Botões -->
  <div class="col-6 col-md-2 d-flex gap-2">
    <a href="#" class="btn btn-outline-light flex-fill" style="border-radius: 10px;">
      <i class="fas fa-rotate"></i> Limpar
    </a>

    <button type="submit" class="btn btn-primary flex-fill" style="border-radius: 10px;">
      <i class="fas fa-filter"></i> Aplicar
    </button>
  </div>

</form>


    <!-- ==========================
          TABELA – IGUAL AO CARRINHO
       ========================== -->

    <div class="table-responsive">
      <table class="table table-borderless align-middle mb-0">
        <thead>
          <tr class="text-white">
            <th>ID</th>
            <th>Nível</th>
            <th>Descrição</th>
            <th>Indicados</th>
            <th>Bônus</th>
            <th>Status</th>
            <th>Criado em</th>
            <th class="text-end">Ações</th>
          </tr>
        </thead>

        <tbody>

          <!-- META 1 -->
          <tr class="text-white">
            <td>#1</td>
            <td>1</td>
            <td>Convide 5 amigos depositantes</td>
            <td>5</td>
            <td>R$ 10,00</td>
            <td><span class="badge-status badge-ativo">Ativo</span></td>
            <td>10/01/2025 14:30</td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-secondary me-2">
                <i class="fa-solid fa-pen"></i>
              </button>
              <button class="btn btn-sm btn-outline-danger">
                <i class="fa-solid fa-trash"></i>
              </button>
            </td>
          </tr>

          <!-- META 2 -->
          <tr class="text-white">
            <td>#2</td>
            <td>2</td>
            <td>Convide 10 amigos depositantes</td>
            <td>10</td>
            <td>R$ 25,00</td>
            <td><span class="badge-status badge-inativo">Inativo</span></td>
            <td>11/01/2025 09:10</td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-secondary me-2">
                <i class="fa-solid fa-pen"></i>
              </button>
              <button class="btn btn-sm btn-outline-danger">
                <i class="fa-solid fa-trash"></i>
              </button>
            </td>
          </tr>

          <!-- META 3 -->
          <tr class="text-white">
            <td>#3</td>
            <td>3</td>
            <td>Convide 25 amigos depositantes</td>
            <td>25</td>
            <td>R$ 50,00</td>
            <td><span class="badge-status badge-ativo">Ativo</span></td>
            <td>12/01/2025 16:50</td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-secondary me-2">
                <i class="fa-solid fa-pen"></i>
              </button>
              <button class="btn btn-sm btn-outline-danger">
                <i class="fa-solid fa-trash"></i>
              </button>
            </td>
          </tr>

        </tbody>

      </table>
    </div>

  </div>

</div>
@include('Paginas.Admin.Modal.ModalMeta')
@endsection
