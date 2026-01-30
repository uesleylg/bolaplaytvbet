@extends('Layout/User/App')


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
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
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
    animation: shine 6s ease infinite;
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
    background-color: rgba(255, 255, 255, 0.1);
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

  .card-custom-white {
    color: white;
    border: 1px solid #ffffff33 !important;
    background-color: rgb(30 41 59);
  }
</style>

<div class="container py-5" style="padding-bottom: 30px !important; padding-top: 0px !important;">

  @if($rodada)
    <div class="text-title-bolao">
      <i style="color:#5dff5d;" class="fa-solid fa-circle pulse"></i> 
      {{ $rodada->nome }} | {{ $rodada->num_palpites }} Jogos
    </div>

  <div class="card-bolao p-4 abrirAposta" data-id="{{ $rodada->id }}">

      <div class="d-flex justify-content-between align-items-start flex-wrap">
        
        <div>
          <span class="badge-bolao">
            <i class="fa-solid fa-trophy"></i> <b>PRÊMIAÇÃO ESTIMADA</b>
          </span>
          <h3 class="mt-3 fw-bold premio-valor">
            R$ {{ number_format($rodada->premiacao_estimada ?? 0, 2, ',', '.') }}
          </h3>

          <div class="info-encerra-mobile">
            <i class="bi bi-clock"></i> 
            <strong>Encerra às {{ \Carbon\Carbon::parse($rodada->data_fim)->format('H:i') }}h</strong>
          </div>

          <div class="d-flex gap-4 align-items-center mt-2 info-encerra">
            <div>
              <i class="bi bi-clock"></i> 
              <strong>
                Encerra em: {{ \Carbon\Carbon::parse($rodada->data_fim)->format('d/m/Y \à\s H:i') }}
              </strong>
            </div>
          </div>

          <button class="btn btn-warning text-dark fw-semibold mt-4 px-4 py-2 btt-desktop">
            <b>PARTICIPAR DO BOLÃO</b> <i class="bi bi-arrow-right"></i>
          </button>
        </div>

        <div class="timer-box mt-3 mt-md-0">
          <small>Tempo restante</small>
          <span id="tempoRestante">00 : 00 : 00</span>
          <div>
            <small>hrs&nbsp;&nbsp;min&nbsp;&nbsp;seg</small>
          </div>
        </div>

        <button class="btn btn-warning text-dark fw-semibold mt-4 px-4 py-2 btt-mobile">
          <b>PARTICIPAR DO BOLÃO</b> <i class="bi bi-arrow-right"></i>
        </button>
      </div>
    </div>

  @else
    <!-- Card moderno sem pulsar -->
    <div class="card p-5 text-center shadow-lg" 
         style="border-radius: 16px; background: linear-gradient(135deg, #0f9d58, #34a853); color: #ffffff;">
      <i class="fa-solid fa-clock fa-3x anim-icon mb-3"></i>
      <h3 class="fw-bold mb-2">Nenhum bolão disponível</h3>
      <p class="text-white-50 mb-4">
        Fique ligado! Assim que um bolão estiver ativo, ele aparecerá aqui.
      </p>
      <button class="btn btn-light fw-semibold px-4 py-2" disabled>
        Aguardar próximo bolão
      </button>
    </div>

    <style>
      /* Ícone animado de relógio (leve rotação ou pulse) */
      .anim-icon {
        display: inline-block;
        animation: swing-clock 2s ease-in-out infinite;
      }

      @keyframes swing-clock {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(10deg); }
        50% { transform: rotate(0deg); }
        75% { transform: rotate(-10deg); }
      }
    </style>
  @endif

</div>

