<link rel="stylesheet" href="{{ asset('css/index.css') }}">

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  
  <!-- Indicadores -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>

  <!-- Slides -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('img/banner02.png') }}" class="d-block w-100" alt="Slide 1" />
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/banner03.png') }}" class="d-block w-100" alt="Slide 2" />
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/banner02.png') }}" class="d-block w-100" alt="Slide 3" />
    </div>
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



<div  class="container py-5 text-center">
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
      <div class="story-name">Regras</div>
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
    font-weight: 600;
    margin-top: 15px;
    letter-spacing: 0.5px;
    font-size: 0.9rem;
    text-transform: uppercase;
  }

  /* ======= RESPONSIVO ======= */
  @media (max-width: 768px) {
    .story-card {
      width: 100px;
      padding: 20px 8px;
    }

    .icon-wrapper {
      font-size: 38px;
    }

    .story-name {
      font-size: 0.8rem;
    }
  }
</style>
