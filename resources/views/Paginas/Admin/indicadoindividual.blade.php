@extends('Layout/Admin/AppAdmin')

@section('title', 'Afiliado • Indicados')

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
  .badge-pendente { background: #ca8a04; }
  .badge-ativo { background: #16a34a; }
</style>

<div class="container-fluid">

  <!-- Cabeçalho -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0 text-white">
      👤 Afiliado: {{ $user->name }}
    </h4>

    <a href="{{ url()->previous() }}" class="btn btn-outline-light">
      <i class="fa-solid fa-arrow-left"></i> Voltar
    </a>
  </div>

  <!-- Cards resumo -->
  <div class="row g-3 mb-4">

    <div class="col-md-4">
      <div class="stat-card p-3">
        <small class="text-muted">Total de Indicados</small>
        <h4 class="fw-bold text-white mb-0">{{ $indicados->count() }}</h4>
      </div>
    </div>

    <div class="col-md-4">
      <div class="stat-card p-3">
        <small class="text-muted">Indicados Ativos</small>
        <h4 class="fw-bold text-success mb-0">
          {{ $indicados->where('status', 'ativo')->count() }}
        </h4>
      </div>
    </div>

    <div class="col-md-4">
      <div class="stat-card p-3">
        <small class="text-muted">Pendentes</small>
        <h4 class="fw-bold text-warning mb-0">
          {{ $indicados->where('status', 'pendente')->count() }}
        </h4>
      </div>
    </div>

  </div>

  <!-- Lista -->
  <div class="card stat-card p-4">

    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
      <h5 class="fw-bold mb-0 text-white">
        👥 Pessoas Indicadas
      </h5>
    </div>

    <!-- Filtros -->
    <form class="row g-3 mb-4 align-items-end">

      <div class="col-md-4">
        <div class="input-group">
          <span class="input-group-text bg-dark text-white border-0">
            <i class="fas fa-search"></i>
          </span>
          <input type="text" class="form-control bg-dark text-white border-0"
                 placeholder="Buscar nome ou email">
        </div>
      </div>

      <div class="col-md-4">
        <select class="form-select bg-dark text-white border-0">
          <option>Status (todos)</option>
          <option>Pendente</option>
          <option>Ativo</option>
        </select>
      </div>

      <div class="col-md-4 d-flex gap-2">
        <button class="btn btn-outline-light w-50">
          <i class="fas fa-rotate"></i> Limpar
        </button>

        <button class="btn btn-primary w-50">
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
            <th>Nome</th>
            <th>Email</th>
            <th>Registro</th>
            <th>Última compra</th>
            <th>Compras</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($indicados as $afi)
          <tr class="text-white">
            <td>#{{ $afi->id }}</td>
            <td>{{ $afi->indicado->name ?? $afi->nome ?? '—' }}</td>
            <td>{{ $afi->indicado->email ?? $afi->email ?? '—' }}</td>
            <td>{{ $afi->created_at->format('d/m/Y') }}</td>
            <td>{{ $afi->ultima_compra ? $afi->ultima_compra->format('d/m/Y') : '-' }}</td>
            <td>{{ $afi->compras ?? 0 }}</td>
            <td>
              <span class="badge-status {{ $afi->status == 'ativo' ? 'badge-ativo' : 'badge-pendente' }}">
                {{ ucfirst($afi->status) }}
              </span>
            </td>
  
          </tr>
          @endforeach
        </tbody>

      </table>
    </div>

  </div>

</div>
@endsection
