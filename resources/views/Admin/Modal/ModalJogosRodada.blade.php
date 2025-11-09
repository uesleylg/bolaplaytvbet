<!-- Modal de Jogos da Rodada -->
<div class="modal fade" id="ModalJogosRodada" tabindex="-1" aria-labelledby="ModalJogosRodadaLabel" aria-hidden="true" data-rodada-id="">
  <div class="modal-dialog modal-dialog-centered modal-lg" style="max-height: 90vh;">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; background-color: #0d1117; color: #e2e8f0; max-height: 90vh; display: flex; flex-direction: column;">

      <!-- Cabeçalho -->
      <div class="modal-header border-0 py-3" style="background-color:#161b22; border-top-left-radius: 16px; border-top-right-radius: 16px;">
        <h5 class="modal-title fw-semibold" id="ModalJogosRodadaLabel">
          <i class="fa-solid fa-calendar-days me-2 text-primary"></i> Jogos disponíveis
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <!-- Área fixa (alert + select de país + select de data) -->
      <div class="p-4" style="flex-shrink: 0;">

        <!-- Alert -->
        <div id="alert-area"></div>

        <!-- Container flex para país e data -->
        <div class="d-flex justify-content-between align-items-center" style="gap: 20px; flex-wrap: wrap;">

          <!-- Select País -->
          <div class="flex-grow-1" style="max-width: 240px;">
            <label for="selectPais" class="form-label fw-semibold text-secondary mb-1">
              <i class="fa-solid fa-flag me-1"></i> Escolha o país
            </label>
            <select id="selectPais" class="form-select bg-dark text-light border-0 shadow-sm">
              <option value="BRASIL" selected>Brasil</option>
              <option value="ARGENTINA">Argentina</option>
              <option value="INGLATERRA">Inglaterra</option>
            </select>
          </div>

          <!-- Input Data -->
          <div class="flex-grow-1 text-end" style="max-width: 240px;">
            <label for="selectData" class="form-label fw-semibold text-secondary mb-1">
              <i class="fa-regular fa-calendar me-1"></i> Escolha a data
            </label>
            <input type="date" id="selectData" class="form-control bg-dark text-light border-0 shadow-sm" 
                   value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}">
          </div>

        </div>
      </div>

      <!-- Lista de jogos com scroll -->
      <div class="modal-body p-0" style="overflow-y: auto; flex: 1 1 auto;">
        <div id="listaJogos" class="list-group p-4"></div>
      </div>

      <!-- Rodapé fixo -->
<div class="modal-footer border-0 d-flex justify-content-between align-items-center px-4 py-3" style="background-color:#161b22; flex-shrink: 0;">
  <!-- Totais empilhados à esquerda -->
  <div class="d-flex flex-column">
    <span id="totalJogos" class="text-secondary small">Total de jogos: 0</span>
    <span id="jogosSelecionados" class="text-secondary small">Selecionados: 0</span>
  </div>

  <!-- Botão à direita -->
  <button type="button" id="btnCadastrarJogos" class="btn btn-warning rounded-pill px-4 fw-semibold">
    Cadastrar Jogos
  </button>
</div>

    </div>
  </div>
</div>

<script>
let rodadaAtualId = null;

// Função para exibir alert Bootstrap
function mostrarAlerta(mensagem, tipo = 'success', duracao = 5000) {
  const alertArea = document.getElementById('alert-area');
  const id = `alert-${Date.now()}`;
  const alertaHTML = document.createElement('div');
  alertaHTML.id = id;
  alertaHTML.className = `alert alert-${tipo} alert-dismissible fade show`;
  alertaHTML.role = 'alert';
  alertaHTML.innerHTML = `
    ${mensagem}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  `;
  alertArea.appendChild(alertaHTML);

  setTimeout(() => {
    const bsAlert = bootstrap.Alert.getOrCreateInstance(document.getElementById(id));
    bsAlert.close();
  }, duracao);
}

// Função para atualizar a contagem de selecionados
function atualizarSelecionados() {
  const selecionados = document.querySelectorAll('.jogo-item.selecionado').length;
  document.getElementById('jogosSelecionados').textContent = `Selecionados: ${selecionados}`;
}

