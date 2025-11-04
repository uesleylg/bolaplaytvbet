@extends('Layout/AppAdmin')


@section('title', 'BolaPlay Bet')

@section('title-menu')

@endsection

@section('content')

    <style>
     
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
            transition: all 0.3s ease;
        }
        .card-body {
            position: relative;
        }
    </style>

<div class="container-fluid" style="margin-top:50px;">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-light fw-bold mb-0">
            <i class="fas fa-trophy me-2"></i> Rodadas
        </h2>
        <button data-bs-toggle="modal" data-bs-target="#ModalCadastroRodada" class="btn btn-primary btn-lg rounded-3 shadow-sm">
            <i class="fas fa-plus me-2"></i> Criar Rodada
        </button>
    </div>

    <!-- Cards de rodadas -->
    <div class="row g-4">

        <!-- Rodada 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="card card-hover shadow-sm rounded-4 border-0 position-relative" style="background-color: rgba(var(--bs-dark-rgb), var(--bs-bg-opacity)) !important;">
                <span class="badge bg-success fw-semibold position-absolute top-0 end-0 m-3">Aberta</span>
                <div class="card-body">
                    <h5 class="card-title text-light fw-bold mb-2">Rodada 1 - Brasileirão</h5>
                    <p class="text-light mb-1"><i class="fas fa-gift me-2"></i> Prêmio: Pix R$100,00</p>
                    <p class="text-light mb-1"><i class="fas fa-calendar-alt me-2"></i> Início: 05/11/2025 00:00</p>
                    <p class="text-light mb-3"><i class="fas fa-calendar-check me-2"></i> Fim: 08/11/2025 17:00</p>

                    <div class="d-flex justify-content-between">
                        <button class="btn btn-outline-primary btn-sm rounded-3">
                            <i class="fas fa-edit me-1"></i> Editar
                        </button>
                        <button class="btn btn-outline-danger btn-sm rounded-3">
                            <i class="fas fa-trash me-1"></i> Excluir
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rodada 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="card card-hover shadow-sm rounded-4 border-0 position-relative" style="background-color: rgba(var(--bs-dark-rgb), var(--bs-bg-opacity)) !important;">
                <span style="background-color: #ff1100 !important;" class="badge bg-warning fw-semibold position-absolute top-0 end-0 m-3">Pendente</span>
                <div class="card-body">
                    <h5 class="card-title text-light fw-bold mb-2">Rodada 2 - Brasileirão</h5>
                    <p class="text-light mb-1"><i class="fas fa-gift me-2"></i> Prêmio: Camisa Oficial</p>
                    <p class="text-light mb-1"><i class="fas fa-calendar-alt me-2"></i> Início: 12/11/2025 00:00</p>
                    <p class="text-light mb-3"><i class="fas fa-calendar-check me-2"></i> Fim: 15/11/2025 17:00</p>

                    <div class="d-flex justify-content-between">
                        <button class="btn btn-outline-primary btn-sm rounded-3">
                            <i class="fas fa-edit me-1"></i> Editar
                        </button>
                        <button class="btn btn-outline-danger btn-sm rounded-3">
                            <i class="fas fa-trash me-1"></i> Excluir
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rodada 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="card card-hover shadow-sm rounded-4 border-0 position-relative" style="background-color: rgba(var(--bs-dark-rgb), var(--bs-bg-opacity)) !important;">
                <span class="badge bg-secondary fw-semibold position-absolute top-0 end-0 m-3">Finalizada</span>
                <div class="card-body">
                    <h5 class="card-title text-light fw-bold mb-2">Rodada 3 - Brasileirão</h5>
                    <p class="text-light mb-1"><i class="fas fa-gift me-2"></i> Prêmio: Vale-Presente R$150</p>
                    <p class="text-light mb-1"><i class="fas fa-calendar-alt me-2"></i> Início: 20/11/2025 00:00</p>
                    <p class="text-light mb-3"><i class="fas fa-calendar-check me-2"></i> Fim: 23/11/2025 17:00</p>

                    <div class="d-flex justify-content-between">
                        <button data-bs-toggle="modal" data-bs-target="#ModalJogosRodada"  class="btn btn-outline-primary btn-sm rounded-3">
                            <i class="fas fa-edit me-1"></i> Jogos
                        </button>
                           <button class="btn btn-outline-primary btn-sm rounded-3">
                            <i class="fas fa-edit me-1"></i> Editar
                        </button>
                        <button class="btn btn-outline-danger btn-sm rounded-3">
                            <i class="fas fa-trash me-1"></i> Excluir
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('Admin.Modal.ModalJogosRodada')
@include('Admin.Modal.ModalCriarRodada')
@endsection

