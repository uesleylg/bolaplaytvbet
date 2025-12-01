@extends('Layout/Admin/AppAdmin')

@section('title', 'Carteira do Usuário')

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
  .badge-type {
    padding: 6px 12px;
    font-size: 12px;
    border-radius: 8px;
  }
  .badge-deposito { background: #16a34a; }
  .badge-saque { background: #dc2626; }
  .badge-bonus { background: #3b82f6; }
  .badge-ajuste { background: #eab308; }
</style>

<div class="container-fluid">

  <!-- Cabeçalho -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0 text-white">
      💰 Carteira — {{ $usuario->nome ?? 'Nome do Usuário' }}
    </h4>

    <button 
      class="btn btn-primary"
      data-bs-toggle="modal"
      data-bs-target="#ModalAjuste"
    >
      <i class="fa-solid fa-plus"></i> Ajustar Saldo
    </button>
  </div>

  <!-- ==========================
        CARDS DE ESTATÍSTICAS
      ========================== -->

  <div class="row g-3 mb-4">

    <div class="col-md-3">
      <div class="stat-card p-3">
        <small class="text-muted">Saldo Atual</small>
        <h3 class="fw-bold text-white mb-0">R$ 152,00</h3>
      </div>
    </div>

    <div class="col-md-3">
      <div class="stat-card p-3">
        <small class="text-muted">Total Depositado</small>
        <h4 class="fw-bold text-success mb-0">R$ 850,00</h4>
      </div>
    </div>

    <div class="col-md-3">
      <div class="stat-card p-3">
        <small class="text-muted">Total Sacado</small>
        <h4 class="fw-bold text-danger mb-0">R$ 300,00</h4>
      </div>
    </div>

    <div class="col-md-3">
      <div class="stat-card p-3">
        <small class="text-muted">Bônus Recebidos</small>
        <h4 class="fw-bold text-primary mb-0">R$ 120,00</h4>
      </div>
    </div>

  </div>



  <!-- ==========================
        FILTROS
      ========================== -->
  <div class="card stat-card p-4 mb-4">

    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
      <h5 class="fw-bold mb-0 text-white">Extrato da Carteira</h5>

      <button class="btn btn-outline-secondary btn-sm">
        <i class="fa-solid fa-rotate"></i> Atualizar
      </button>
    </div>

    <form class="row g-3 align-items-end mb-4">

      <div class="col-12 col-md-4">
        <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
          <span class="input-group-text bg-dark text-white border-0">
            <i class="fas fa-magnifying-glass"></i>
          </span>
          <input 
            type="text"
            class="form-control bg-dark border-0 text-white"
            placeholder="Buscar por tipo, valor ou descrição">
        </div>
      </div>

      <div class="col-6 col-md-3">
        <select class="form-select bg-dark text-white border-0 shadow-sm" style="border-radius: 10px;">
          <option>Tipo (todos)</option>
          <option>Depósito</option>
          <option>Saque</option>
          <option>Bônus</option>
          <option>Ajuste Manual</option>
        </select>
      </div>

      <div class="col-6 col-md-3">
        <input
          type="date"
          class="form-control bg-dark text-white border-0 shadow-sm"
          style="border-radius: 10px;"
        >
      </div>

      <div class="col-6 col-md-2 d-flex gap-2">
        <a href="#" class="btn btn-outline-light flex-fill" style="border-radius: 10px;">
          <i class="fas fa-rotate"></i> Limpar
        </a>

        <button class="btn btn-primary flex-fill" style="border-radius: 10px;">
          <i class="fas fa-filter"></i> Aplicar
        </button>
      </div>

    </form>



    <!-- ==========================
          TABELA DE EXTRATO
      ========================== -->
    <div class="table-responsive">
      <table class="table table-borderless align-middle mb-0">
        <thead>
          <tr class="text-white">
            <th>ID</th>
            <th>Tipo</th>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Saldo Antes</th>
            <th>Saldo Depois</th>
            <th>Data</th>
          </tr>
        </thead>

        <tbody>

          <tr class="text-white">
            <td>#151</td>
            <td><span class="badge-type badge-deposito">Depósito</span></td>
            <td>PIX aprovado</td>
            <td class="text-success fw-bold">+ R$ 100,00</td>
            <td>R$ 52,00</td>
            <td>R$ 152,00</td>
            <td>27/11/2025 12:40</td>
          </tr>

          <tr class="text-white">
            <td>#148</td>
            <td><span class="badge-type badge-saque">Saque</span></td>
            <td>Saque manual</td>
            <td class="text-danger fw-bold">- R$ 50,00</td>
            <td>R$ 102,00</td>
            <td>R$ 52,00</td>
            <td>26/11/2025 19:15</td>
          </tr>

          <tr class="text-white">
            <td>#142</td>
            <td><span class="badge-type badge-bonus">Bônus</span></td>
            <td>Bônus do afiliado</td>
            <td class="text-primary fw-bold">+ R$ 20,00</td>
            <td>R$ 82,00</td>
            <td>R$ 102,00</td>
            <td>25/11/2025 17:22</td>
          </tr>

        </tbody>
      </table>
    </div>

  </div>

</div>



@endsection
