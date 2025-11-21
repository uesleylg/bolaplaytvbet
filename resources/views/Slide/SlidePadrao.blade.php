<link rel="stylesheet" href="{{ asset('css/index.css') }}">

@php
    // Filtra apenas slides com ao menos 1 imagem válida
    $slides = \App\Models\Slide::whereNotNull('imagem_desktop')
                ->orWhereNotNull('imagem_mobile')
                ->orderBy('ordem')
                ->get();
@endphp

@if ($slides->count() > 0)
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

    <!-- Indicadores -->
    <div class="carousel-indicators">
        @foreach ($slides as $index => $s)
            <button type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide-to="{{ $index }}"
                class="{{ $index == 0 ? 'active' : '' }}"
                aria-label="Slide {{ $index + 1 }}">
            </button>
        @endforeach
    </div>

    <!-- Slides -->
    <div class="carousel-inner">

        @foreach ($slides as $index => $s)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">

            <picture>

                {{-- MOBILE --}}
                @if($s->imagem_mobile)
                    <source media="(max-width: 767px)"
                            srcset="{{ asset('storage/'.$s->imagem_mobile) }}">
                @endif

                {{-- DESKTOP --}}
                @if($s->imagem_desktop)
                    <source media="(min-width: 768px)"
                            srcset="{{ asset('storage/'.$s->imagem_desktop) }}">
                @endif

                {{-- FALLBACK (se só tiver 1 lado) --}}
                <img src="{{ asset('storage/' . ($s->imagem_desktop ?? $s->imagem_mobile)) }}"
                     class="d-block w-100"
                     alt="Slide {{ $index + 1 }}">

            </picture>

        </div>
        @endforeach

    </div>

    <!-- Controles -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Próximo</span>
    </button>

</div>
@endif



<div class="container py-5 text-center pd-2">
  <div class="stories-wrapper d-flex justify-content-center flex-wrap gap-4">

    <!-- Ranking -->
    <div class="story-card" onclick="window.location.href='{{ route('ranking.index') }}';">
      <div class="icon-wrapper">
        <i class="fa-solid fa-trophy"></i>
      </div>
      <div class="story-name">RANKING</div>
    </div>

    <!-- Jogo ao Vivo -->
    <div class="story-card" onclick="window.location.href='https://bolaplaytv.com.br/';">
      <div class="icon-wrapper">
        <i class="fa-solid fa-play"></i>
      </div>
      <div class="story-name">JOGO AO VIVO</div>
    </div>

    <!-- Regras -->
    <div class="story-card" data-bs-toggle="modal" data-bs-target="#ModalIndicacao">
      <div class="icon-wrapper">
        <i style="color:white;" class="fa-solid fa-file-lines"></i>
      </div>
      <div class="story-name">REGRAS</div>
    </div>

    <!-- Indicação -->
    <div class="story-card" data-bs-toggle="modal" data-bs-target="#ModalIndicacao">
      <div class="icon-wrapper">
        <i class="fa-brands fa-telegram"></i>
      </div>
      <div class="story-name">INDICAÇÃO</div>
    </div>

  </div>
</div>

<style>
  /* ======= LAYOUT BASE ======= */
  .stories-wrapper {
    gap: 40px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }

  /* ======= CARD ======= */
  .story-card {
    position: relative;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 18px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    width: 120px;
    padding: 25px 10px;
    transition: all 0.3s ease;
    cursor: pointer;
  }

  .story-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
    border-color: rgba(255, 255, 255, 0.25);
  }

  /* ======= ÍCONES ======= */
  .icon-wrapper {
    font-size: 46px;
    transition: transform 0.3s ease, filter 0.3s ease;
  }

  .story-card:hover .icon-wrapper {
    transform: scale(1.15);
    filter: brightness(1.3);
  }

  .fa-trophy {
    background: linear-gradient(135deg, #FFD700, #FF9E00, #FF5E00);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .fa-play {
    background: linear-gradient(135deg, #FF0844, #FF6A00, #FFB199);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .fa-telegram {
    background: linear-gradient(135deg, #00C6FF, #0072FF);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  /* ======= TEXTO ======= */
  .story-name {
    color: #fff;
    margin-top: 15px;
    letter-spacing: 0.9px;
    font-size: 0.9rem;
    text-transform: uppercase;
  }

  /* ======= RESPONSIVO ======= */
  @media (max-width: 768px) {
    .stories-wrapper {
      flex-wrap: nowrap; /* impede quebra de linha */
      justify-content: space-between; /* espaçamento uniforme */
      overflow-x: auto; /* rolagem horizontal caso necessário */
      gap: 10px; /* diminui o espaço entre os cards */
      padding-bottom: 10px;
    }

    .story-card {
      flex: 0 0 22%; /* 4 cards lado a lado (4 x 25% ≈ 100%) */
      min-width: 80px;
      padding: 15px 5px;
    }

    .icon-wrapper {
      font-size: 32px;
    }

    .story-name {
      font-size: 0.7rem;
    }
  }
  
.carousel-item img {
  display: block;
  width: 100%;
  height: auto;

  -webkit-mask-image: linear-gradient(to bottom, black 80%, transparent 100%);
  -webkit-mask-repeat: no-repeat;
  -webkit-mask-size: cover;

  mask-image: linear-gradient(to bottom, black 80%, transparent 100%);
  mask-repeat: no-repeat;
  mask-size: cover;
}

 @media (max-width: 425px) {
 .gap-4 {
    gap: 0.5rem !important;
    padding-top: 8px;
}

.story-name {
  
    margin-top: 10px;
}
    .story-card {
    
        min-width: 65px;
        padding: 10px 5px;
    }

    .pd-2{
      padding-top: .5rem !important;
    padding-bottom: .7rem !important;
    }


 }

</style>
