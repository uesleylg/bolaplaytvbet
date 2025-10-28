@extends('Layout/App')


@section('title', 'BolaPlay Bet')

@section('content')

<link rel="stylesheet" href="{{ asset('css/index.css') }}">


 @include('Slide.SlidePadrao')


  <style>
    .card-bolao {
      position: relative;
      background: linear-gradient(to right, #14532d, #166534);
      color: #fff;
      border: none;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.3);
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    .card-bolao:hover {
      transform: translateY(-4px);
    }

    /* ✨ Efeito de luz passando */
.card-bolao::before {
  content: "";
  position: absolute;
  top: 0;
  left: -75%;
  width: 50%;
  height: 100%;
  background: linear-gradient(
    120deg,
    rgba(255, 255, 255, 0.1) 0%,
    rgba(255, 255, 255, 0.4) 50%,
    rgba(255, 255, 255, 0.1) 100%
  );
  transform: skewX(-25deg);
  animation: shine 6s ease infinite; /* duração de 4s, repetindo sempre */
}




    @keyframes shine {
      0% { left: -75%; }
      100% { left: 125%; }
    }

    .badge-bolao {
      background-color: #ff0000ff;
      color: #ffffffff;
      font-weight: 600;
      border-radius: 20px;
      padding: 6px 14px;
      font-size: 0.8rem;
    }

    .timer-box {
      background-color: rgba(255,255,255,0.1);
      border-radius: 10px;
      padding: 10px 15px;
      text-align: center;
    }

    .timer-box span {
      font-size: 1.5rem;
      font-weight: bold;
      display: block;
      line-height: 1;
    }

    .timer-box small {
      font-size: 0.7rem;
      color: #ddd;
    }

    .card-custom-white{
      color:white;
      border: 1px solid #ffffff33 !important;
      background-color:rgb(30 41 59);;
    }
  </style>

  <div class="container py-5 " style="padding-bottom: 0px !important; padding-top: 0px !important;">
    <div class="text-title-bolao" ><i style="color:#5dff5d;" class="fa-solid fa-circle pulse"></i> 
     Rodada 6 — Quinta-feira, 24/10 | 8 Jogos
    </div>
    
    <div class="container my-5 pd-2">
    <div class="card-bolao p-4" data-bs-toggle="modal" data-bs-target="#ModalAposta">
      <div class="d-flex justify-content-between align-items-start flex-wrap">
        <div>
          <span class="badge-bolao"><i class="fa-solid fa-trophy "></i> <b> PRÊMIAÇÃO ESTIMADA</b></span>
          <h3 class="mt-3 fw-bold premio-valor">R$ 50.000,00</h3>
          <div class="info-encerra-mobile"><i class="bi bi-clock"></i> <strong>Encerra às 17:00h</strong></div>
          <div class="d-flex gap-4 align-items-center mt-2 info-encerra">
            
            <div><i class="bi bi-clock"></i> <strong>Encerra em: 24/10/2025 às 17:00h</strong></div>
          </div>
          <button class="btn btn-warning text-dark fw-semibold mt-4 px-4 py-2 btt-desktop">
            <b>PARTICIPAR DO BOLÃO</b> <i class="bi bi-arrow-right"></i>
          </button>
        </div>

        <div class="timer-box mt-3 mt-md-0">
          <small>Tempo restante</small>
          <span>12 : 31 : 27</span>
          <div>
            <small>hrs&nbsp;&nbsp;min&nbsp;&nbsp;seg</small>
          </div>
        </div>
         <button class="btn btn-warning text-dark fw-semibold mt-4 px-4 py-2 btt-mobile">
            <b>PARTICIPAR DO BOLÃO</b> <i class="bi bi-arrow-right"></i>
          </button>
        
      </div>
    </div>
  </div>



    
 

      </div>
    </div>
  </div>

  
  <div class="container py-5" style="padding-top: 0px !important;">
     <div class="text-title-bolao" ><i style="color:red;" class="fa-solid fa-circle"></i> Rodadas encerradas - ( Ultimas 4 ) </div>
    


  <div class="row g-3 pd-bolao"> <!-- g-3 = espaçamento entre colunas e linhas -->

    <!-- Card Bolão -->
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="card bg-bilhete text-white border-0 shadow-sm p-3 rounded-4 h-100">
        <h5 class="fw-bold mb-1 text-warning">Premiação - 26/10</h5>
        <h3 class="fw-bold">R$ 2.000,00</h3>
        <p class="mb-1"><i class="fa-solid fa-ticket me-1 text-info"></i>255 bilhetes</p>
        <p class="mb-3"><i class="fa-solid fa-crown me-1 text-success"></i>8 ganhadores</p>
        <button class="btn btn-warning-personalizado text-dark fw-semibold px-4 rounded-pill w-100">
          <i class="fa-solid fa-magnifying-glass me-2"></i> Consultar
        </button>
      </div>
    </div>

    <!-- Card Bolão -->
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="card bg-bilhete text-white border-0 shadow-sm p-3 rounded-4 h-100">
        <h5 class="fw-bold mb-1 text-warning">Premiação</h5>
        <h3 class="fw-bold">R$ 1.500,00</h3>
        <p class="mb-1"><i class="fa-solid fa-ticket me-1 text-info"></i>190 bilhetes</p>
        <p class="mb-3"><i class="fa-solid fa-crown me-1 text-success"></i>5 ganhadores</p>
        <button class="btn btn-warning-personalizado text-dark fw-semibold px-4 rounded-pill w-100">
          <i class="fa-solid fa-magnifying-glass me-2"></i> Consultar
        </button>
      </div>
    </div>

    <!-- Card Bolão -->
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="card bg-bilhete text-white border-0 shadow-sm p-3 rounded-4 h-100">
        <h5 class="fw-bold mb-1 text-warning">Premiação</h5>
        <h3 class="fw-bold">R$ 3.200,00</h3>
        <p class="mb-1"><i class="fa-solid fa-ticket me-1 text-info"></i>312 bilhetes</p>
        <p class="mb-3"><i class="fa-solid fa-crown me-1 text-success"></i>10 ganhadores</p>
        <button class="btn btn-warning-personalizado text-dark fw-semibold px-4 rounded-pill w-100">
          <i class="fa-solid fa-magnifying-glass me-2"></i> Consultar
        </button>
      </div>
    </div>

    <!-- Card Bolão -->
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="card bg-bilhete text-white border-0 shadow-sm p-3 rounded-4 h-100">
        <h5 class="fw-bold mb-1 text-warning">Premiação</h5>
        <h3 class="fw-bold">R$ 850,00</h3>
        <p class="mb-1"><i class="fa-solid fa-ticket me-1 text-info"></i>120 bilhetes</p>
        <p class="mb-3"><i class="fa-solid fa-crown me-1 text-success"></i>2 ganhadores</p>
        <button class="btn btn-warning-personalizado text-dark fw-semibold px-4 rounded-pill w-100">
          <i class="fa-solid fa-magnifying-glass me-2"></i> Consultar
        </button>
      </div>
    </div>

   

  </div>
</div>

<style>

  .bg-bilhete {
    background-color: #1e293b; /* Contraste perfeito com #0f172a */
  }

  .card {
    transition: all 0.3s ease;
  }

  .card:hover {
    transform: translateY(-3px);
    background-color: #27354a !important;
  }

  .btn-warning-personalizado {
    background-color: #b0b3b0 !important;
    border: none;
  }

  .btn-warning-personalizado:hover {
    background-color: #9c9e9cff !important;
    transform: translateY(-1px);
  }
</style>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a2e0b6d6b1.js" crossorigin="anonymous"></script>


  </div>


 

  @include('Modal.ModalIndicacao')
  @include('Modal.ModalLoginRegistro')
  @include('Modal.ModalAposta')



@endsection
