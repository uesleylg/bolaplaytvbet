@extends('Layout/User/App')

@section('title', 'BolaPlay Bet')

@section('content')
@include('Slide.SlidePadrao')

<style>
 .bilhete-status-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Pill de status */
.status-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 999px;
    font-size: 0.85rem;
    font-weight: 600;
}

/* Aguardando */
.status-pill.aguardando {
    background: #334155;
    color: #e5e7eb;
}

/* Ações em ícone */
.icon-action {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #1e293b;
    color: #cbd5f5;
    border: 1px solid #334155;
    transition: all 0.25s ease;
}

.icon-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 0 10px rgba(250, 204, 21, 0.3);
    color: #facc15;
    border-color: #facc15;
}

/* Diferenciação sutil */
.icon-action.info:hover {
    color: #38bdf8;
    border-color: #38bdf8;
}

.icon-action.ranking:hover {
    color: #a78bfa;
    border-color: #a78bfa;
}


/* Botão (parecendo select) */
.status-filter {
    background-color: #1e293b;
    color: white;
    border: 2px solid #334155;
    border-radius: 12px;
    padding: 18px;
    display: inline-flex;
    align-items: center; /* alinha o conteúdo verticalmente */
    gap: 8px;
    transition: all 0.3s ease;
    line-height: 1; /* evita que o ícone “suba” */
}

