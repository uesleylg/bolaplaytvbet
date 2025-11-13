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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/afcee4f894.js" crossorigin="anonymous" defer></script>
</head>
<body>

<!-- SIDEBAR (Desktop) -->
<div class="sidebar d-none d-lg-flex flex-column bg-dark vh-100">
    <a class="navbar-brand mb-4 d-block text-light" href="#">
        ⚽ BolaPlay <span class="text-info">Bet</span>
    </a>

    <div class="mt-2 ms-3">
        @guest
     <!-- Botão Registro -->
<a href="#" 
   class="btn btn-light text-primary fw-bold"
   style="background-color: #ffe000; color:#202242 !important; width: 93%;" 
   data-bs-toggle="modal" 
   data-bs-target="#loginModal"
   data-tab="register">
   <i class="fa-regular fa-address-card"></i> Registro
</a><br><br>

<!-- Botão Entrar -->
<a href="#" 
   class="btn btn-light text-primary fw-bold" 
   style="background-color: #202242; color: #ffffffff !important; width: 93%;" 
   data-bs-toggle="modal" 
   data-bs-target="#loginModal" 
   data-tab="login">
   <i class="fa-solid fa-right-to-bracket"></i> Entrar
</a>

        @endguest

      @auth
    <div class="user-card mt-3">
        <div class="user-avatar">
           <i class="fa-solid fa-crown"></i>
          
        </div>
        <div class="user-info">
            <div class="user-name">@ {{ auth()->user()->name }}</div>

            @php
                $profileName = auth()->user()->profile->name ?? 'client';
            @endphp

            @if($profileName === 'admin')
              <div class="user-status text-primary fw-bold" style="cursor: pointer;"
     onclick="window.location.href='{{ route('admin.index') }}'">
                    <i class="fa-solid fa-shield-halved " style="font-size: 1rem;"></i>
                    Administrador
                </div>
            @elseif($profileName === 'reseller')
                <div class="user-status text-warning fw-bold">
                    <i class="fa-solid fa-store me-1" style="font-size: 1rem;"></i>
                    Revendedor
                </div>
            @else
                <div class="user-status">
                    <i class="fa-solid fa-wallet text-success me-1" style="font-size: 1rem;"></i>
                    Saldo: {{ number_format(auth()->user()->balance ?? 0, 2, ',', '.') }}
                </div>
            @endif
        </div>
    </div>
@endauth

    </div>

    <ul class="nav flex-column ms-3 mt-4 sidebar-menu">
        <li class="nav-item"><a class="nav-link text-light" href="{{ route('home.index') }}"><i class="fa-solid fa-house"></i> Início</a></li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center text-light" href="{{ route('bilhete.index') }}">
                <i class="fa-solid fa-ticket me-1"></i> Meus Bilhetes
               @auth  <span class="badge bg-danger ms-2">3</span>  @endauth
            </a>
        </li>
        <li class="nav-item"><a class="nav-link text-light" href="{{ route('ranking.index') }}"><i class="fa-solid fa-chart-simple"></i> Ranking</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="#"><i class="fa-solid fa-hand"></i> Regras</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="https://bolaplaytv.com.br/"><i class="fa-solid fa-play"></i> Futebol Ao Vivo</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="#"><i class="fa-brands fa-whatsapp"></i> Contato</a></li>
    </ul>

    @auth
   
    <form method="POST" action="{{ route('logout') }}" class="mt-auto  w-90">
         <hr style="color:#ffffff69;">
        @csrf
        <style>
           .btn-danger {
  background-color: #b91c1c !important;
  border-color: #991b1b !important;
  color: #fff !important;
  box-shadow: 0 0 0 rgba(0,0,0,0);
  transition: all 0.25s ease;
}

.btn-danger:hover {
  background-color: #dc2626 !important;
  border-color: #b91c1c !important;
  box-shadow: 0 0 12px rgba(220, 38, 38, 0.5);
  transform: translateY(-1px);
}



        </style>
        <button style="border-radius: 0px;" type="submit" class="btn btn-danger w-100">
            <i class="fa-solid fa-right-from-bracket me-1"></i> Sair
        </button>
    </form>
    @endauth
</div>

