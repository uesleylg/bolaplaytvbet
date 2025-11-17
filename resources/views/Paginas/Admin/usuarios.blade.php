@extends('Layout/Admin/AppAdmin')


@section('title', 'Usuarios')

@section('content')


<!-- ==========================
     PÁGINA DE USUÁRIOS
=========================== -->
<div class="container-fluid">

  <!-- Cabeçalho da página -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">👤 Gerenciamento de Usuários</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalUsuario" data-mode="create">
  <i class="fa-solid fa-user-plus me-2"></i> Novo Usuário
</button>

  </div>

  <!-- Cards de estatísticas -->
  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Total de Usuários</small>
          <h4 class="fw-bold mb-0">{{ $totalUsuarios }}</h4>
        </div>
        <i class="fa-solid fa-users fa-2x text-primary"></i>
      </div>
    </div>
    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Ativos</small>
          <h4 class="fw-bold text-success mb-0">{{ $totalAtivos }}</h4>
        </div>
        <i class="fa-solid fa-user-check fa-2x text-success"></i>
      </div>
    </div>
    <div class="col-md-4">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Inativos</small>
          <h4 class="fw-bold text-danger mb-0">{{ $totalBloqueados }}</h4>
        </div>
        <i class="fa-solid fa-user-xmark fa-2x text-danger"></i>
      </div>
    </div>
  </div>

  <!-- Tabela de Usuários -->
  <div class="card stat-card p-3">
    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2" style="border-color: var(--border-dark) !important;">
      <h5 class="fw-bold mb-0">Lista de Usuários</h5>
      <div>
        <button class="btn btn-outline-secondary btn-sm me-2">
          <i class="fa-solid fa-rotate"></i> Atualizar
        </button>
   
      </div>
    </div>

<form class="row g-3 align-items-end mb-4" method="GET" action="{{ route('admin.usuarios.index') }}">

  <!-- Busca -->
  <div class="col-12 col-md-4">
    <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
      <span class="input-group-text bg-dark text-white border-0">
        <i class="fas fa-magnifying-glass"></i>
      </span>
      <input 
        type="text" 
        name="busca"
        value="{{ request('busca') }}"
        class="form-control border-0 bg-dark text-white"
        placeholder="Buscar usuário por nome ou telefone">
    </div>
  </div>

  <!-- Status -->
  <div class="col-6 col-md-2">
    <select name="status" class="form-select bg-dark text-white border-0 shadow-sm">
      <option value="todos">Status (todos)</option>
      <option value="Ativo" {{ request('status')=='Ativo'?'selected':'' }}>Ativo</option>
      <option value="Bloqueado" {{ request('status')=='Bloqueado'?'selected':'' }}>Bloqueado</option>
    </select>
  </div>

  <!-- Perfil -->
  <div class="col-6 col-md-2">
    <select name="perfil" class="form-select bg-dark text-white border-0 shadow-sm">
      <option value="todos">Perfil (todos)</option>
      <option value="admin" {{ request('perfil')=='admin'?'selected':'' }}>Administrador</option>
      <option value="client" {{ request('perfil')=='client'?'selected':'' }}>Usuário</option>
      <option value="reseller" {{ request('perfil')=='reseller'?'selected':'' }}>Revendedor</option>
    </select>
  </div>

  <!-- Recentes -->
  <div class="col-6 col-md-2">
    <select name="recentes" class="form-select bg-dark text-white border-0 shadow-sm">
      <option value="todos">Recentes</option>
      <option value="hoje" {{ request('recentes')=='hoje'?'selected':'' }}>Hoje</option>
      <option value="7" {{ request('recentes')=='7'?'selected':'' }}>Últimos 7 dias</option>
      <option value="30" {{ request('recentes')=='30'?'selected':'' }}>Últimos 30 dias</option>
    </select>
  </div>

  <!-- Botões -->
  <div class="col-6 col-md-2 d-flex gap-2">
    
    <!-- LIMPAR -->
    <a href="{{ route('admin.usuarios.index') }}" 
       class="btn btn-outline-light flex-fill" 
       style="border-radius: 10px;">
      <i class="fas fa-rotate"></i> Limpar
    </a>

    <!-- APLICAR -->
    <button class="btn btn-primary flex-fill" style="border-radius: 10px;">
      <i class="fas fa-filter"></i> Aplicar
    </button>

  </div>

</form>



    <div class="table-responsive">
      <table class="table table-borderless align-middle mb-0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Telefone</th>
            <th>Perfil</th>
            <th>Data Registro</th>
            <th>Status</th>
            <th class="text-end">Ações</th>
          </tr>
        </thead>
        <tbody>
      @foreach ($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->phone ?? '-' }}</td>
        <td>{{ $user->profile->name ?? 'Usuário' }}</td>
        <td>{{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}</td>
        <td>
          @if ($user->status == "Ativo")
            <span class="badge bg-success">Ativo </span>
          @else
            <span class="badge bg-danger">Bloqueado</span>
          @endif
        </td>
        <td class="text-end">
       
<button 
  class="btn btn-sm btn-outline-secondary me-2 btn-edit-user"
  title="Editar"
  data-bs-toggle="modal"
  data-bs-target="#ModalUsuario"
  data-mode="edit"
  data-id="{{ $user->id }}"
  data-name="{{ $user->name }}"
  data-email="{{ $user->email }}"
  data-phone="{{ $user->phone }}"
  data-profile="{{ $user->profile_id }}"
  data-referencia="{{ $user->referencia_id }}"
  data-status="{{ $user->status }}"
>
  <i class="fa-solid fa-pen"></i>
</button>



          <button 
            data-bs-toggle="modal"
  data-bs-target="#ModalConfirmDelete"
  class="btn btn-sm btn-outline-danger btn-delete-user" 
  title="Excluir"
  data-id="{{ $user->id }}" 
  data-name="{{ $user->name }}">
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
     FIM DA PÁGINA DE USUÁRIOS
=========================== -->


@include('Paginas.Admin.Modal.ModalConfirmDelete')
@include('Paginas.Admin.Modal.ModalUsuario')
@endsection