// Carrega jogos por país e data
async function carregarJogos(pais, data) {
  const lista = document.getElementById('listaJogos');
  const totalJogosSpan = document.getElementById('totalJogos');
  const selecionadosSpan = document.getElementById('jogosSelecionados');
  lista.innerHTML = '<p class="text-center text-secondary mt-3">Carregando jogos...</p>';
  totalJogosSpan.textContent = 'Total de jogos: 0';
  selecionadosSpan.textContent = 'Selecionados: 0';

  try {
    const response = await fetch(`/admin/get/jogos?pais=${pais}&data=${data}`);
    if (!response.ok) throw new Error(`Erro ${response.status} ao buscar jogos.`);

    const dataJson = await response.json();
    const ligas = dataJson.ligas || {};
    let jogosTodos = [];

    Object.keys(ligas).forEach(liga => {
      ligas[liga].forEach(jogo => {
        jogosTodos.push({ ...jogo, liga });
      });
    });

    // Atualiza o total no rodapé
    totalJogosSpan.textContent = `Total de jogos: ${jogosTodos.length}`;

    if (jogosTodos.length === 0) {
      lista.innerHTML = '<p class="text-center text-muted mt-3">Não há jogos para este país/data.</p>';
      return;
    }

    lista.innerHTML = jogosTodos.map(jogo => {
      const mandanteImg = jogo.imagem_mandante ? `<img src="${jogo.imagem_mandante}" width="28" class="me-2 rounded-circle border border-secondary mandante-img">` : '';
      const visitanteImg = jogo.imagem_visitante ? `<img src="${jogo.imagem_visitante}" width="28" class="ms-2 rounded-circle border border-secondary visitante-img">` : '';

      return `
        <div class="list-group-item jogo-item d-flex justify-content-between align-items-center border-0 rounded-3 mb-3 p-3 shadow-sm" 
             data-id="${jogo.id_jogo}" 
             data-hora="${jogo.hora}" 
             data-data="${jogo.data}" 
             data-liga="${jogo.liga}" 
             style="background-color:#161b22; transition: all 0.3s ease;">
          <div>
            <div class="fw-semibold text-light d-flex align-items-center mb-1 mandante-nome">
              ${mandanteImg} ${jogo.mandante}
              <span class="text-secondary mx-2">vs</span>
              ${jogo.visitante} <span class="visitante-nome">${visitanteImg}</span>
            </div>
            <small class="text-muted">
              <i class="fa-regular fa-clock me-1"></i> ${jogo.hora} | 
              <i class="fa-solid fa-trophy me-1 text-warning"></i> ${jogo.liga}
            </small>
          </div>
          <button class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold btn-selecionar">
            <i class="fa-solid fa-plus me-1"></i> Selecionar
          </button>
        </div>
      `;
    }).join('');

    // Botões selecionar
    document.querySelectorAll('.btn-selecionar').forEach(btn => {
      btn.addEventListener('click', () => {
        const jogoItem = btn.closest('.jogo-item');
        const selecionado = jogoItem.classList.toggle('selecionado');
        if (selecionado) {
          btn.innerHTML = '<i class="fa-solid fa-check me-1"></i> Selecionado';
          btn.classList.replace('btn-outline-primary', 'btn-success');
          jogoItem.style.backgroundColor = '#0d6efd20';
          jogoItem.style.border = '1px solid #0d6efd';
        } else {
          btn.innerHTML = '<i class="fa-solid fa-plus me-1"></i> Selecionar';
          btn.classList.replace('btn-success', 'btn-outline-primary');
          jogoItem.style.backgroundColor = '#161b22';
          jogoItem.style.border = 'none';
        }
        atualizarSelecionados();
      });
    });

  } catch (error) {
    console.error('Erro ao carregar os jogos:', error);
    mostrarAlerta('Erro ao carregar os jogos.', 'danger');
    lista.innerHTML = '<p class="text-center text-danger mt-3">Erro ao carregar os jogos.</p>';
  }
}

// Abre o modal e define rodadaAtualId
const modalJogos = document.getElementById('ModalJogosRodada');
modalJogos.addEventListener('show.bs.modal', function (event) {
  const button = event.relatedTarget;
  rodadaAtualId = button.getAttribute('data-id');
  modalJogos.dataset.rodadaId = rodadaAtualId;

  const selectPais = document.getElementById('selectPais');
  const selectData = document.getElementById('selectData');
  carregarJogos(selectPais.value, selectData.value);
});

// Mudança de país ou data
document.addEventListener('DOMContentLoaded', () => {
  const selectPais = document.getElementById('selectPais');
  const selectData = document.getElementById('selectData');

  selectPais.addEventListener('change', () => {
    carregarJogos(selectPais.value, selectData.value);
  });

  selectData.addEventListener('change', () => {
    carregarJogos(selectPais.value, selectData.value);
  });
});

// Cadastrar jogos selecionados
document.getElementById('btnCadastrarJogos').addEventListener('click', async () => {
  if (!rodadaAtualId) {
    mostrarAlerta('Erro: nenhuma rodada selecionada.', 'danger');
    return;
  }

  const selecionados = Array.from(document.querySelectorAll('.jogo-item.selecionado'));
  if (selecionados.length === 0) {
    mostrarAlerta('Selecione ao menos um jogo para cadastrar.', 'warning');
    return;
  }

  const jogosPayload = selecionados.map(jogoEl => {
    const mandante = jogoEl.querySelector('.fw-semibold').textContent.split('vs')[0].trim();
    const visitante = jogoEl.querySelector('.fw-semibold').textContent.split('vs')[1].trim();
    const hora = jogoEl.dataset.hora;
    const data = jogoEl.dataset.data;
    const liga = jogoEl.dataset.liga;
    const idPartida = jogoEl.dataset.id;

    return {
      rodada_id: rodadaAtualId,
      id_partida: idPartida,
      time_casa_nome: mandante,
      time_fora_nome: visitante,
      time_casa_brasao: jogoEl.querySelector('.mandante-img')?.src || null,
      time_fora_brasao: jogoEl.querySelector('.visitante-img')?.src || null,
      data_jogo: `${data} ${hora}:00`,
      competicao: liga
    };
  });

  try {
    const response = await fetch('/admin/rodadas/jogos', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify(jogosPayload)
    });

    const result = await response.json();

    if (response.ok && result.success) {
      mostrarAlerta(result.message, 'success');
      const bsModal = bootstrap.Modal.getInstance(modalJogos);
      bsModal.hide();
      location.reload();
    } else {
      mostrarAlerta((result.message || 'Erro desconhecido.'), 'danger');
    }
  } catch (err) {
    console.error(err);
    mostrarAlerta('Erro ao cadastrar jogos.', 'danger');
  }
});
</script>
