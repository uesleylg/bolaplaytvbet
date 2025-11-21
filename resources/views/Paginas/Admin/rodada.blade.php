@extends('Layout/Admin/AppAdmin')

@section('title', 'BolaPlay Bet')

@section('title-menu')

@endsection

@section('content')

<style>
    /* ---------- EFEITOS ---------- */
    .card-hover {
        transition: all 0.28s ease-in-out;
    }
    .card-hover:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 28px rgba(0, 0, 0, 0.45);
    }

    /* Inputs Modernos 2025 */
    .input-modern,
    .select-modern {
        background: rgba(30, 30, 40, 0.85);
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 14px !important;
        color: #fff !important;
        padding: 12px 14px !important;
        transition: 0.25s ease-in-out;
    }
    .input-modern:focus,
    .select-modern:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.35);
    }

    /* Título Premium */
    .titulo-modern {
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: 1px;
        color: #e4e4e9;
    }

    .badge-modern {
        font-size: 0.75rem;
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 700;
    }

    .card-modern {
        background: linear-gradient(145deg, #0f172a, #1e293b);
        border: 1px solid rgba(255, 255, 255, 0.04);
    }
</style>





<div class="container-fluid" style="margin-top:50px;">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-light fw-bold mb-0">
            <i class="fas fa-trophy me-2"></i> Rodadas
        </h2>
        <button data-bs-toggle="modal" data-bs-target="#ModalCadastroRodada" class="btn btn-primary btn-lg rounded-3 shadow-sm">
            <i class="fas fa-plus me-2"></i> Criar Rodada
        </button>
    </div>
<form method="GET" action="{{ route('admin.cadastro.rodada') }}" class="row g-3 align-items-end mb-4">

  <!-- Busca -->
  <div class="col-12 col-md-4">
    <div class="input-group">
      <span class="input-group-text bg-dark border-0 text-primary">
        <i class="fas fa-search"></i>
      </span>
      <input 
        type="text" 
        name="busca" 
        value="{{ request('busca') }}"
        class="form-control input-modern" 
        placeholder="Buscar rodada por ID ou nome">
    </div>
  </div>

  <!-- Status -->
  <div class="col-6 col-md-3">
    <select name="status" class="form-select select-modern">
      <option value="">Status (todos)</option>
      <option value="Ativo" {{ request('status')=='Ativo' ? 'selected' : '' }}>Ativo</option>
      <option value="Pendente" {{ request('status')=='Pendente' ? 'selected' : '' }}>Pendente</option>
      <option value="Cancelado" {{ request('status')=='Cancelado' ? 'selected' : '' }}>Cancelado</option>
    </select>
  </div>

  <!-- Ordenação -->
  <div class="col-6 col-md-3">
    <select name="ordenar" class="form-select select-modern">
      <option value="">Ordenar por</option>
      <option value="recentes" {{ request('ordenar')=='recentes' ? 'selected' : '' }}>Recentes</option>
      <option value="antigos" {{ request('ordenar')=='antigos' ? 'selected' : '' }}>Antigos</option>
    </select>
  </div>

  <!-- Botões -->
  <div class="col-12 col-md-2 d-flex gap-2">
    <a href="{{ route('admin.cadastro.rodada') }}" class="btn btn-outline-light flex-fill rounded-3">
      <i class="fas fa-rotate"></i>
    </a>

    <button type="submit" class="btn btn-primary flex-fill rounded-3 fw-semibold">
      <i class="fas fa-filter me-1"></i> Filtrar
    </button>
  </div>

</form>



<div class="row g-4">
  @forelse ($rodadas as $rodada)
    <div class="col-md-6 col-lg-4">
      <div class="card shadow-lg border-0 rounded-4 overflow-hidden bg-dark text-light position-relative card-hover">

        <!-- Badge de status -->
        <span class="badge 
          @if($rodada->status === 'Ativo') bg-success 
          @elseif($rodada->status === 'Pendente') bg-warning text-dark
          @elseif($rodada->status === 'Encerrada') bg-secondary
          @else bg-danger @endif
          fw-semibold position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill shadow-sm">
        <b>   {{ strtoupper($rodada->status) }} </b>
        </span>

        <div class="card-body p-4">
          <!-- Título -->
          <h5 class="card-title fw-bold text-light mb-3">
            <i class="fa-solid fa-flag-checkered me-2 text-primary"></i>
            {{ $rodada->nome }}
          </h5>

          <!-- Informações principais -->
          <ul class="list-unstyled small mb-4">
            <li class="mb-2">
              <i class="fas fa-gift me-2 text-warning"></i>
              <span class="text-light">Prêmio:</span> {{ 'R$' . number_format($rodada->premiacao_estimada, 2, ',', '.') }}
            </li>
            <li class="mb-2">
              <i class="fas fa-calendar-alt me-2 text-info"></i>
              <span class="text-light">Início:</span> 
              {{ \Carbon\Carbon::parse($rodada->data_inicio)->format('d/m/Y H:i') }}
            </li>
            <li>
              <i class="fas fa-calendar-check me-2 text-success"></i>
              <span class="text-light">Fim:</span> 
              {{ \Carbon\Carbon::parse($rodada->data_fim)->format('d/m/Y H:i') }}
            </li>
          </ul>

          <!-- Linha divisória -->
          <hr class="border-secondary mb-3">

      <!-- Botões de ação -->
<div class="d-flex flex-column gap-2 mt-3">

    {{-- Linha 1: Ações principais (lado a lado) --}}
    <div class="d-flex gap-2 flex-wrap">

        @if ($rodada->status === 'Pendente')
            <button 
                data-bs-toggle="modal" 
                data-bs-target="#ModalJogosRodada"  
                class="btn btn-outline-info btn-sm rounded-pill px-3 fw-semibold shadow-sm flex-fill"
                data-id="{{ $rodada->id }}">
                <i class="fas fa-futbol me-1"></i> ADD Jogos
            </button>

        @elseif ($rodada->status === 'Ativo')
            <button 
                data-bs-toggle="modal" 
                data-bs-target="#ModalVerJogosRodada"  
                class="btn btn-outline-info btn-sm rounded-pill px-3 fw-semibold shadow-sm flex-fill"
                data-id="{{ $rodada->id }}">
                <i class="fas fa-futbol me-1"></i> Ver Jogos
            </button>
        @endif

        <button 
            class="btn btn-outline-warning btn-sm rounded-pill px-3 fw-semibold shadow-sm flex-fill btn-editar-rodada"
            data-id="{{ $rodada->id }}"
            data-nome="{{ $rodada->nome }}"
            data-valor="{{ $rodada->valor_bilhete }}"
            data-premiacao="{{ $rodada->premiacao_estimada }}"
            data-descricao="{{ $rodada->descricao }}"
            data-inicio="{{ \Carbon\Carbon::parse($rodada->data_inicio)->format('Y-m-d\TH:i') }}"
            data-fim="{{ \Carbon\Carbon::parse($rodada->data_fim)->format('Y-m-d\TH:i') }}"
            data-modo="{{ $rodada->modo_jogo }}"
            data-num="{{ $rodada->num_palpites }}"
            data-multiplas="{{ $rodada->multiplas }}"
            data-bs-toggle="modal" 
            data-bs-target="#ModalCadastroRodada">
            <i class="fas fa-pen me-1"></i> Editar
        </button>

        <button 
            class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-semibold shadow-sm flex-fill"
            data-bs-toggle="modal" 
            data-bs-target="#modalExcluirRodada"
            data-id="{{ $rodada->id }}">
            <i class="fas fa-trash me-1"></i> Excluir
        </button>

    </div>

    {{-- Linha 2: Add Auditoria (somente em Ativo) --}}
    @if ($rodada->status === 'Ativo')
     <button 
    class="btn btn-outline-primary btn-sm rounded-pill fw-semibold shadow-sm btn-add-auditoria w-100"
    data-bs-toggle="modal" 
    data-bs-target="#ModalAddAuditoria"
    data-id="{{ $rodada->id }}"
    data-link="{{ $rodada->link_auditoria }}">
    <i class="fa-solid fa-shield-halved me-1"></i> Add Auditoria
</button>

    @endif

</div>

        </div>
      </div>
    </div>
  @empty
    <div class="col-12 text-center text-light py-5">
      <i class="fa-solid fa-circle-info me-2"></i> Nenhuma rodada cadastrada ainda.
    </div>
  @endforelse
</div>

    </div>






<div class="modal fade" id="modalExcluirRodada" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-slate text-light border-0 rounded-4 shadow-lg">
      
      <div class="modal-header border-0">
        <h5 class="modal-title">
          <i class="fa-solid fa-triangle-exclamation text-danger me-2"></i>
          Confirmar Exclusão
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p class="mb-0">Tem certeza que deseja excluir esta rodada?<br> Esta ação não poderá ser desfeita.</p>
      </div>

      <div class="modal-footer border-0 d-flex justify-content-between">
        <button type="button" class="btn btn-outline-secondary rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">
          Cancelar
        </button>

        <form id="formExcluirRodada" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger rounded-pill px-4 fw-semibold shadow-sm">
            Excluir
          </button>
        </form>
      </div>
    </div>
  </div>
</div>



<script>
  // Quando o modal for aberto...
document.addEventListener('click', function(e) {

    const btn = e.target.closest('.btn-add-auditoria');

    if (btn) {
        let rodadaId = btn.getAttribute('data-id');
        let link = btn.getAttribute('data-link') || "";

        // Preenche o ID oculto
        document.getElementById('auditoriaRodadaId').value = rodadaId;

        // Preenche o input com o link atual (ou vazio)
        document.getElementById('inputLinkAuditoria').value = link;
    }
});


  document.addEventListener('DOMContentLoaded', function () {
    const modalExcluir = document.getElementById('modalExcluirRodada');
    const formExcluir = document.getElementById('formExcluirRodada');

    modalExcluir.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget; // botão que abriu o modal
      const rodadaId = button.getAttribute('data-id');

      // Define a action dinâmica
      formExcluir.action = `/admin/rodadas/${rodadaId}`;
    });
  });
</script>


@include('Paginas.Admin.Modal.ModalAddAuditoria')
@include('Paginas.Admin.Modal.ModalVerJogos')
@include('Paginas.Admin.Modal.ModalJogosRodada')
@include('Paginas.Admin.Modal.ModalCriarRodada')
@endsection