<!-- NAVBAR MOBILE -->
<nav class="navbar navbar-dark d-lg-none shadow-sm" style="background-color: #202242 !important;">
    <div class="container-fluid d-flex align-items-center justify-content-between">

        <!-- Botão e logo -->
        <div class="d-flex align-items-center">
            <button class="btn text-light me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
                <i class="fa-solid fa-bars fa-lg"></i>
            </button>
            <a class="navbar-brand fw-bold mb-0 h1 mobile-text text-light" href="#">
                ⚽ BolaPlay <span style="color:#0dcaf0 !important;">Bet</span>
            </a>
        </div>

        <!-- Área de login / usuário -->
        @guest
        <div class="d-flex align-items-center">
            <a href="#" class="text-light me-3 fw-semibold mobile-text" 
               data-bs-toggle="modal" data-bs-target="#loginModal" data-tab="login">
               Entrar
            </a>
            <a href="#" class="text-warning fw-semibold mobile-text" 
               data-bs-toggle="modal" data-bs-target="#loginModal" data-tab="register">
               Registro
            </a>
        </div>
        @endguest

        @auth
        <div class="d-flex align-items-center text-light fw-semibold rounded-pill px-3 py-1" 
             style="background-color: #2a2c4e;">
            <i class="fa-solid fa-user me-2 text-info"></i>
            <span class="text-truncate" style="max-width: 120px;">{{ auth()->user()->name }}</span>
        </div>
        @endauth

    </div>
</nav>


<!-- OFFCANVAS MOBILE -->
<div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="mobileMenu" style="background-color: #202242 !important;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">⚽ BolaPlay <span style="color:#0dcaf0 !important;">Bet</span></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column justify-content-between" style="height: 100%;">
        
        <div>
                   @guest
     <!-- Botão Registro -->
<a href="#" 
   class="btn btn-light text-primary fw-bold"
   style="background-color: #ffe000; color:#202242 !important; width: 93%;" 
   data-bs-toggle="modal" 
   data-bs-target="#loginModal"
   data-tab="register">
   <i class="fa-regular fa-address-card"></i> Registro
</a><br><br>

<!-- Botão Entrar -->
<a href="#" 
   class="btn btn-light text-primary fw-bold" 
   style="background-color: #202242; color: #ffffffff !important; width: 93%;" 
   data-bs-toggle="modal" 
   data-bs-target="#loginModal" 
   data-tab="login">
   <i class="fa-solid fa-right-to-bracket"></i> Entrar
</a>
<br><br>

        @endguest
             @auth
    <div class="user-card mt-2 mb-1">
        <div class="user-avatar">
            <i class="fa-solid fa-user"></i>
        </div>
        <div class="user-info">
            <div class="user-name">@ {{ auth()->user()->name }}</div>

            @php
                $profileName = auth()->user()->profile->name ?? 'client';
            @endphp

            @if($profileName === 'admin')
                <div class="user-status text-primary fw-bold">
                    <i class="fa-solid fa-shield-halved " style="font-size: 1rem;"></i>
                    Administrador
                </div>
            @elseif($profileName === 'reseller')
                <div class="user-status text-warning fw-bold">
                    <i class="fa-solid fa-store me-1" style="font-size: 1rem;"></i>
                    Revendedor
                </div>
            @else
                <div class="user-status">
                    <i class="fa-solid fa-wallet text-success me-1" style="font-size: 1rem;"></i>
                    Saldo: {{ number_format(auth()->user()->balance ?? 0, 2, ',', '.') }}
                </div>
            @endif
        </div>
    </div>
@endauth

            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-light" href="{{ route('home.index') }}"><i class="fa-solid fa-house"></i> Início</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="{{ route('bilhete.index') }}"><i class="fa-solid fa-ticket"></i> Meus Bilhetes  @auth  <span class="badge bg-danger ms-2">3</span>  @endauth</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="{{ route('ranking.index') }}"><i class="fa-solid fa-chart-simple"></i> Ranking</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="#"><i class="fa-solid fa-hand"></i> Regras</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="https://bolaplaytv.com.br/"><i class="fa-solid fa-play"></i> Futebol Ao Vivo</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="#"><i class="fa-brands fa-whatsapp"></i> Contato</a></li>
            </ul>
        </div>

        @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger w-100 mt-3">
                <i class="fa-solid fa-right-from-bracket me-1"></i> Sair
            </button>
        </form>
        @endauth
    </div>
</div>

<main>
    @yield('content')
</main>

<footer class="mt-auto">
    <div class="container text-center text-md-start">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                <h5 class="fw-bold text-uppercase mb-3">⚽ BolaPlay <span class="text-info">Bet</span></h5>
                <p class="text-secondary">Participe dos melhores bolões de futebol, teste seus palpites e dispute prêmios incríveis.</p>
            </div>
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="fw-bold text-uppercase mb-3">Links úteis</h6>
                <p><a href="#" class="text-secondary text-decoration-none">Início</a></p>
                <p><a href="#" class="text-secondary text-decoration-none">Bolões</a></p>
                <p><a href="#" class="text-secondary text-decoration-none">Meus Bilhetes  @auth  <span class="badge bg-danger ms-2">3</span>  @endauth</a></p>
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
            <p class="mb-0 text-secondary">© 2025 <span class="fw-bold text-info">BolaPlay Bet</span> — Todos os direitos reservados.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html>
