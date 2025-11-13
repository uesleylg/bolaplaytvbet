<!-- ======== SIDEBAR (Desktop) ======== -->
<div class="sidebar d-none d-lg-flex flex-column bg-dark vh-100">
  <a class="navbar-brand mb-4 d-block text-light" href="#">
    ⚽ Bolão <span class="text-info">Play</span>
  </a>

  <div class="mt-2 ms-3">
    @guest
      <!-- Registro -->
      <a href="#" class="btn btn-light fw-bold"
         style="background-color:#ffe000;color:#202242!important;width:93%;"
         data-bs-toggle="modal" data-bs-target="#loginModal" data-tab="register">
         <i class="fa-regular fa-address-card"></i> Registro
      </a><br><br>

      <!-- Entrar -->
      <a href="#" class="btn btn-light fw-bold"
         style="background-color:#202242;color:#fff!important;width:93%;"
         data-bs-toggle="modal" data-bs-target="#loginModal" data-tab="login">
         <i class="fa-solid fa-right-to-bracket"></i> Entrar
      </a>
    @endguest

    @auth
      <div class="user-card mt-3">
        <div class="user-avatar"><i class="fa-solid fa-crown"></i></div>
        <div class="user-info">
          <div class="user-name">@ {{ auth()->user()->name }}</div>

          @php
            $profileName = auth()->user()->profile->name ?? 'client';
          @endphp

          @if($profileName === 'admin')
            <div class="user-status text-primary fw-bold" style="cursor:pointer;"
                 onclick="window.location.href='{{ route('admin.index') }}'">
              <i class="fa-solid fa-shield-halved"></i> Administrador
            </div>
          @elseif($profileName === 'reseller')
            <div class="user-status text-warning fw-bold">
              <i class="fa-solid fa-store me-1"></i> Revendedor
            </div>
          @else
            <div class="user-status">
              <i class="fa-solid fa-wallet text-success me-1"></i>
              Saldo: {{ number_format(auth()->user()->balance ?? 0, 2, ',', '.') }}
            </div>
          @endif
        </div>
      </div>
    @endauth
  </div>

  <ul class="nav flex-column ms-3 mt-4 sidebar-menu">
    <li class="nav-item">
      <a class="nav-link text-light" href="{{ route('home.index') }}">
        <i class="fa-solid fa-house"></i> Início
      </a>
    </li>

    @auth
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center text-light" href="{{ route('bilhete.index') }}">
          <i class="fa-solid fa-ticket me-1"></i> Meus Bilhetes
          @if($bilhetesCount > 0)
            <span class="badge bg-danger ms-2">{{ $bilhetesCount }}</span>
          @endif
        </a>
      </li>
    @endauth

    <li class="nav-item"><a class="nav-link text-light" href="{{ route('ranking.index') }}"><i class="fa-solid fa-chart-simple"></i> Ranking</a></li>
    <li class="nav-item"><a class="nav-link text-light" href="#"><i class="fa-solid fa-hand"></i> Regras</a></li>
    <li class="nav-item"><a class="nav-link text-light" href="https://bolaplaytv.com.br/"><i class="fa-solid fa-play"></i> Futebol Ao Vivo</a></li>
    <li class="nav-item"><a class="nav-link text-light" href="#"><i class="fa-brands fa-whatsapp"></i> Contato</a></li>
  </ul>

  @auth
    <form method="POST" action="{{ route('logout') }}" class="mt-auto w-90">
      @csrf
      <hr style="color:#ffffff69;">
      <button type="submit" class="btn btn-danger w-100 rounded-0">
        <i class="fa-solid fa-right-from-bracket me-1"></i> Sair
      </button>
    </form>
  @endauth
</div>

<!-- ======== NAVBAR (Mobile) ======== -->
<nav class="navbar navbar-dark d-lg-none shadow-sm" style="background-color:#202242!important;">
  <div class="container-fluid d-flex align-items-center justify-content-between">
    <!-- Botão e logo -->
    <div class="d-flex align-items-center">
      <button class="btn text-light me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
        <i class="fa-solid fa-bars fa-lg"></i>
      </button>
      <a class="navbar-brand fw-bold mb-0 h1 mobile-text text-light" href="#">
        ⚽ BolaPlay <span style="color:#0dcaf0!important;">Bet</span>
      </a>
    </div>

    <!-- Login / Usuário -->
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
           style="background-color:#2a2c4e;">
        <i class="fa-solid fa-user me-2 text-info"></i>
        <span class="text-truncate" style="max-width:120px;">{{ auth()->user()->name }}</span>
      </div>
    @endauth
  </div>
</nav>

<!-- ======== OFFCANVAS (Mobile) ======== -->
<div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="mobileMenu"
     style="background-color:#202242!important;">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">⚽ BolaPlay <span style="color:#0dcaf0!important;">Bet</span></h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>

  <div class="offcanvas-body d-flex flex-column justify-content-between">
    <div>
      @guest
        <a href="#" class="btn btn-light fw-bold mb-3"
           style="background-color:#ffe000;color:#202242!important;width:93%;"
           data-bs-toggle="modal" data-bs-target="#loginModal" data-tab="register">
           <i class="fa-regular fa-address-card"></i> Registro
        </a>

        <a href="#" class="btn btn-light fw-bold mb-4"
           style="background-color:#202242;color:#fff!important;width:93%;"
           data-bs-toggle="modal" data-bs-target="#loginModal" data-tab="login">
           <i class="fa-solid fa-right-to-bracket"></i> Entrar
        </a>
      @endguest

      @auth
        <div class="user-card mt-2 mb-1">
          <div class="user-avatar"><i class="fa-solid fa-user"></i></div>
          <div class="user-info">
            <div class="user-name">@ {{ auth()->user()->name }}</div>

            @php
              $profileName = auth()->user()->profile->name ?? 'client';
            @endphp

            @if($profileName === 'admin')
              <div class="user-status text-primary fw-bold">
                <i class="fa-solid fa-shield-halved"></i> Administrador
              </div>
            @elseif($profileName === 'reseller')
              <div class="user-status text-warning fw-bold">
                <i class="fa-solid fa-store me-1"></i> Revendedor
              </div>
            @else
              <div class="user-status">
                <i class="fa-solid fa-wallet text-success me-1"></i>
                Saldo: {{ number_format(auth()->user()->balance ?? 0, 2, ',', '.') }}
              </div>
            @endif
          </div>
        </div>
      @endauth

      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link text-light" href="{{ route('home.index') }}"><i class="fa-solid fa-house"></i> Início</a></li>
      
           @auth
             <li class="nav-item"><a class="nav-link text-light" href="{{ route('bilhete.index') }}"><i class="fa-solid fa-ticket"></i> Meus Bilhetes
          @if($bilhetesCount > 0)
            <span class="badge bg-danger ms-2">{{ $bilhetesCount }}</span>
          @endif
            </a></li>
    @endauth
       
       
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
