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
      <img src="{{ asset('img/banner01.png') }}" class="d-block w-100" alt="Slide 1" />
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/banner01.png') }}" class="d-block w-100" alt="Slide 2" />
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/banner01.png') }}" class="d-block w-100" alt="Slide 3" />
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


<div class="container py-5" style="cursor: default; padding-bottom: 0px !important;">

  <div class="stories-wrapper">

    <!-- Ranking -->
    <div class="story-card" style="cursor: pointer;" onclick="window.location.href='{{ route('ranking.index') }}';">
      <i class="fa-solid fa-trophy home-bar"></i>
      <div class="story-name">RANKING</div>
    </div>

    <!-- Jogo ao Vivo -->
    <div class="story-card" style="cursor: pointer;" onclick="window.location.href='https://bolaplaytv.com.br/';">
      <i class="fa-solid fa-play home-bar"></i>
      <div class="story-name">JOGO AO VIVO</div>
    </div>

    <!-- Indicação -->
    <div class="story-card">
      <i class="fa-brands fa-telegram home-bar"></i>
      <div class="story-name">INDICAÇÃO</div>
    </div>

  </div>

</div>
