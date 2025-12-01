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
    <i class="fa-solid fa-gauge fa-fw"></i> Visão Geral
  </a>
</li>

<li class="nav-item mb-1">
  <a class="nav-link {{ request()->routeIs('admin.cadastro.rodada') ? 'active' : '' }}" 
     href="{{ route('admin.cadastro.rodada') }}">
    <i class="fa-solid fa-trophy fa-fw"></i> Rodadas
  </a>
</li>

<li class="nav-item mb-1">
  <a class="nav-link {{ request()->routeIs('admin.get.carrinho') ? 'active' : '' }}" 
     href="{{ route('admin.get.carrinho') }}">
    <i class="fa-solid fa-cart-shopping fa-fw"></i> Carrinho
  </a>
</li>

<li class="nav-item mb-1">
  <a class="nav-link {{ request()->routeIs('admin.index.bilhetes') ? 'active' : '' }}" 
     href="{{ route('admin.index.bilhetes') }}">
    <i class="fa-solid fa-ticket fa-fw"></i> Bilhetes
  </a>
</li>

<li class="nav-item mb-1">
  <a class="nav-link {{ request()->routeIs('admin.usuarios*') ? 'active' : '' }}" 
     href="{{ route('admin.usuarios.index') }}">
    <i class="fa-solid fa-user fa-fw"></i> Usuários
  </a>
</li>

<li class="nav-item mb-1">
  <a class="nav-link" href="#">
    <i class="fa-solid fa-chart-simple fa-fw"></i> Relatório
  </a>
</li>




<li class="nav-item mb-1">

  <!-- Botão principal -->
  <a 
    class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.index.afiliado*') ? 'active' : '' }}" 
    data-bs-toggle="collapse" 
    href="#submenuAfiliados" 
    role="button"
    aria-expanded="false"
    aria-controls="submenuAfiliados"
    style="cursor:pointer;"
  >
      <span>
        <i class="fa-solid fa-link fa-fw me-2"></i> Afiliados
      </span>
      <i class="fa-solid fa-chevron-down arrow-icon"></i>
  </a>

  <!-- Submenu -->
  <div class="collapse" id="submenuAfiliados">
      <ul class="nav flex-column ms-4 mt-2">




        <li class="nav-item mb-1">
          <a href="{{ route('admin.index.afiliados') }}" 
             class="nav-link text-muted submenu-link">
            <i class="fa-solid fa-users-line me-2"></i> Visão Geral
          </a>
        </li>

       
       <li class="nav-item mb-1">
          <a href="{{ route('admin.index.metas') }}" class="nav-link text-muted submenu-link">
            <i class="fa-solid fa-bullseye me-2"></i> Metas
          </a>
        </li>

        <li class="nav-item mb-1">
          <a href="#" class="nav-link text-muted submenu-link">
            <i class="fa-solid fa-chart-line me-2"></i> Relatório
          </a>
        </li>

      </ul>
  </div>

</li>



       
          <li class="nav-item mt-3">
            <hr>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.index.conf*') ? 'active' : '' }}" href="{{ route('admin.index.conf') }}"><i class="fa-solid fa-gear"></i> Configurações</a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.index.logs*') ? 'active' : '' }}" href="{{ route('admin.index.logs') }}"><i class="fa-solid fa-clipboard-list"></i> Logs Sistema</a>
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

          <h5 class="mb-0 d-none d-md-block" style="padding-left: 10px;"> @yield('title-menu', ' Visão Geral')</h5>
        </div>

   <div class="d-flex align-items-center">
    <div class="me-3 text-muted small d-none d-md-block">
        Olá, {{ auth()->user()->name }}
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-sm btn-outline-secondary">Sair</button>
    </form>
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

 
