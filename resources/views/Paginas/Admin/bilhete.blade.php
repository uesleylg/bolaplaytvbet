@extends('Layout/Admin/AppAdmin')

@section('title', 'Bilhetes')

@section('content')
<div class="container-fluid">

  <!-- Cabeçalho da página -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">🎟️ Gerenciamento de Bilhetes</h4>
  </div>

  <!-- Cards de estatísticas -->
  <div class="row g-3 mb-4">
    <div class="col-md-3">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Total de Bilhetes</small>
          <h4 class="fw-bold mb-0">{{ $totalBilhetes ?? 0 }}</h4>
        </div>
        <i class="fa-solid fa-ticket fa-2x text-primary"></i>
      </div>
    </div>

    <div class="col-md-3">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Abertos</small>
          <h4 class="fw-bold text-warning mb-0">{{ $totalAbertos ?? 0 }}</h4>
        </div>
        <i class="fa-solid fa-clock fa-2x text-warning"></i>
      </div>
    </div>

    <div class="col-md-3">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Ganhos</small>
          <h4 class="fw-bold text-success mb-0">{{ $totalGanhos ?? 0 }}</h4>
        </div>
        <i class="fa-solid fa-trophy fa-2x text-success"></i>
      </div>
    </div>

    <div class="col-md-3">
      <div class="stat-card p-3 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-muted">Perdidos</small>
          <h4 class="fw-bold text-danger mb-0">{{ $totalPerdidos ?? 0 }}</h4>
        </div>
        <i class="fa-solid fa-xmark-circle fa-2x text-danger"></i>
      </div>
    </div>
  </div>




<!-- ==========================
     FILTROS (adaptados)
========================== -->

<div class="card stat-card p-4 mb-4" style="background-color: #1b1f2a; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">

  <!-- Cabeçalho -->
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <h5 class="fw-bold mb-0 text-white">Lista de Bilhetes</h5>

    <button class="btn btn-outline-secondary btn-sm">
      <i class="fa-solid fa-rotate"></i> Atualizar
    </button>
  </div>

  <!-- Formulário de Filtro -->
  <form method="GET" action="" class="row g-3 align-items-end mb-4">

    <!-- Busca -->
    <div class="col-12 col-md-4">
      <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
        <span class="input-group-text bg-dark text-white border-0">
          <i class="fas fa-magnifying-glass"></i>
        </span>
        <input 
          type="text" 
          name="busca" 
          value="{{ request('busca') }}"
          class="form-control border-0 bg-dark text-white"
          placeholder="Buscar por ID ou código"
        >
      </div>
    </div>

    <!-- Status -->
    <div class="col-6 col-md-2">
      <select name="status" class="form-select bg-dark text-white border-0 shadow-sm" style="border-radius: 10px;">
        <option value="">Status (todos)</option>
        <option value="aberto"   {{ request('status')=='aberto' ? 'selected' : '' }}>Aberto</option>
        <option value="ganho"    {{ request('status')=='ganho' ? 'selected' : '' }}>Ganho</option>
        <option value="perdido"  {{ request('status')=='perdido' ? 'selected' : '' }}>Perdido</option>
        <option value="cancelado"{{ request('status')=='cancelado' ? 'selected' : '' }}>Cancelado</option>
      </select>
    </div>

    <!-- Carrinho -->
    <div class="col-6 col-md-2">
      <select name="carrinho" class="form-select bg-dark text-white border-0 shadow-sm" style="border-radius: 10px;">
        <option value="">Carrinho (todos)</option>

        @foreach($carrinhos as $carrinho)
          <option value="{{ $carrinho->id }}" {{ request('carrinho') == $carrinho->id ? 'selected' : '' }}>
            #{{ $carrinho->id }}
          </option>
        @endforeach
      </select>
    </div>

    <!-- Recentes -->
    <div class="col-6 col-md-2">
      <select name="recentes" class="form-select bg-dark text-white border-0 shadow-sm" style="border-radius: 10px;">
        <option value="">Recentes</option>
        <option value="hoje"  {{ request('recentes')=='hoje' ? 'selected' : '' }}>Hoje</option>
        <option value="7"     {{ request('recentes')=='7' ? 'selected' : '' }}>Últimos 7 dias</option>
        <option value="30"    {{ request('recentes')=='30' ? 'selected' : '' }}>Últimos 30 dias</option>
      </select>
    </div>

    <!-- Botões -->
    <div class="col-6 col-md-2 d-flex gap-2">
      <a href="" 
        class="btn btn-outline-light flex-fill">
        <i class="fas fa-rotate"></i> Limpar
      </a>

      <button type="submit" class="btn btn-primary flex-fill">
        <i class="fas fa-filter"></i> Aplicar
      </button>
    </div>

  </form>



  <!-- Tabela -->
  <div class="table-responsive">
    <table class="table table-borderless align-middle mb-0">
      <thead>
        <tr class="text-white">
          <th>ID</th>
          <th>Código</th>
          <th>Carrinho</th>
          <th>Usuário</th>
          <th>Prêmio</th>
          <th>Status</th>
          <th>Criado em</th>
          <th class="text-end">Ações</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($bilhetes as $bilhete)
        <tr class="text-white">
          <td>#{{ $bilhete->id }}</td>
          <td>{{ $bilhete->codigo_bilhete }}</td>
          <td>#{{ $bilhete->carrinho->id ?? '—' }}</td>
          <td>{{ $bilhete->carrinho->usuario->name ?? '—' }}</td>

          <td>
            @if ($bilhete->premio_recebido)
              <span class="text-success fw-bold">R$ {{ number_format($bilhete->premio_recebido, 2, ',', '.') }}</span>
            @else
              —
            @endif
          </td>

          <td>
            @if ($bilhete->status === 'aberto')
              <span class="badge bg-warning text-dark">Aberto</span>

            @elseif ($bilhete->status === 'ganho')
              <span class="badge bg-success">Ganho</span>

            @elseif ($bilhete->status === 'perdido')
              <span class="badge bg-danger">Perdido</span>

            @elseif ($bilhete->status === 'cancelado')
              <span class="badge bg-secondary">Cancelado</span>

            @endif
          </td>

          <td>{{ $bilhete->created_at->format('d/m/Y H:i') }}</td>

          <td class="text-end">

            <!-- Ver detalhes -->
  <a href="#"
   class="btn btn-sm btn-outline-info me-2 abrirModalBilhete"
   data-bs-toggle="modal"
   data-bs-target="#ModalAposta"

   data-id="{{ $bilhete->id }}"
   data-codigo="{{ $bilhete->codigo_bilhete }}"
   data-usuario="{{ $bilhete->carrinho->usuario->name }}"
   data-acertos="{{ $bilhete->acertos ?? 0 }}"
   data-total-jogos="{{ $bilhete->total_jogos ?? 0 }}"
   data-valor="{{ number_format($bilhete->carrinho->valor_total, 2, ',', '.') }}"
   data-data="{{ $bilhete->created_at->format('d/m/Y H:i') }}"
   data-apostas='@json($bilhete->apostas_formatadas)'
 >
  <i class="fa-solid fa-eye"></i>
