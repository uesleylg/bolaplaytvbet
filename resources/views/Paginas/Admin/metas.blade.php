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

    <button class="btn btn-primary"
      data-bs-toggle="modal" 
      data-bs-target="#ModalMeta"
      data-mode="create">
      <i class="fa-solid fa-plus"></i> Nova Meta
    </button>
  </div>

  <!-- Cards -->
  <div class="row g-3 mb-4">

    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Total de Metas</small>
          <h4 class="fw-bold mb-0 text-white">{{ $metas->total() }}</h4>
        </div>
        <i class="fa-solid fa-bullseye fa-2x text-primary"></i>
      </div>
    </div>

    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Metas Ativas</small>
          <h4 class="fw-bold text-success mb-0">
            {{ \App\Models\Meta::where('status','ativo')->count() }}
          </h4>
        </div>
        <i class="fa-solid fa-check-circle fa-2x text-success"></i>
      </div>
    </div>

    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Inativas</small>
          <h4 class="fw-bold text-warning mb-0">
            {{ \App\Models\Meta::where('status','inativo')->count() }}
          </h4>
        </div>
        <i class="fa-solid fa-clock fa-2x text-warning"></i>
      </div>
    </div>

  </div>

  <!-- Card da Lista -->
  <div class="card stat-card p-4 mb-4">

    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
      <h5 class="fw-bold mb-0 text-white">Lista de Metas</h5>

      <a href="{{ route('admin.index.metas') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fa-solid fa-rotate"></i> Atualizar
      </a>
    </div>

   <!-- FILTROS -->
<form method="GET" class="row g-3 mb-4">

  <!-- Busca -->
  <div class="col-12 col-md-4">
    <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
      <span class="input-group-text bg-dark text-white border-0">
        <i class="fas fa-search"></i>
      </span>
      <input
        name="busca"
        value="{{ $busca }}"
        type="text"
        class="form-control border-0 bg-dark text-white"
        placeholder="Buscar por descrição ou título">
    </div>
  </div>

  <!-- Filtro por nível -->
  <div class="col-12 col-md-4">
    <select name="nivel"
      class="form-select bg-dark text-white border-0 shadow-sm"
      style="border-radius: 10px;">
      <option value="">Nível (todos)</option>

      @for($i = 1; $i <= 20; $i++)
        <option value="{{ $i }}" {{ $filtroNivel == $i ? 'selected' : '' }}>
          Nível {{ $i }}
        </option>
      @endfor

    </select>
  </div>

  <!-- Botões -->
  <div class="col-12 col-md-4 d-flex gap-2">
    <a href="{{ route('admin.index.metas') }}"
      class="btn btn-outline-light flex-fill" style="border-radius: 10px;">
      <i class="fas fa-rotate"></i> Limpar
    </a>

    <button type="submit" class="btn btn-primary flex-fill" style="border-radius: 10px;">
      <i class="fas fa-filter"></i> Aplicar
    </button>
  </div>

</form>

    <!-- TABELA -->
    <div class="table-responsive">
      <table class="table table-borderless align-middle mb-0">
        <thead>
          <tr class="text-white">
            <th>ID</th>
            <th>Título</th>
            <th>Nível</th>
            <th>Indicados</th>
            <th>Bônus</th>
            <th>Status</th>
            <th>Criado em</th>
            <th class="text-end">Ações</th>
          </tr>
        </thead>

        <tbody>

          @forelse($metas as $meta)
          <tr class="text-white">

            <td>#{{ $meta->id }}</td>
            <td>{{ $meta->titulo }}</td>
            <td>{{ $meta->nivel }}</td>
            <td>{{ $meta->quantidade_indicados }}</td>
            <td>R$ {{ number_format($meta->bonus_valor, 2, ',', '.') }}</td>

            <td>
              @if($meta->status == 'Ativo')
                <span class="badge-status badge-ativo">Ativo</span>
              @else
                <span class="badge-status badge-inativo">Inativo</span>
              @endif
            </td>

            <td>{{ $meta->created_at->format('d/m/Y H:i') }}</td>

            <td class="text-end">
              <button 
                class="btn btn-sm btn-outline-secondary me-2 editarMeta"
                data-id="{{ $meta->id }}">
                <i class="fa-solid fa-pen"></i>
              </button>

         <button 
    class="btn btn-sm btn-outline-danger btnOpenDeleteModal"
    data-id="{{ $meta->id }}"
    data-name="{{ $meta->titulo }}"
    data-url="{{ route('admin.metas.destroy', $meta->id) }}"
>
    <i class="fa-solid fa-trash"></i>
</button>

            </td>

          </tr>

          @empty

          <tr>
            <td colspan="8" class="text-center text-muted py-4">
              Nenhuma meta encontrada.
            </td>
          </tr>

          @endforelse

        </tbody>
      </table>
    </div>

    <!-- Paginação -->
    <div class="mt-4">
      {{ $metas->links('pagination::bootstrap-5') }}
    </div>

  </div>

</div>
@include('Paginas.Admin.Modal.ModalExclusao')
@include('Paginas.Admin.Modal.ModalMeta')
@endsection