.status-filter:hover {
    border-color: #facc15;
    box-shadow: 0 0 10px #facc15;
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

/* Ícone dentro do input de busca */
.search-container i {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 1.1rem;
}

/* Ícone dentro do botão do filtro */
.status-filter i {
    position: static; /* garante que não sobreponha o texto */
    transform: none;  /* remove transform do input */
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
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
      <div class="number text-success">
    {{ $bilhetes->filter(function($b) {
        return $b->bilhete && $b->bilhete->status === 'ganho';
    })->count() }}
</div>

    </div>
  </div>
<!-- 🔍 Barra de pesquisa e filtro -->
<form method="GET" class="d-flex flex-wrap align-items-center gap-2 mb-3 search-container" action="{{ route('bilhete.index') }}">

  <!-- Busca -->
  <div class="search-container">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input 
      type="text" 
      class="search-input" 
      placeholder="Buscar bilhete"
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
  <span id="textoStatus">
    @php
        $statusTexto = [
            'todos' => 'Todos os Status',
            'pendente' => 'Pendente',
            'aguardando-pago' => 'Aguardando',
            'ganhos' => 'Ganhos'
        ];
    @endphp
    {{ $statusTexto[request('status', 'todos')] }}
  </span>
</button>

    <!-- MENU DROPDOWN -->
    <div id="menuStatus" class="status-menu">
      <button type="button" data-value="todos">Todos os Status</button>
      <button type="button" data-value="pendente">Pendente</button>
      <button type="button" data-value="aguardando-pago">Aguardando</button>
      <button type="button" data-value="ganhos">Ganhos</button>
    </div>

    <!-- INPUT ESCONDIDO -->
    <input type="hidden" name="status" id="inputStatus" value="{{ request('status', 'todos') }}">
  </div>

</form>



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
 



    <!-- Botão Pagar (só se estiver pendente) -->
@if(strtolower($bilhete->status) === 'pendente')
    <button 
    class="btn btn-outline-warning btn-sm abrirAposta"

  data-id="{{ $bilhete->rodada_id }}"
  data-editar="true"
  data-carrinho-id="{{ $bilhete->id }}"
  data-combinacao="{{ $bilhete->combinacoes_compactadas }}">
 <i class="fa-solid fa-pen-to-square"></i>
</button>


  <button 
    class="btn btn-success btn-sm btn-pagar"
    data-carrinho-id="{{ $bilhete->id }}">
    <i class="fa-solid fa-credit-card"></i> Pagar
  </button>

      <!-- Botão Visualizar Detalhes -->
<button 
  class="btn btn-outline-light btn-sm btn-excluir" 
  title="Excluir"
  data-id="{{ $bilhete->id }}"
  data-bs-toggle="modal"
  data-bs-target="#ModalExcluirBilhete">
  <i class="fa-solid fa-trash"></i>
</button>

@endif

@if($bilhete->status === 'pago')

    @if($bilhete->bilhete)

        @switch($bilhete->bilhete->status)

            @case('ganho')
     <div class="d-flex align-items-center gap-2">
    <!-- Badge existente -->
    <span class="badge bg-success rounded-pill px-4 py-2 d-flex align-items-center">
        <i class="fa-solid fa-trophy me-1"></i>
        Bilhete Ganhador
    </span>

   
    <a href="{{ route('ranking.index', $bilhete->rodada_id) }}" class="btn btn-ranking d-flex align-items-center gap-1">
        <i class="fa-solid fa-chart-line"></i>
        Ver Ranking
    </a>
</div>

                @break

            @case('perdido')
               <div class="d-flex align-items-center gap-2">
                <span class="badge bg-danger rounded-pill px-4 py-2">
                    <i class="fa-solid fa-xmark me-1"></i>
                    Bilhete Perdido
                </span>

                  <a href="{{ route('ranking.index', $bilhete->rodada_id) }}" class="btn btn-ranking d-flex align-items-center gap-1">
        <i class="fa-solid fa-chart-line"></i>
        Ver Ranking
    </a>
                </div>
                @break

            @default
          <div class="bilhete-status-actions">

    <span class="status-pill aguardando">
        <i class="fa-solid fa-hourglass-half"></i>
        Aguardando resultado
    </span>

<button
    type="button"
    class="icon-action info btn-ver-bilhete ranking-row"
    title="Ver bilhete"
    data-bs-toggle="modal"
    data-bs-target="#ModalAposta"

    data-codigo="{{ $bilhete->bilhete->codigo_bilhete ?? $bilhete->id }}"
    data-usuario="{{ auth()->user()->name }}"
    data-data="{{ $bilhete->created_at->format('d/m/Y H:i') }}"
    data-valor="{{ number_format($bilhete->valor_total, 2, ',', '.') }}"

    {{-- 🔥 AGORA VEM DO CARRINHO --}}
    data-apostas='@json($bilhete->apostas_formatadas ?? [])'
>
    <i class="fa-solid fa-eye"></i>
</button>



    <a 
        href="{{ route('ranking.index', $bilhete->rodada_id) }}" 
        class="icon-action ranking"
        title="Ver ranking"
    >
        <i class="fa-solid fa-chart-line"></i>
    </a>

</div>


        @endswitch

    @else
  <div class="bilhete-status-actions">

    <span class="status-pill aguardando">
        <i class="fa-solid fa-hourglass-half"></i>
        Aguardando resultado
    </span>

    <a 
        href="" 
        class="icon-action info"
        title="Ver bilhete"
    >
        <i class="fa-solid fa-eye"></i>
    </a>

    <a 
        href="{{ route('ranking.index', $bilhete->rodada_id) }}" 
        class="icon-action ranking"
        title="Ver ranking"
    >
        <i class="fa-solid fa-chart-line"></i>
    </a>

</div>

    @endif

@endif


  </div>
</div>


    @endforeach
  @endif
</div>



<script>





document.getElementById("btnFiltroStatus").addEventListener("click", () => {
    const menu = document.getElementById("menuStatus");
    menu.style.display = menu.style.display === "flex" ? "none" : "flex";
});

// Selecionar item do dropdown e submeter o form
document.querySelectorAll("#menuStatus button").forEach(btn => {
    btn.addEventListener("click", () => {
        let texto = btn.innerText;
        let valor = btn.getAttribute("data-value");

        document.getElementById("textoStatus").innerText = texto;
        document.getElementById("inputStatus").value = valor;

        // Fecha o menu
        document.getElementById("menuStatus").style.display = "none";

        // Submete o form automaticamente
        btn.closest('form').submit();
    });
});

// Fechar dropdown ao clicar fora
document.addEventListener("click", function(e) {
    if (!document.querySelector(".dropdown-wrapper").contains(e.target)) {
        document.getElementById("menuStatus").style.display = "none";
    }
});




</script>





<script>
document.querySelectorAll('.btn-pagar').forEach(btn => {
  btn.addEventListener('click', function () {

    let carrinhoId = this.dataset.carrinhoId;

    // Abrir o modal existente
    const modal = new bootstrap.Modal(document.getElementById('ModalPix'));
    modal.show();

    // Estados visuais
    document.getElementById('pixLoading').style.display = 'block';
    document.getElementById('pixContent').style.display = 'none';

    // Limpar dados antigos
    document.getElementById('pixQrImg').src = '';
    document.getElementById('pixCopiaCola').value = '';
    document.getElementById('pixValor').innerText = '';

    fetch("{{ route('gerar.pix') }}", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": "{{ csrf_token() }}"
      },
      body: JSON.stringify({
        carrinho_ids: [carrinhoId]
      })
    })
    .then(res => res.json())
    .then(data => {

      if (!data.success) {
        alert('Erro ao gerar PIX');
        return;
      }

      // Preencher modal
      document.getElementById('pixQrImg').src =
        'data:image/png;base64,' + data.qr;

      document.getElementById('pixCopiaCola').value = data.copia_cola;

      document.getElementById('pixValor').innerText =
        'R$ ' + data.valor.toFixed(2).replace('.', ',');

      // Mostrar conteúdo
      document.getElementById('pixLoading').style.display = 'none';
      document.getElementById('pixContent').style.display = 'block';

    })
    .catch(() => {
      alert('Erro na comunicação com o servidor');
    });
  });
});

// Copiar PIX
function copiarPix() {
  const campo = document.getElementById('pixCopiaCola');
  campo.select();
  campo.setSelectionRange(0, 99999);
  document.execCommand('copy');
}
</script>




@include('Paginas.User.Modal.ModalBilhete')
@include('Paginas.User.Modal.ModalExclusaoBilhete')
@include('Paginas.User.Modal.ModalAposta')
@include('Paginas.User.Modal.ModalIndicacao')
@endsection
