@extends('Layout/App')


@section('title', 'BolaPlay Bet')

@section('content')
 @include('Slide.SlidePadrao')


   <style>
  

    .header-title {
      font-weight: 700;
      font-size: 1.9rem;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .header-title i {
      color: #facc15;
      font-size: 1.5rem;
    }

    .stats-card {
      background-color: #1e293b;
      border-radius: 8px;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #fff;
      font-size: 0.95rem;
    }

    .stats-card div strong {
      display: block;
      font-size: 1rem;
    }

    .stats-card .number {
      font-size: 1.3rem;
      font-weight: 600;
    }

    .search-bar {
      background-color: #1e293b;
      border: none;
      color: white;
    }

    .search-bar::placeholder {
      color: #94a3b8;
    }

    .status-filter {
      background-color: #1e293b;
      color: white;
      border: none;
    }

    .empty-state {
      background-color: #1e293b;
      border-radius: 8px;
      padding: 50px 20px;
      text-align: center;
      color: #94a3b8;
    }

    .empty-state i {
      font-size: 3rem;
      color: #475569;
      margin-bottom: 10px;
    }

    .empty-state h5 {
      color: white;
      font-weight: 600;
      margin-bottom: 10px;
    }
  </style>

  <div class="container py-4">

    <div class="header-title mb-4">
      <i class="fa-solid fa-ticket"></i> Meus Bilhetes
    </div>

    <div class="stats-card mb-3">
      <div>
        <small>Usuário</small>
        <strong>Usuário</strong>
      </div>
      <div>
        <small>Total de Bilhetes</small>
        <div class="number">0</div>
      </div>
      <div>
        <small>Bilhetes Ganhos</small>
        <div class="number text-success">0</div>
      </div>
    </div>

    <div class="d-flex mb-3 gap-2">
      <div class="input-group">
        <span class="input-group-text bg-transparent border-0 text-secondary"><i class="fa-solid fa-magnifying-glass"></i></span>
        <input type="text" class="form-control search-bar" placeholder="Buscar por bolão, times ou ID...">
      </div>
      <button class="btn status-filter d-flex align-items-center gap-2">
        <i class="fa-solid fa-filter"></i> Todos os Status
      </button>
    </div>

    <div class="empty-state">
      <i class="fa-solid fa-ticket"></i>
      <h5>Nenhum bilhete encontrado</h5>
      <p>Você ainda não comprou nenhum bilhete. Participe de um bolão e faça sua primeira aposta!</p>
    </div>

  </div>






@include('Modal.ModalIndicacao')
@endsection