<script>
  @if($rodada)
    // Data de encerramento da rodada (em milissegundos)
    const fimRodada = new Date("{{ $rodada->data_fim }}").getTime();

    function atualizarTimer() {
      const agora = new Date().getTime();
      let distancia = fimRodada - agora;

      if (distancia < 0) {
        document.getElementById('tempoRestante').innerText = "00 : 00 : 00";
        clearInterval(timerInterval);
        return;
      }

      const horas = Math.floor(distancia / (1000 * 60 * 60));
      const minutos = Math.floor((distancia % (1000 * 60 * 60)) / (1000 * 60));
      const segundos = Math.floor((distancia % (1000 * 60)) / 1000);

      document.getElementById('tempoRestante').innerText =
        String(horas).padStart(2, '0') + " : " +
        String(minutos).padStart(2, '0') + " : " +
        String(segundos).padStart(2, '0');
    }

    // Atualiza a cada 1 segundo
    atualizarTimer();
    const timerInterval = setInterval(atualizarTimer, 1000);
  @endif
</script>

















  
  <div class="container py-5" style="padding-top: 0px !important;">
     <div class="text-title-bolao" ><i style="color:red;" class="fa-solid fa-circle"></i> Rodadas encerradas - ( Ultimas 4 ) </div>
    


  <div class="row g-3 pd-bolao"> <!-- g-3 = espaçamento entre colunas e linhas -->



  @forelse($rodadasCards as $card)

    <!-- Card Bolão -->
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="card bg-bilhete text-white border-0 shadow-sm p-3 rounded-4 h-100">

        {{-- Data da premiação --}}
        <h5 class="fw-bold mb-1 text-warning">
          Bolão - {{ $card['data'] }}
        </h5>

        {{-- Valor --}}
        <h3 class="fw-bold">
          R$ {{ number_format($card['premiacao'], 2, ',', '.') }}
        </h3>

        {{-- Total de bilhetes --}}
        <p class="mb-1">
          <i class="fa-solid fa-ticket me-1 text-info"></i>
          {{ $card['total_bilhetes'] }} bilhetes no site
        </p>

        {{-- Ganhadores --}}
        <p class="mb-3">
          <i class="fa-solid fa-crown me-1 text-success"></i>
          {{ $card['ganhadores'] }}
          {{ $card['ganhadores'] === 1 ? 'ganhador' : 'ganhadores' }}
        </p>

        {{-- Botão --}}
        <a href="{{ route('ranking.index', $card['id']) }}"
           class="btn btn-warning-personalizado text-dark fw-semibold px-4 rounded-pill w-100">
          <i class="fa-solid fa-magnifying-glass me-2"></i>
          Consultar
        </a>

      </div>
    </div>

  @empty
    <div class="col-12 text-center text-muted py-4">
      Nenhuma rodada encerrada encontrada.
    </div>
  @endforelse

  @for($i = 0; $i < $cardsFaltantes; $i++)
  <div class="col-12 col-sm-6 col-lg-3">
    <div class="card skeleton-card border-0 p-3 rounded-4 h-100">

      <div class="skeleton skeleton-title mb-2"></div>
      <div class="skeleton skeleton-value mb-3"></div>

      <div class="skeleton skeleton-line mb-2"></div>
      <div class="skeleton skeleton-line mb-4"></div>

      <div class="skeleton skeleton-button"></div>

    </div>
  </div>
@endfor





   

  </div>
</div>

<style>


/* Card fantasma */
.skeleton-card {
    background: #0f172a;
    opacity: 0.6;
    position: relative;
    overflow: hidden;
}

/* Base skeleton */
.skeleton {
    background: linear-gradient(
        90deg,
        #1e293b 25%,
        #334155 37%,
        #1e293b 63%
    );
    background-size: 400% 100%;
    animation: shimmer 2.4s ease infinite;
    border-radius: 10px;
}

/* Tamanhos */
.skeleton-title {
    height: 20px;
    width: 70%;
}

.skeleton-value {
    height: 28px;
    width: 50%;
}

.skeleton-line {
    height: 14px;
    width: 100%;
}

.skeleton-button {
    height: 38px;
    width: 100%;
    border-radius: 999px;
}

/* Animação */
@keyframes shimmer {
    0% {
        background-position: -400px 0;
    }
    100% {
        background-position: 400px 0;
    }
}




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


 

  @include('Paginas.User.Modal.ModalIndicacao')
  @include('Paginas.User.Modal.ModalLoginRegistro')
  @include('Paginas.User.Modal.ModalAposta')



@endsection
