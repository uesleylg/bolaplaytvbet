@extends('Layout/Admin/AppAdmin')

@section('title', 'Dashboard Afiliados')

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
  .badge-vip { background: #2563eb; }
</style>

<div class="container-fluid">

  <!-- Cabeçalho -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0 text-white">👥 Gerenciamento de Afiliados</h4>

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAfiliado">
      <i class="fa-solid fa-user-plus"></i> Novo Afiliado
    </button>
  </div>

  <!-- Cards -->
  <div class="row g-3 mb-4">

    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Total de Afiliados</small>
          <h4 class="fw-bold mb-0 text-white">154</h4>
        </div>
        <i class="fa-solid fa-users fa-2x text-primary"></i>
      </div>
    </div>

    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Afiliados Ativos</small>
          <h4 class="fw-bold text-success mb-0">112</h4>
        </div>
        <i class="fa-solid fa-circle-check fa-2x text-success"></i>
      </div>
    </div>

    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Afiliados Inativos</small>
          <h4 class="fw-bold text-warning mb-0">42</h4>
        </div>
        <i class="fa-solid fa-circle-exclamation fa-2x text-warning"></i>
      </div>
    </div>

  </div>

  <!-- Lista + Filtros -->
  <div class="card stat-card p-4 mb-4">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
      <h5 class="fw-bold mb-0 text-white">Lista de Afiliados</h5>
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
            placeholder="Buscar por nome, código ou email">
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

      <!-- Ordem -->
      <div class="col-6 col-md-2">
        <select class="form-select bg-dark text-white border-0 shadow-sm" style="border-radius: 10px;">
          <option>Ordenar por</option>
          <option>Mais Referidos</option>
          <option>Menos Referidos</option>
        </select>
      </div>

      <!-- Tipo -->
      <div class="col-6 col-md-2">
        <select class="form-select bg-dark text-white border-0 shadow-sm" style="border-radius: 10px;">
          <option>Tipo</option>
          <option>Comum</option>
          <option>VIP</option>
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

    <!-- Tabela -->
    <div class="table-responsive">
      <table class="table table-borderless align-middle mb-0">
        <thead>
          <tr class="text-white">
            <th>ID</th>
            <th>Afiliado</th>
            <th>Email</th>
            <th>Indicados</th>
            <th>Comissão Total</th>
            <th>Status</th>
            <th>Criado em</th>
            <th class="text-end">Ações</th>
          </tr>
        </thead>

        <tbody>

          <!-- Afiliado 1 -->
          <tr class="text-white">
            <td>#1</td>
            <td>João Mendes</td>
            <td>joao@example.com</td>
            <td>58</td>
            <td>R$ 945,00</td>
            <td><span class="badge-status badge-ativo">Ativo</span></td>
            <td>05/01/2025 10:22</td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-secondary me-2">
                <i class="fa-solid fa-eye"></i>
              </button>
              <button class="btn btn-sm btn-outline-danger">
                <i class="fa-solid fa-trash"></i>
              </button>
            </td>
          </tr>

          <!-- Afiliado 2 -->
          <tr class="text-white">
            <td>#2</td>
            <td>Maria Silva</td>
            <td>maria@example.com</td>
            <td>21</td>
            <td>R$ 280,00</td>
            <td><span class="badge-status badge-inativo">Inativo</span></td>
            <td>03/01/2025 18:50</td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-secondary me-2">
                <i class="fa-solid fa-eye"></i>
              </button>
              <button class="btn btn-sm btn-outline-danger">
                <i class="fa-solid fa-trash"></i>
              </button>
            </td>
          </tr>

          <!-- Afiliado 3 -->
          <tr class="text-white">
            <td>#3</td>
            <td>Carlos Nogueira</td>
            <td>carlos@example.com</td>
            <td>103</td>
            <td>R$ 1750,00</td>
            <td><span class="badge-status badge-ativo">Ativo</span></td>
            <td>02/01/2025 14:10</td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-secondary me-2">
                <i class="fa-solid fa-eye"></i>
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


@endsection