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

  </div>

  <!-- Cards -->
  <div class="row g-3 mb-4">

    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Total de Afiliados</small>
          <h4 class="fw-bold mb-0 text-white">{{ $afiliados->count() }}</h4>
        </div>
        <i class="fa-solid fa-users fa-2x text-primary"></i>
      </div>
    </div>

    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Total de Indicados</small>
          <h4 class="fw-bold text-success mb-0">{{ $afiliados->sum('total_indicados') }}</h4>
        </div>
        <i class="fa-solid fa-people-arrows fa-2x text-success"></i>
      </div>
    </div>

<div class="col-md-4">
  <div class="stat-card p-3 d-flex justify-content-between align-items-center">
    <div>
      <small class="text-muted">Indicação Valida</small>
      <h4 class="fw-bold text-warning mb-0">
        {{ $totalPessoasIndicadas }}
      </h4>
    </div>
    <i class="fa-solid fa-user-check fa-2x text-success"></i>

  </div>
</div>


  </div>

  <!-- Lista -->
  <div class="card stat-card p-4 mb-4">

    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
      <h5 class="fw-bold mb-0 text-white">Lista de Afiliados</h5>
    </div>
 <!-- FILTROS -->
<form method="GET" class="row g-3 mb-4 align-items-end">

  <!-- Busca -->
  <div class="col-12 col-md-3">
    <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
      <span class="input-group-text bg-dark text-white border-0">
        <i class="fas fa-search"></i>
      </span>
      <input
        name="busca"
        value="{{ $busca }}"
        type="text"
        class="form-control border-0 bg-dark text-white"
        placeholder="Buscar nome, ID ou email">
    </div>
  </div>

  <!-- Filtro: Indicação -->
  <div class="col-12 col-md-3">
    <select 
      name="indicacao"
      class="form-select bg-dark text-white border-0 shadow-sm"
      style="border-radius: 10px;"
    >
      <option value="">Indicação (todos)</option>
      <option value="com" {{ $filtroIndicacao == 'com' ? 'selected' : '' }}>Com indicados</option>
      <option value="sem" {{ $filtroIndicacao == 'sem' ? 'selected' : '' }}>Sem indicados</option>
    </select>
  </div>

  <!-- Filtro: Nível -->
  <div class="col-12 col-md-3">
    <select 
      name="nivel"
      class="form-select bg-dark text-white border-0 shadow-sm"
      style="border-radius: 10px;"
    >
      <option value="">Nível (todos)</option>

      @for ($i = 1; $i <= 20; $i++)
        <option value="{{ $i }}" {{ $filtroNivel == $i ? 'selected' : '' }}>
          {{ $i }} indicado(s)
        </option>
      @endfor
    </select>
  </div>

  <!-- Botões -->
  <div class="col-12 col-md-3 d-flex gap-2">
    <a href="{{ route('admin.index.afiliados') }}"
      class="btn btn-outline-light w-50"
      style="border-radius: 10px;">
      <i class="fas fa-rotate"></i> Limpar
    </a>

    <button type="submit"
      class="btn btn-primary w-50"
      style="border-radius: 10px;">
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
    
            <th style="text-align: center;"> Indicados</th>
              <th style="text-align: center;"> Validos</th>
       
           
            <th class="text-end">Ações</th>
          </tr>
        </thead>

        <tbody>
        @forelse($afiliados as $afi)
          <tr class="text-white">
            <td>#{{ $afi->id }}</td>
            <td>{{ $afi->name }}</td>
            <td>{{ $afi->email }}</td>
     
        <td style="text-align: center;">{{ $afi->total_indicados }}</td>
<td style="text-align: center;">{{ $afi->total_validos }}</td>
          
            <td class="text-end">
        <button class="btn btn-sm btn-outline-secondary me-2"
        onclick="window.location='{{ route('admin.afiliados.individual', $afi->id) }}'">
    <i class="fa-solid fa-eye"></i>
</button>


          
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center text-white opacity-50 py-4">
              Nenhum afiliado encontrado.
            </td>
          </tr>
        @endforelse
        </tbody>

      </table>
    </div>

  </div>

</div>


@endsection