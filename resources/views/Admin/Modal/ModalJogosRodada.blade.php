<div class="modal fade" id="ModalJogosRodada" tabindex="-1" aria-labelledby="ModalJogosRodada" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content" style="border-radius: 14px; background-color: #ffffff; color: #1e293b; box-shadow: 0 8px 24px rgba(0,0,0,0.15);">

      <!-- Cabeçalho -->
      <div class="modal-header border-0" style="background-color:#1e293b; color:white; border-top-left-radius: 14px; border-top-right-radius: 14px;">
        <h5 class="modal-title fw-semibold">
          <i class="fa-solid fa-calendar-days me-2 text-primary"></i> Jogos disponíveis
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <!-- Corpo -->
      <div class="modal-body p-4">
        <!-- Filtro por data -->

      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
  <div class="mb-3 mb-md-0">
    <label for="dataJogos" class="form-label fw-semibold text-secondary mb-1">
      <i class="fa-regular fa-calendar me-1"></i> Escolha a data
    </label>
    <div class="input-group" style="max-width: 220px;">
      <span class="input-group-text bg-primary text-white">
        <i class="fa-regular fa-calendar-days"></i>
      </span>
      <input type="date" id="dataJogos" class="form-control border-0 shadow-sm">
    </div>
  </div>

  <div class="text-muted small">
    <i class="fa-regular fa-clock me-1"></i> Atualizado em 
    <span id="dataAtualizacao" class="fw-bold text-light"></span>
  </div>
</div>

<!-- Lista dinâmica de jogos -->
<div id="listaJogos" class="list-group"></div>

<script>
async function carregarJogosPorData(dataEscolhida) {
  const lista = document.getElementById('listaJogos');
  lista.innerHTML = '<p class="text-center text-secondary mt-3">Carregando jogos...</p>';

  try {
    const response = await fetch('http://127.0.0.1:8000/api/jogos-uol');
    const data = await response.json();

    const equipes = data.equipes || {};
    const jogosArray = data.jogos ? Object.values(data.jogos) : [];

    // Filtra jogos pela data
    const jogosFiltrados = jogosArray.filter(jogo => jogo.data === dataEscolhida);

    if (jogosFiltrados.length === 0) {
      lista.innerHTML = '<p class="text-center text-muted mt-3">Não há jogos para esta data.</p>';
      return;
    }

    // Monta os jogos
    const html = jogosFiltrados.map(jogo => {
      const time1 = equipes[jogo.time1] || {};
      const time2 = equipes[jogo.time2] || {};

      const time1Nome = time1['nome-completo'] || 'Desconhecido';
      const time2Nome = time2['nome-completo'] || 'Desconhecido';

      const time1Brasao = time1.brasao ? time1.brasao.replace('40x40', '100x100') : '';
      const time2Brasao = time2.brasao ? time2.brasao.replace('40x40', '100x100') : '';

      const icone1 = time1Brasao
        ? `<img src="${time1Brasao}" width="28" class="me-2 rounded-circle border border-secondary">`
        : '<i class="fa-solid fa-shield-halved me-2 text-danger"></i>';

      const icone2 = time2Brasao
        ? `<img src="${time2Brasao}" width="28" class="ms-2 rounded-circle border border-secondary">`
        : '<i class="fa-solid fa-shield-halved ms-2 text-success"></i>';

      const estadio = jogo.local || 'Local não informado';
      const horario = jogo.horario || 'Horário indefinido';
      const competicao = jogo.competicao || 'Competição desconhecida';

      return `
        <div class="list-group-item d-flex justify-content-between align-items-center bg-dark border-secondary rounded-3 mb-2 p-3 shadow-sm">
          <div>
            <div class="fw-bold text-light d-flex align-items-center">
              ${icone1} ${time1Nome}
              <span class="text-secondary mx-2">vs</span>
              ${time2Nome} ${icone2}
            </div>
            <small class="text-muted">
              <i class="fa-regular fa-clock me-1"></i> ${horario} | ${estadio} <br>
              <i class="fa-solid fa-trophy me-1 text-warning"></i> ${competicao}
            </small>
          </div>
          <button class="btn btn-sm btn-primary rounded-pill px-3">
            <i class="fa-solid fa-plus me-1"></i> Selecionar
          </button>
        </div>
      `;
    }).join('');

    lista.innerHTML = html;

  } catch (error) {
    console.error('Erro ao carregar os jogos:', error);
    lista.innerHTML = '<p class="text-center text-danger mt-3">Erro ao carregar os jogos.</p>';
  }
}

// Atualiza data e evento de mudança
document.addEventListener('DOMContentLoaded', () => {
  const inputData = document.getElementById('dataJogos');
  const dataAtualizacao = document.getElementById('dataAtualizacao');

  const hoje = new Date().toISOString().split('T')[0];
  inputData.value = hoje;

  // Atualiza label de hora atual
  const agora = new Date();
  dataAtualizacao.textContent = agora.toLocaleString('pt-BR', {
    day: '2-digit', month: '2-digit', year: 'numeric',
    hour: '2-digit', minute: '2-digit'
  });

  carregarJogosPorData(hoje);

  inputData.addEventListener('change', (e) => {
    const novaData = e.target.value;
    carregarJogosPorData(novaData);
  });
});
</script>


      </div>

      <!-- Rodapé -->
      <div class="modal-footer border-0 d-flex justify-content-between align-items-center">
  <span id="dataSelecionada">{{ date('d/m/Y') }}</span></span>
        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">
          Fechar
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  // Atualiza o texto da data exibida quando o usuário escolhe outra
  document.getElementById('dataJogos').addEventListener('change', function() {
    const data = new Date(this.value);
    const formatada = data.toLocaleDateString('pt-BR');
    document.getElementById('dataSelecionada').innerText = formatada;
  });
</script>


<script>
  fetch('{{ route('api.jogos-uol') }}')
    .then(res => res.json())
    .then(data => {
      console.log(data);
    })
    .catch(err => console.error('Erro:', err));
</script>