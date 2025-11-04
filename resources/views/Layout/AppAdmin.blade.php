<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Dashboard')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/afcee4f894.js" crossorigin="anonymous" defer></script>
  <style>
    :root{
         
      --sidebar-width: 260px;
      --bg-dark: #0d1117;
      --bg-darker: #161b22;
      --text-light: #e6edf3;
      --text-muted: #8b949e;
      --border-dark: #30363d;
      --primary: #0d6efd;
      --card-bg: #1c2128;
    }

    body {
      background-color: var(--bg-dark);
      color: var(--text-light);
    }

    .app-wrapper { min-height: 100vh; display: flex; }

    /* Sidebar */
    .sidebar-lg {
      width: var(--sidebar-width);
      min-height: 100vh;
      background: var(--bg-darker);
      border-right: 1px solid var(--border-dark);
      padding: 1.25rem;
      color: var(--text-light);
    }

    .brand {
      font-weight: 700;
      font-size: 1.05rem;
      color: var(--text-light);
    }

    .sidebar-nav .nav-link {
      color: var(--text-muted);
      border-radius: .5rem;
      padding: .6rem .75rem;
    }
    .sidebar-nav .nav-link:hover {
      background: rgba(13,110,253,0.15);
      color: var(--text-light);
    }
    .sidebar-nav .nav-link.active {
      background: rgba(13,110,253,0.25);
      color: var(--primary);
      font-weight: 600;
    }

    .main-content {
      flex: 1;
      padding: 1.25rem;
      background-color: var(--bg-dark);
    }

    .topbar {
      border-bottom: 1px solid var(--border-dark);
      background-color: var(--bg-darker) !important;
      color: var(--text-light);
    }

    .btn-outline-secondary {
      color: var(--text-light);
      border-color: var(--border-dark);
    }
    .btn-outline-secondary:hover {
      background-color: var(--border-dark);
    }

    .stat-card {
      background: var(--card-bg);
      color: var(--text-light);
      border: 1px solid var(--border-dark);
      border-radius: 1rem;
      box-shadow: 0 6px 18px rgba(0,0,0,0.4);
    }

    .bg-light {
      background-color: var(--bg-darker) !important;
    }

    .text-muted { color: var(--text-muted) !important; }

    .offcanvas {
      background-color: var(--bg-darker);
      color: var(--text-light);
    }

    .table {
           --bs-table-color: #ffffffff;
      color: var(--text-light);
    }
    .table thead tr { color: var(--text-muted); }
    .table tbody tr:hover { background-color: rgba(255,255,255,0.05); }

    .badge.bg-success { background-color: #238636 !important; }
    .badge.bg-warning { background-color: #9e6f00 !important; color: #fff !important; }

    footer {
      color: var(--text-muted);
    }

    @media (max-width: 575.98px){
      .brand { font-size: 1rem; }
    }
	
	/* ===== TABELA - MODO ESCURO ===== */
.table {
  color: var(--text-light);
  background-color: var(--card-bg);
  border-color: var(--border-dark);
}

.table thead {
  background-color: var(--bg-darker);
  color: var(--text-muted);
  border-bottom: 1px solid var(--border-dark);
}

.table tbody tr {
  border-bottom: 1px solid var(--border-dark);
}

.table tbody tr:last-child {
  border-bottom: none;
}

.table tbody tr:hover {
  background-color: rgba(255,255,255,0.05);
}

.table td, .table th {
  padding: .75rem;
  vertical-align: middle;
}

/* Remove qualquer fundo branco herdado do Bootstrap */
.table-borderless > :not(caption) > * > * {
  background-color: transparent !important;
  box-shadow: none !important;
}

  </style>
</head>

<body class="bg-dark">

  <div class="app-wrapper">

    <!-- Sidebar (visible on lg and up) -->
    <aside class="sidebar-lg d-none d-lg-block">
      <div class="d-flex align-items-center mb-4">
        <div class="me-2">
          <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="1" y="1" width="22" height="22" rx="4" fill="#0d6efd" />
            <path d="M7 12h10M7 8h10M7 16h6" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div class="brand">BolaPlay Dashboard</div>
      </div>

      <nav class="sidebar-nav">
        <ul class="nav flex-column">
         <li class="nav-item mb-1">
  <a class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}" 
     href="{{ route('admin.index') }}">
    <i class="fa-solid fa-gauge"></i> Visão Geral
  </a>
</li>

<li class="nav-item mb-1">
  <a class="nav-link {{ request()->routeIs('admin.cadastro.rodada') ? 'active' : '' }}" 
     href="{{ route('admin.cadastro.rodada') }}">
    <i class="fa-solid fa-trophy"></i> Rodadas
  </a>
</li>

<li class="nav-item mb-1">
  <a class="nav-link {{ request()->routeIs('admin.usuarios*') ? 'active' : '' }}" 
     href="{{ route('admin.usuarios.index') }}">
    <i class="fa-solid fa-user"></i> Usuários
  </a>
</li>
<li class="nav-item mb-1">
  <a class="nav-link {{ request()->routeIs('admin.usuarios*') ? 'active' : '' }}" 
     href="{{ route('admin.usuarios.index') }}">
    <i class="fa-solid fa-chart-simple"></i> Relatório
  </a>
</li>
        
       
          <li class="nav-item mt-3">
            <hr>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa-solid fa-gear"></i> Configurações</a>
          </li>
           <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home.index*') ? 'active' : '' }}" 
     href="{{ route('home.index') }}">
    <i class="fa-solid fa-house"></i> Cliente
  </a>
         
          </li>
         
        </ul>
      </nav>

    </aside>

    <!-- Main area (contains topbar and content) -->
    <div class="main-content w-100">

      <!-- Topbar (always visible) -->
      <header class="d-flex align-items-center justify-content-between py-2 topbar bg-white rounded-3 mb-3">
        <div class="d-flex align-items-center">
          <!-- Mobile menu button -> opens offcanvas sidebar -->
          <button class="btn btn-outline-primary d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2.5 12.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5z"/>
            </svg>
          </button>

          <h5 class="mb-0 d-none d-md-block">@yield('title-menu', 'Visão Geral')</h5>
        </div>

        <div class="d-flex align-items-center">
          <div class="me-3 text-muted small d-none d-md-block">Olá, Admin</div>
          <div>
            <button class="btn btn-sm btn-outline-secondary">Sair</button>
          </div>
        </div>
      </header>

      <!-- Offcanvas sidebar for mobile -->
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Menu</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <nav>
            <ul class="nav flex-column">
              <li class="nav-item mb-1"><a class="nav-link active" href="#">Visão Geral</a></li>
              <li class="nav-item mb-1"><a class="nav-link" href="#">Usuários</a></li>
              <li class="nav-item mb-1"><a class="nav-link" href="#">Bilhetes</a></li>
              <li class="nav-item mb-1"><a class="nav-link" href="#">Financeiro</a></li>
              <li class="nav-item mt-3"><hr></li>
              <li class="nav-item"><a class="nav-link" href="#">Configurações</a></li>
            </ul>
          </nav>
        </div>
      </div>

      <!-- Content: cards -->
      <section>
       

         @yield('content')




      </section>

      <footer class="mt-4 small text-muted">© 2025 BolaPlay — Painel administrativo</footer>

    </div>
  </div>

  <!-- Bootstrap JS (Popper included) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Optionally add a tiny script to manage active nav links -->
  <script>
    
    document.querySelectorAll('.sidebar-nav .nav-link, .offcanvas-body .nav-link').forEach(function(link){
      link.addEventListener('click', function(e){
        document.querySelectorAll('.sidebar-nav .nav-link').forEach(n=>n.classList.remove('active'));
        document.querySelectorAll('.offcanvas-body .nav-link').forEach(n=>n.classList.remove('active'));
        // mark clicked as active (matches by text)
        var txt = this.textContent.trim();
        document.querySelectorAll('.sidebar-nav .nav-link').forEach(function(n){ if(n.textContent.trim()===txt) n.classList.add('active'); });
        document.querySelectorAll('.offcanvas-body .nav-link').forEach(function(n){ if(n.textContent.trim()===txt) n.classList.add('active'); });

        // if mobile, hide offcanvas after click
        var off = document.querySelector('#offcanvasSidebar');
        if(off && off.classList.contains('show')){
          var bsOff = bootstrap.Offcanvas.getInstance(off);
          if(bsOff) bsOff.hide();
        }
      });
    });
  </script>

</body>
</html>