</a>


            <!-- Excluir -->
            <button 
              data-bs-toggle="modal"
              data-bs-target="#ModalConfirmDelete"
              class="btn btn-sm btn-outline-danger"
              title="Excluir"
              data-id="{{ $bilhete->id }}"
              data-nome="Bilhete #{{ $bilhete->id }}">
              <i class="fa-solid fa-trash"></i>
            </button>

          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>

</div>
@include('Paginas.Admin.Modal.ModalBilhete')
<script>

document.addEventListener("click", function (e) {

    const btn = e.target.closest(".abrirModalBilhete");
    if (!btn) return;

    // Cabeçalho
    document.getElementById("modalTitulo").innerText = "Bilhete " + btn.dataset.codigo;
    document.getElementById("modalResumo").innerText = `${btn.dataset.acertos} acertos de ${btn.dataset.total} jogos`;
    document.getElementById("modalResumo2").innerText = `${btn.dataset.acertos}/${btn.dataset.total}`;

    // Dados gerais
    document.getElementById("modalComprador").innerText = btn.dataset.usuario;
    document.getElementById("modalAcertos").innerText = `${btn.dataset.acertos} de ${btn.dataset.total}`;
    document.getElementById("modalData").innerText = btn.dataset.data;
    document.getElementById("modalValor").innerText = "R$ " + btn.dataset.valor;

    // Apostas (JSON)
    const apostas = JSON.parse(btn.dataset.apostas);

    let html = "";

    apostas.forEach((aposta, index) => {

        // STATUS → Ícone + Cor
        let icon = "";
        if (aposta.status === "acertou") {
            icon = `<i class="fa-solid fa-circle-check" style="font-size: 35px; color: rgb(16 185 129);"></i>`;
        } else if (aposta.status === "errou") {
            icon = `<i class="fa-solid fa-circle-xmark" style="font-size: 35px; color: red;"></i>`;
        } else {
            icon = `<i class="fa-solid fa-clock" style="font-size: 35px; color: rgb(179 179 179 / 78%);"></i>`;
        }

        // ======= TRADUÇÃO DA APOSTA =======
        let apostaTraduzida = "";
        if (aposta.aposta === "1") apostaTraduzida = "Casa";
        else if (aposta.aposta === "x") apostaTraduzida = "Empate";
        else if (aposta.aposta === "2") apostaTraduzida = "Fora";
        else apostaTraduzida = aposta.aposta;

        html += `
            <div class="card w-100 mb-2">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div class="d-flex align-items-start" style="text-align:left;">
                        <span style="font-size: 1.5rem; margin-right: 10px;">
                            ${icon}
                        </span>
                        <div>
                            <div style="font-weight: bold;">
                                JG ${index + 1} - (${aposta.status.toUpperCase()})
                            </div>
                            <div>${aposta.time_casa} vs ${aposta.time_fora}</div>
                        </div>
                    </div>

                    <div class="text-end">
                        <div style="font-size: 0.9rem; color: gray;">Aposta</div>
                        <div style="font-weight: bold;">${apostaTraduzida}</div>
                    </div>

                </div>
            </div>
        `;
    });

    document.getElementById("modalApostas").innerHTML = html;

});

</script>

@endsection