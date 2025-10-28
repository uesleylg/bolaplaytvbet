<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BolaPlay Bet')</title>
    
      <link rel="manifest" href="%PUBLIC_URL%/manifest.json" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">


      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"></link>
          <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/afcee4f894.js" crossorigin="anonymous" defer></script>

</head>
<body>

<!-- SIDEBAR (visível só no desktop) -->
<div class="sidebar d-none d-lg-block bg-light vh-100 ">
  <a class="navbar-brand mb-4 d-block" href="#">⚽ BolaPlay <span class="text-warning" style="color:#0dcaf0 !important;">Bet</span></a>

  <div class="mt-4 ms-3">

    <!-- Botão Registro -->
    <a href="#" 
      class="btn btn-light text-primary fw-bold mb-3"
      style="background-color: #ffe000; color:#202242 !important; width: 93%;" 
      data-bs-toggle="modal" 
      data-bs-target="#loginModal"
      data-tab="register">
      <i class="fa-regular fa-address-card"></i> Registro
    </a>

    <!-- Botão Entrar -->
    <a href="#" 
      class="btn btn-light text-primary fw-bold" 
      style="background-color: #202242; color: #ffffffff !important; width: 93%;" 
      data-bs-toggle="modal" 
      data-bs-target="#loginModal" 
      data-tab="login">
      <i class="fa-solid fa-right-to-bracket"></i> Entrar
    </a>

    <!-- Card Usuário -->
    <div class="user-card mt-3">
      <div class="user-avatar">
        <i class="fa-solid fa-user"></i>
      </div>
      <div class="user-info">
        <div class="user-name">Uesley Lauriano</div>
        <div class="user-status">
          <i class="fa-solid fa-circle text-success me-1" style="font-size: 0.6rem;"></i> Online
        </div>
      </div>
    </div>
  </div>

  <ul class="nav flex-column ms-3 mt-4">
    <li class="nav-item"><a class="nav-link" href="{{ route('home.index') }}"><i class="fa-solid fa-house"></i> Início</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('bilhete.index') }}"><i class="fa-solid fa-ticket"></i> Meus Bilhetes</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('ranking.index') }}"><i class="fa-solid fa-chart-simple"></i> Ranking</a></li>
    <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-hand"></i> Regras</a></li>
    <li class="nav-item"><a class="nav-link" href="https://bolaplaytv.com.br/"><i class="fa-solid fa-play"></i> Futebol Ao Vivo</a></li>
    <li class="nav-item"><a class="nav-link" href="#"><i class="fa-brands fa-whatsapp"></i> Contato</a></li>
  </ul>
</div>


<!-- NAVBAR MOBILE -->
<nav class="navbar navbar-dark  d-lg-none" style="background-color: #202242 !important;">
  <div class="container-fluid d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center">
      <!-- Botão hamburguer -->
      <button class="btn text-light me-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
        <i class="fa-solid fa-bars fa-lg"></i>
      </button>

      <!-- Logo (agora ao lado do hamburguer, não centralizada) -->
      <a class="navbar-brand fw-bold mb-0 h1 mobile-text" href="#" >
        ⚽ BolaPlay <span style="color:#0dcaf0 !important;">Bet</span>
      </a>
    </div>

    <!-- Entrar / Registro (continua à direita) -->
    <div class="d-flex align-items-center">
      <a href="#" 
         class="text-light me-3 fw-semibold mobile-text"
         data-bs-toggle="modal" 
         data-bs-target="#loginModal"
         data-tab="login">
         Entrar
      </a>
      <a href="#" 
         class="text-warning fw-semibold mobile-text"
         data-bs-toggle="modal" 
         data-bs-target="#loginModal"
         data-tab="register">
         Registro
      </a>
    </div>
  </div>
</nav>

<!-- OFFCANVAS (Menu Lateral Mobile) -->
<div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="mobileMenu" style="background-color: #202242 !important;">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">⚽ BolaPlay <span style="color:#0dcaf0 !important;">Bet</span></h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>

  <div class="offcanvas-body">
    <!-- Copia do conteúdo da sidebar -->
    <div class="user-card mt-2 mb-3">
      <div class="user-avatar">
        <i class="fa-solid fa-user"></i>
      </div>
      <div class="user-info">
        <div class="user-name">Uesley Lauriano</div>
        <div class="user-status">
          <i class="fa-solid fa-circle text-success me-1" style="font-size: 0.6rem;"></i> Online
        </div>
      </div>
    </div>

    <ul class="nav flex-column">
      <li class="nav-item"><a class="nav-link text-light" href="{{ route('home.index') }}"><i class="fa-solid fa-house"></i> Início</a></li>
      <li class="nav-item"><a class="nav-link text-light" href="{{ route('bilhete.index') }}"><i class="fa-solid fa-ticket"></i> Meus Bilhetes</a></li>
      <li class="nav-item"><a class="nav-link text-light" href="{{ route('ranking.index') }}"><i class="fa-solid fa-chart-simple"></i> Ranking</a></li>
      <li class="nav-item"><a class="nav-link text-light" href="#"><i class="fa-solid fa-hand"></i> Regras</a></li>
      <li class="nav-item"><a class="nav-link text-light" href="https://bolaplaytv.com.br/"><i class="fa-solid fa-play"></i> Futebol Ao Vivo</a></li>
      <li class="nav-item"><a class="nav-link text-light" href="#"><i class="fa-brands fa-whatsapp"></i> Contato</a></li>
    </ul>
  </div>
</div>


  

    <main>
        @yield('content')
    </main>



    <footer class="mt-auto ">
  <div class="container text-center text-md-start">
    <div class="row">
      <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
        <h5 class="fw-bold text-uppercase mb-3">⚽ BolaPlay <span class="text-info">Bet</span></h5>
        <p class="text-secondary">
          Participe dos melhores bolões de futebol, teste seus palpites e dispute prêmios incríveis.
        </p>
      </div>
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
        <h6 class="fw-bold text-uppercase mb-3">Links úteis</h6>
        <p><a href="#" class="text-secondary text-decoration-none">Início</a></p>
        <p><a href="#" class="text-secondary text-decoration-none">Bolões</a></p>
         <p><a href="#" class="text-secondary text-decoration-none">Meus Bilhetes</a></p>
        <p><a href="#" class="text-secondary text-decoration-none">Resultados</a></p>
        <p><a href="#" class="text-secondary text-decoration-none">Contato</a></p>
      </div>
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
        <h6 class="fw-bold text-uppercase mb-3">Contato</h6>
        <p><i class="bi bi-envelope-fill text-info"></i> suporte@bolaplaybet.com</p>
        <p><i class="bi bi-whatsapp text-info"></i> (11) 99999-9999</p>
      </div>
    </div>
    <hr class="mb-4 text-secondary" />
    <div class="text-center">
      <p class="mb-0 text-secondary">
        © 2025 <span class="fw-bold text-info">BolaPlay Bet</span> — Todos os direitos reservados.
      </p>
    </div>
  </div>
</footer>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html>
