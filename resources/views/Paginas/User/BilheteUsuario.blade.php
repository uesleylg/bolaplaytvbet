@extends('Layout/User/App')

@section('title', 'BolaPlay Bet')

@section('content')
@include('Slide.SlidePadrao')

<style>

/* Botão (parecendo select) */
.status-filter {
    background: #0f172a;
    border: 1px solid #283347;
    color: white;
    padding: 8px 14px;
    border-radius: 10px;
    transition: 0.3s ease;
}

.status-filter:hover {
    background: #1e293b;
    border-color: #3b475a;
}

/* Wrapper para posicionar o dropdown */
.dropdown-wrapper {
    position: relative;
}

/* Dropdown */
.status-menu {
    position: absolute;
    top: 48px;
    left: 0;
    background: #0f172a;
    border: 1px solid #283347;
    border-radius: 10px;
    padding: 6px;
    display: none;
    flex-direction: column;
    z-index: 200;
    min-width: 180px;
}

.status-menu button {
    background: transparent;
    border: none;
    text-align: left;
    padding: 8px 12px;
    color: white;
    border-radius: 8px;
    font-size: 14px;
}

.status-menu button:hover {
    background: #1e293b;
}


  .header-title {
    color: white;
    font-weight: 700;
    font-size: 1.9rem;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .header-title i {
    color: #facc15;
    font-size: 1.5rem;
  }

   @media (max-width: 425px) {
    .header-title {
    font-size: 1.2rem;
    }
   }

  .stats-card {
    background-color: #1e293b;
    border-radius: 8px;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #fff;
    font-size: 0.95rem;
  }

  .stats-card div strong {
    display: block;
    font-size: 1rem;
  }

  .stats-card .number {
    font-size: 1.3rem;
    font-weight: 600;
  }

  /* 🔍 Barra de pesquisa */
  .search-container {
    position: relative;
    flex: 1;
  }

  .search-container i {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 1.1rem;
  }

  .search-input {
    width: 100%;
    font-size: 1.05rem;
    padding: 14px 16px 14px 45px;
    border-radius: 12px;
    border: 2px solid #334155;
    background-color: #0f172a;
    color: #fff;
    font-weight: 500;
    transition: all 0.3s ease;
    outline: none;
  }

  .search-input::placeholder {
    color: #94a3b8;
  }

  .search-input:focus {
    border-color: #facc15;
    box-shadow: 0 0 10px #facc15;
  }

  .status-filter {
    background-color: #1e293b;
    color: white;
    border: 2px solid #334155;
    border-radius: 12px;
    padding: 12px 18px;
    transition: all 0.3s ease;
  }

  .status-filter:hover {
    border-color: #facc15;
    box-shadow: 0 0 10px #facc15;
  }

  .empty-state {
    background-color: #1e293b;
    border-radius: 8px;
    padding: 50px 20px;
    text-align: center;
    color: #94a3b8;
  }

  .empty-state i {
    font-size: 3rem;
    color: #475569;
    margin-bottom: 10px;
  }

  .empty-state h5 {
    color: white;
    font-weight: 600;
    margin-bottom: 10px;
  }

  .bilhete-card {
    background-color: #1e293b;
    border-radius: 10px;
    padding: 15px 20px;
    color: #fff;
    margin-bottom: 15px;
    box-shadow: 0 0 6px #000;
    transition: transform 0.2s ease;
  }

  .bilhete-card:hover {
    transform: scale(1.02);
  }

  .bilhete-card small {
    color: #94a3b8;
  }

  .status {
    font-weight: bold;
    text-transform: uppercase;
  }

  .status.pendente { color: #facc15; }
  .status.ganho { color: #4ade80; }
  .status.perdido { color: #f87171; }

  .py-5 {
     padding-top: 0.5rem !important;
    padding-bottom: 0.5rem !important;
  }
</style>

<style>
  .bilhete-card {
    background: linear-gradient(145deg, #0f172a, #1e293b);
    border: 1px solid #334155;
    border-radius: 16px;
    padding: 1.25rem;
    margin-bottom: 1rem;
    color: #f1f5f9;
    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.35);
    transition: transform 0.2s ease, box-shadow 0.3s ease;
  }

  .bilhete-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 36px rgba(0, 0, 0, 0.45);
  }

  .bilhete-card .status {
    font-weight: 600;
    font-size: 0.9rem;
    border-radius: 20px;
    padding: 4px 10px;
    text-transform: capitalize;
  }

  .status.pendente {
    background-color: #fbbf24;
    color: #0f172a;
    box-shadow: 0 0 10px rgba(251, 191, 36, 0.5);
  }

  .status.pago {
    background-color: #22c55e;
    color: #fff;
  }

  .status.cancelado {
    background-color: #ef4444;
    color: #fff;
  }

  .bilhete-actions {
    display: flex;
    justify-content: end;
    gap: 0.6rem;
  }

  .bilhete-actions button {
    border-radius: 10px;
    transition: all 0.2s ease;
  }

  .bilhete-actions button:hover {
    transform: scale(1.05);
  }

  .btn-excluir {
  color: #f1f5f9; /* branco suave */
  border-color: #334155; /* borda sutil cinza-azulada */
  background-color: transparent;
  transition: all 0.3s ease;
}

.btn-excluir:hover {
  color: #fff;
  background-color: #b91c1c; /* vermelho elegante */
  border-color: #b91c1c;
  box-shadow: 0 0 10px rgba(185, 28, 28, 0.5);
  transform: translateY(-1px);
}

.btn-excluir i {
  transition: transform 0.25s ease;
}

.btn-excluir:hover i {
  transform: rotate(-10deg);
}

</style>

<div class="container py-5">
  <!-- 🔖 Cabeçalho -->
  <div class="header-title mb-4">
    <i class="fa-solid fa-ticket"></i> Meus Bilhetes
  </div>

  <!-- 📊 Estatísticas -->
  <div class="stats-card mb-3">
    <div>
      <small>Pendente</small>
      <strong>{{ $bilhetes->where('status', 'pendente')->count() }}</strong>
    </div>
    <div>
      <small>Total de Bilhetes</small>
      <div class="number">{{ $bilhetes->count() }}</div>
    </div>
    <div>
      <small>Bilhetes Ganhos</small>
      <div class="number text-success">{{ $bilhetes->where('status', 'ganho')->count() }}</div>
    </div>
  </div>

  <!-- 🔍 Barra de pesquisa e filtro -->
<div class="d-flex flex-wrap align-items-center gap-2 mb-3">

  <!-- Busca -->
  <div class="search-container">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input 
      type="text" 
      class="search-input" 
      placeholder="Buscar bilhete ou nome..."
      name="busca"
      value="{{ request('busca') }}"
    >
  </div>

  <!-- Botão Select -->
  <div class="dropdown-wrapper">
    <button 
      type="button" 
      class="btn status-filter d-flex align-items-center gap-2"
      id="btnFiltroStatus"
    >
      <i class="fa-solid fa-filter"></i> 
      <span id="textoStatus">Todos os Status</span>
    </button>

    <!-- MENU DROPDOWN -->
    <div id="menuStatus" class="status-menu">
      <button data-value="todos">Todos os Status</button>
      <button data-value="pendente">Pendente</button>
      <button data-value="confirmado">Confirmado</button>
      <button data-value="cancelado">Cancelado</button>
    </div>

    <!-- INPUT QUE MANDA PRO BACK-END -->
    <input type="hidden" name="status" id="inputStatus" value="{{ request('status', 'todos') }}">
  </div>
</div>


  <!-- 🎟️ Lista de bilhetes ou estado vazio -->
  @if($bilhetes->isEmpty())
    <div class="empty-state">
      <i class="fa-solid fa-ticket"></i>
      <h5>Nenhum bilhete encontrado</h5>
      <p>Você ainda não comprou nenhum bilhete. Participe de um bolão e faça sua primeira aposta!</p>
    </div>
  @else
    @foreach($bilhetes as $bilhete)

<div class="bilhete-card">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <div>
      <strong>🎟️ Bilhete #{{ $bilhete->id }}</strong>
      <div><small class="text-secondary">Criado em {{ $bilhete->created_at->format('d/m/Y H:i') }}</small></div>
    </div>
    <span class="status {{ strtolower($bilhete->status) }}">
      {{ ucfirst($bilhete->status) }}
    </span>
  </div>

  <div class="mt-2 mb-3">
    <div><small>Combinações:</small><br><strong>{{ $bilhete->combinacoes_compactadas }}</strong></div>
    <div class="mt-2">
      <small>Valor Total:</small>
      <strong>R$ {{ number_format($bilhete->valor_total, 2, ',', '.') }}</strong><br>
      <small><strong>(7 Secos; 1 Duplo; 0 Triplos)</strong></small>
    </div>
  </div>

  <div class="bilhete-actions">
    <!-- Botão Editar -->
 

    <button 
    class="btn btn-outline-warning btn-sm abrirAposta"

  data-id="{{ $bilhete->rodada_id }}"
  data-editar="true"
  data-carrinho-id="{{ $bilhete->id }}"
  data-combinacao="{{ $bilhete->combinacoes_compactadas }}">
 <i class="fa-solid fa-pen-to-square"></i>
</button>


    <!-- Botão Pagar (só se estiver pendente) -->
    @if(strtolower($bilhete->status) === 'pendente')
      <button class="btn btn-success btn-sm" title="Pagar agora">
        <i class="fa-solid fa-credit-card"></i> Pagar
      </button>
    @endif

    <!-- Botão Visualizar Detalhes -->
<button 
  class="btn btn-outline-light btn-sm btn-excluir" 
  title="Excluir"
  data-id="{{ $bilhete->id }}">
  <i class="fa-solid fa-trash"></i>
</button>


  </div>
</div>


    @endforeach
  @endif
</div>



<script>


document.getElementById("btnFiltroStatus").addEventListener("click", () => {
    document.getElementById("menuStatus").style.display =
        document.getElementById("menuStatus").style.display === "flex"
        ? "none"
        : "flex";
});

// Selecionar item
document.querySelectorAll("#menuStatus button").forEach(btn => {
    btn.addEventListener("click", () => {

        let texto = btn.innerText;
        let valor = btn.getAttribute("data-value");

        document.getElementById("textoStatus").innerText = texto;
        document.getElementById("inputStatus").value = valor;

        // Fecha o menu após selecionar
        document.getElementById("menuStatus").style.display = "none";
    });
});

// Fechar dropdown ao clicar fora
document.addEventListener("click", function(e) {
    if (!document.querySelector(".dropdown-wrapper").contains(e.target)) {
        document.getElementById("menuStatus").style.display = "none";
    }
});







document.addEventListener('click', function (e) {
  const botao = e.target.closest('.btn-excluir');
  if (!botao) return;

  e.preventDefault(); // impede comportamento padrão

  const id = botao.dataset.id;

  if (!confirm('Tem certeza que deseja excluir este bilhete?')) return;

  fetch(`/carrinho/${id}/excluir`, {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      'Accept': 'application/json'
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('Bilhete excluído com sucesso!');
      location.reload();
    } else {
      alert(data.message || 'Erro ao excluir o bilhete.');
    }
  })
  .catch(error => {
    console.error(error);
    alert('Erro inesperado ao tentar excluir o bilhete.');
  });
});
</script>

@include('Paginas.User.Modal.ModalAposta')
@include('Paginas.User.Modal.ModalIndicacao')
@endsection
