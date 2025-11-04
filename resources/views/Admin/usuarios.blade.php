@extends('Layout/AppAdmin')


@section('title', 'Usuarios')

@section('content')


<!-- ==========================
     PÁGINA DE USUÁRIOS
=========================== -->
<div class="container-fluid">

  <!-- Cabeçalho da página -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">👤 Gerenciamento de Usuários</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalUsuario">
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
        <button class="btn btn-outline-secondary btn-sm">
          <i class="fa-solid fa-filter"></i> Filtros
        </button>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-borderless align-middle mb-0">
        <thead>
          <tr>
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
          <button class="btn btn-sm btn-outline-secondary me-2" title="Editar">
            <i class="fa-solid fa-pen"></i>
          </button>
          <button class="btn btn-sm btn-outline-danger" title="Excluir">
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



@include('Admin.Modal.ModalUsuario')
@endsection