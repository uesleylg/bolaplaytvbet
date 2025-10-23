@extends('Layout/App')


@section('title', 'BolaPlay Bet')

@section('content')

<link rel="stylesheet" href="{{ asset('css/index.css') }}">


 @include('Slide.SlidePadrao')




  <div class="container py-5">
    <div style="color: white;background-color: #34495e; font-size: 18px; padding: 15px; border-radius: 10px; margin-bottom: 30px;  font-family: 'Roboto', sans-serif;     font-weight: bolder;   box-shadow: 0 0 10px 2px #00000052;"><i style="color:#5dff5d;" class="fa-solid fa-circle pulse"></i>  RODADAS ATIVAS DA SEMANA</div>
    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-md-4" data-bs-toggle="modal" data-bs-target="#ModalAposta">
        <div class="card  shadow-sm">
          <img src="{{ asset('img/premio01.png') }}" class="card-img-top" alt="Imagem 1">
          <div class="card-body">
            <h5 class="card-title legenda-premio">R$ 2.000,00 Premio Estimado</h5>
          
           
          </div>
           <a href="#" style="background-color:#00346c;" class="btn btn-primary w-100 card-title-btt">Participar Bolão</a>
        </div>
      </div>

      <!-- Card 2 -->
       <div class="col-md-4">
        <div class="card  shadow-sm">
          <img src="{{ asset('img/premio01.png') }}" class="card-img-top" alt="Imagem 1">
          <div class="card-body">
            <h5 class="card-title legenda-premio">R$ 2.000,00 Premio Estimado</h5>
          
           
          </div>
           <a href="#" style="background-color:#00346c;" class="btn btn-primary w-100 card-title-btt">Participar Bolão</a>
        </div>
      </div>

      <!-- Card 3 -->
    <div class="col-md-4">
        <div class="card  shadow-sm">
          <img src="{{ asset('img/premio01.png') }}" class="card-img-top" alt="Imagem 1">
          <div class="card-body">
            <h5 class="card-title legenda-premio">R$ 2.000,00 Premio Estimado</h5>
          
           
          </div>
           <a href="#" style="background-color:#00346c;" class="btn btn-primary w-100 card-title-btt">Participar Bolão</a>
        </div>
      </div>


      </div>
    </div>
  </div>

  
  <div class="container py-5">
     <div style="color: white;background-color: #34495e; font-size: 18px; padding: 15px; border-radius: 10px; margin-bottom: 30px; font-family: 'Roboto', sans-serif;     font-weight: bolder;    box-shadow: 0 0 10px 2px #00000052;"><i style="color:red;" class="fa-solid fa-circle"></i> RODADAS ENCERRADAS - Ultimas 3</div>
    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-md-4">
        <div class="card  shadow-sm">
          <img src="{{ asset('img/premio01.png') }}" class="card-img-top" alt="Imagem 1">
          <div class="card-body">
            <h5 class="card-title legenda-premio">R$ 2.000,00 Premio Estimado</h5>
          
           
          </div>
           <a href="#" style="background-color:#00346c;" class="btn btn-primary w-100 card-title-btt">Bolão Finalizado</a>
        </div>
      </div>

      <!-- Card 2 -->
       <div class="col-md-4">
        <div class="card  shadow-sm">
          <img src="{{ asset('img/premio01.png') }}" class="card-img-top" alt="Imagem 1">
          <div class="card-body">
            <h5 class="card-title legenda-premio">R$ 2.000,00 Premio Estimado</h5>
          
           
          </div>
           <a href="#" style="background-color:#00346c;" class="btn btn-primary w-100 card-title-btt">Bolão Finalizado</a>
        </div>
      </div>

      <!-- Card 3 -->
    <div class="col-md-4">
        <div class="card  shadow-sm">
          <img src="{{ asset('img/premio01.png') }}" class="card-img-top" alt="Imagem 1">
          <div class="card-body">
            <h5 class="card-title legenda-premio">R$ 2.000,00 Premio Estimado</h5>
          
           
          </div>
           <a href="#" style="background-color:#00346c;" class="btn btn-primary w-100 card-title-btt">Bolão Finalizado</a>
        </div>
      </div>


      </div>
    </div>
  </div>


 


  @include('Modal.ModalLoginRegistro')
  @include('Modal.ModalAposta')



@endsection
