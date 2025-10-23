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
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"></link>
          <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/afcee4f894.js" crossorigin="anonymous" defer></script>

      <style>
    /* Reset e layout base */
    html, body {
      height: 100%;
      margin: 0;
    }

    body {
      display: flex;
      background-color: #2c3e50;
      flex-direction: column;
      min-height: 100vh;
    }
    footer {
      background-color: #14152b !important;
      color: #fff;
      width: 100%;
      flex-shrink: 0;
      padding: 15px 0;
    }


    
    /* Sidebar (desktop) */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 280px;
      background-color: #202242 !important;
      color: #fff;
      padding-top: 2rem;
      transition: all 0.3s;
    }

    .sidebar .nav-link {
      
      letter-spacing: 2px;
      color: #d3d3d3;
      font-weight: 500;
      margin-bottom: 0.8rem;
    }

    .sidebar .nav-link:hover {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 8px;
    }

    .sidebar .navbar-brand {
     color: #cbcbcb;
      font-size: 1.4rem;
      font-weight: bold;
      margin-left: 1rem;
    }

    /* Navbar (mobile) */
    .navbar {
      display: none;
    }

        .btn-entrar {
      background-color: #0d6efd;
      color: #fff;
      border-radius: 20px;
      padding: 6px 16px;
    }

    .btn-entrar:hover {
      background-color: #0b5ed7;
      color: #fff;
    }

    @media (min-width: 992px) {
      .sidebar {
        display: block;
      }
      main {
        margin-left: 280px; /* desloca main para a direita da sidebar */
      }
    }

    @media (max-width: 991px) {
      .sidebar {
        display: none;
      }
      .navbar {
        display: flex;
      }
    }

</style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="#">⚽ BolaPlay <span class="text-info">Bet</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav me-3">
        <li class="nav-item"><a class="nav-link" href="#">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Bolões</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Resultados</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contato</a></li>
      </ul>
      <a href="#" class="btn btn-entrar">Entrar</a>
    </div>
  </div>
</nav>

<div class="sidebar d-none d-lg-block">
  <a class="navbar-brand mb-4 d-block" href="#">⚽ BolaPlay <span class="text-warning">Bet</span></a>
     <div class="mt-4 ms-3">
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

   
  </div><br>
  <ul style="" class="nav flex-column ms-3">
    <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-house"></i> Início</a></li>
    <li class="nav-item"><a class="nav-link" href="#"><i class="fa-regular fa-futbol"></i> Bolões</a></li>
    <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-chart-simple"></i> Resultados</a></li>
    <li class="nav-item"><a class="nav-link" href="#"><i class="fa-brands fa-whatsapp"></i> Contato</a></li>
  </ul>

  <div class="mt-4 ms-3">
   
   
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
