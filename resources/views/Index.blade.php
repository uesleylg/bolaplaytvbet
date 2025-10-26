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
      background-color: #ffcc00;
      color: #000;
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

  <div class="container py-5" style="padding-bottom: 0px !important; padding-top: 0px !important;">
    <div style="color: white;background-color: rgb(30 41 59);; font-size: 18px; padding: 15px; border-radius: 10px; margin-bottom: 30px;  font-family: 'Roboto', sans-serif;     font-weight: bolder;   box-shadow: 0 0 10px 2px #00000052;"><i style="color:#5dff5d;" class="fa-solid fa-circle pulse"></i> 
     RODADA SEXTA 24/10 | 8 Jogos
    </div>
    
    <div class="container my-5">
    <div class="card-bolao p-4" data-bs-toggle="modal" data-bs-target="#ModalAposta">
      <div class="d-flex justify-content-between align-items-start flex-wrap">
        <div>
          <span class="badge-bolao"><i class="fa-solid fa-trophy "></i> <b> PRÊMIO ESTIMADO</b></span>
          <h3 class="mt-3 fw-bold">R$ 50.000,00</h3>
          <div class="d-flex gap-4 align-items-center mt-2">
            <div><i class="bi bi-clock"></i> <strong>Encerra em: 24/10/2025 às 17:00</strong></div>
          </div>
          <button class="btn btn-warning text-dark fw-semibold mt-4 px-4 py-2">
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
      </div>
    </div>
  </div>



    
 

      </div>
    </div>
  </div>

  
  <div class="container py-5" style="padding-top: 0px !important;">
     <div style="color: white;background-color: rgb(30 41 59);; font-size: 18px; padding: 15px; border-radius: 10px; margin-bottom: 30px; font-family: 'Roboto', sans-serif;     font-weight: bolder;    box-shadow: 0 0 10px 2px #00000052;"><i style="color:red;" class="fa-solid fa-circle"></i> RODADAS ENCERRADAS - Ultimas 3</div>
    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-md-4">
        <div class="card  shadow-sm card-custom-white">
          <img src="{{ asset('img/premio01.png') }}" class="card-img-top" alt="Imagem 1">
          <div class="card-body">
            <h5 class="card-title legenda-premio">R$ 2.000,00 PRÊMIADO</h5>
            <p class="card-text text-muted text-center">Data: 27/10/2025</p>
          
           
          </div>
           <a href="#" style="background-color:#00346c;" class="btn btn-primary w-100 card-title-btt"><i class="fa-solid fa-magnifying-glass"></i> Consultar Bolão</a>
        </div>
      </div>

      <!-- Card 2 -->
       <div class="col-md-4">
        <div class="card  shadow-sm card-custom-white">
          <img src="{{ asset('img/premio01.png') }}" class="card-img-top" alt="Imagem 1">
          <div class="card-body">
            <h5 class="card-title legenda-premio">R$ 2.000,00 PRÊMIADO</h5>
             <p class="card-text text-muted text-center">Data: 27/10/2025</p>
       
          
           
          </div>
           <a href="#" style="background-color:#00346c;" class="btn btn-primary w-100 card-title-btt"><i class="fa-solid fa-magnifying-glass"></i> Consultar Bolão</a>
        </div>
      </div>

      <!-- Card 3 -->
    <div class="col-md-4">
        <div class="card  shadow-sm card-custom-white">
          <img src="{{ asset('img/premio01.png') }}" class="card-img-top" alt="Imagem 1">
          <div class="card-body">
            <h5 class="card-title legenda-premio">R$ 2.000,00 PRÊMIADO</h5>
            <p class="card-text text-muted text-center">Data: 27/10/2025</p>
          
           
          </div>
           <a href="#" style="background-color:#00346c;" class="btn btn-primary w-100 card-title-btt"><i class="fa-solid fa-magnifying-glass"></i> Consultar Bolão</a>
        </div>
      </div>


      </div>
    </div>


  </div>


 

  @include('Modal.ModalIndicacao')
  @include('Modal.ModalLoginRegistro')
  @include('Modal.ModalAposta')



@endsection
