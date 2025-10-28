@extends('Layout/App')


@section('title', 'BolaPlay Bet')

@section('content')
 @include('Slide.SlidePadrao')

<style>
  .header-title {
    color: white;
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

  /* 🔍 Barra de pesquisa */
  .search-container {
    position: relative;
    flex: 1;
  }

  .search-container i {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 1.1rem;
  }

  .search-input {
    width: 100%;
    font-size: 1.05rem;
    padding: 14px 16px 14px 45px;
    border-radius: 12px;
    border: 2px solid #334155;
    background-color: #0f172a;
    color: #fff;
    font-weight: 500;
    transition: all 0.3s ease;
    outline: none;
  }

  .search-input::placeholder {
    color: #94a3b8;
  }

  .search-input:focus {
    border-color: #facc15;
    box-shadow: 0 0 10px #facc15;
  }

  .status-filter {
    background-color: #1e293b;
    color: white;
    border: 2px solid #334155;
    border-radius: 12px;
    padding: 12px 18px;
    transition: all 0.3s ease;
  }

  .status-filter:hover {
    border-color: #facc15;
    box-shadow: 0 0 10px #facc15;
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
  .py-5 {
    padding-top: 1rem !important;
    padding-bottom: 5rem !important;
}
</style>

<div class="container py-5">

  <!-- 🔖 Cabeçalho -->
  <div class="header-title mb-4">
    <i class="fa-solid fa-ticket"></i> Meus Bilhetes
  </div>

  <!-- 📊 Estatísticas -->
  <div class="stats-card mb-3">
    <div>
      <small>Pendente</small>
      <strong>0 (Nenhum)</strong>
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

  <!-- 🔍 Barra de pesquisa e filtro -->
  <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
    <div class="search-container">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" class="search-input" placeholder="Buscar bilhete ou nome...">
    </div>
    <button class="btn status-filter d-flex align-items-center gap-2">
      <i class="fa-solid fa-filter"></i> Todos os Status
    </button>
  </div>

  <!-- 📭 Estado vazio -->
  <div class="empty-state">
    <i class="fa-solid fa-ticket"></i>
    <h5>Nenhum bilhete encontrado</h5>
    <p>Você ainda não comprou nenhum bilhete. Participe de um bolão e faça sua primeira aposta!</p>
  </div>

</div>





@include('Modal.ModalIndicacao')
@endsection