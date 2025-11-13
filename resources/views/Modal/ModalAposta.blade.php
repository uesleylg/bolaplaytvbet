

<div class="modal fade" id="ModalAposta" tabindex="-1" aria-labelledby="ModalAposta" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 10px;">
      
      <div class="modal-header" style="background-color:#1e293b; color:white;">
        <h5 class="modal-title"><i class="fa-solid fa-ticket"></i> Fazer aposta</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <div class="modal-body text-center" style="padding-inline: 0px; max-height: 90vh; overflow-y: auto;">

        <div class="container container-mobile">
          <!-- Botão limpar -->
          <div class="text-end mb-3 btt-limpar">
            <button class="btn btn-warning rounded-pill px-4 py-2 fw-semibold btt-font-limp">
              <i class="fa-solid fa-broom me-2"></i> Limpar apostas
            </button>
          </div>

          <!-- Cabeçalho colunas -->
          <div class="p-3 mb-2 cabe-aposta">
            <div class="d-flex justify-content-between text-center text-uppercase fw-semibold small text-light">
              <div style="width: 45%;">Mandante</div>
              <div style="width: 30%;">X</div>
              <div style="width: 45%;">Visitante</div>
            </div>
          </div>

          <!-- 🔹 Aqui os jogos serão inseridos -->
          <div id="jogos-container"></div>
          <br>
        </div>

        <!-- Rodapé com valores -->
        <div class="container container-mobile">
          <div class="bg-dark text-white border-0 shadow-lg rounded-4 p-4" style="margin-bottom: 15px; background: linear-gradient(145deg, #0f172a, #1e293b);">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="fw-bold mb-0 text-warning">
                <i class="bi bi-ticket-perforated me-2"></i>
                Aposta equivalente à <span class="text-white">1 bilhete(s)</span>
              </h5>
            </div>

            <div class="row text-center mb-3">
              <div class="col">
                <div class="fw-bold text-uppercase text-secondary small">Secos</div>
                <div class="fs-5 fw-bold text-light">0</div>
              </div>
              <div class="col">
                <div class="fw-bold text-uppercase text-secondary small">Duplos</div>
                <div class="fs-5 fw-bold text-light">0</div>
              </div>
              <div class="col">
                <div class="fw-bold text-uppercase text-secondary small">Triplos</div>
                <div class="fs-5 fw-bold text-light">0</div>
              </div>
            </div>

            <hr class="border-secondary opacity-50 my-3">

            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="fw-semibold text-secondary">Valor Apostado</span>
                <h4 class="fw-bold text-success mb-0 valor-total">R$ 10,00</h4>
            </div>

            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-semibold text-secondary">Premio Estimado</span>
              <h4 class="fw-bold text-warning mb-0">R$ 50.000,00</h4>
            </div>
          </div>

          <button type="button" class="btn btn-primary btt-conf">CONFIRMAR APOSTA</button>
        </div>
      </div>
    </div>
  </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    const modalAposta = document.getElementById('ModalAposta');
    const container = document.getElementById('jogos-container');
    const btnConfirmar = document.querySelector('.btt-conf');
    const btnLimpar = document.querySelector('.btt-limpar button');
    let carregando = false;
    let palpites = {};
    let jogosData = {};
    let valorBilhete = 0;
    let modoEdicao = false;
    let carrinhoEditando = null;
    let combinacaoOriginal = '';

    // 🔹 Quando o modal abrir
    modalAposta.addEventListener('show.bs.modal', async function(event) {
        const button = event.relatedTarget;
        const rodadaId = button?.getAttribute('data-id');
        const editar = button?.getAttribute('data-editar') === 'true';
        const carrinhoId = button?.getAttribute('data-carrinho-id');
        const combinacao = button?.getAttribute('data-combinacao');

        if (!rodadaId || carregando) return;

        window.rodadaSelecionada = rodadaId;
        modoEdicao = editar;
        carrinhoEditando = carrinhoId || null;
        combinacaoOriginal = combinacao || '';

        carregando = true;
        container.innerHTML = `<div class="p-3 text-secondary">⏳ Carregando jogos...</div>`;
        await carregarJogos(rodadaId);
        carregando = false;

        // Se estiver em modo edição → aplicar seleções anteriores
        if (modoEdicao && combinacaoOriginal) {
            aplicarCombinacaoAntiga(combinacaoOriginal);
        }

        // Alterar texto do botão
        btnConfirmar.textContent = modoEdicao ? 'ATUALIZAR APOSTA' : 'CONFIRMAR APOSTA';
        btnConfirmar.classList.toggle('btn-warning', modoEdicao);
    });

    // 🔹 Carregar jogos + odds externas
    async function carregarJogos(rodadaId) {
        try {
            const response = await fetch(`/rodadas/${rodadaId}/jogos`);
            const data = await response.json();

            if (!data.success) {
                container.innerHTML = `<div class="text-danger">Erro ao carregar jogos.</div>`;
                return;
            }

            valorBilhete = parseFloat(data.rodada.valor_bilhete);

            const oddsPromises = data.jogos.map(j => buscarOdds(j.id_partida));
            const oddsList = await Promise.all(oddsPromises);

            container.innerHTML = '';
            jogosData = {};
            palpites = {};

            data.jogos.forEach((jogo, index) => {
                const odds = oddsList[index];
                jogosData[jogo.id] = jogo;
                palpites[jogo.id] = [];

                const card = document.createElement('div');
                card.classList.add('p-0', 'mb-0');

                card.innerHTML = `
                    <div class="d-flex align-items-center">
                        <div class="match-number">${index + 1}</div>
                        <div class="league ms-2">
                            🔍 ${jogo.data_jogo} — <strong>${jogo.competicao}</strong>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center odds position-relative">
                        <button class="team-btn aposta-btn position-relative d-flex flex-column justify-content-center align-items-center px-3 py-2 text-center" 
                                data-jogo="${jogo.id}" data-tipo="home" style="min-width: 110px;">
                            <img src="${jogo.time_casa_brasao}" class="team-logo position-absolute start-0 top-50 translate-middle-y ms-2" width="26">
                            <div class="fw-semibold">${jogo.time_casa_nome}</div>
                            <small class="text-muted">${odds.home}</small>
                        </button>

                        <button class="draw-btn aposta-btn d-flex flex-column align-items-center justify-content-center px-3 py-2 text-center" 
                                data-jogo="${jogo.id}" data-tipo="draw" style="min-width: 90px;">
                            <div class="fw-semibold mb-1">EMPATE</div>
                            <small class="text-muted">${odds.draw}</small>
                        </button>

                        <button class="team-btn aposta-btn position-relative d-flex flex-column justify-content-center align-items-center px-3 py-2 text-center" 
                                data-jogo="${jogo.id}" data-tipo="away" style="min-width: 110px;">
                            <img src="${jogo.time_fora_brasao}" class="team-logo position-absolute end-0 top-50 translate-middle-y me-2" width="26">
                            <div class="fw-semibold">${jogo.time_fora_nome}</div>
                            <small class="text-muted">${odds.away}</small>
                        </button>
                    </div>
                `;
                container.appendChild(card);
            });

            ativarSelecao();
            atualizarContadores();

        } catch (error) {
            console.error('Erro inesperado:', error);
            container.innerHTML = `<div class="text-danger">Erro ao buscar dados.</div>`;
        }
    }

    // 🔹 Buscar odds externas
    async function buscarOdds(eventId) {
        const url = `https://global.ds.lsapp.eu/odds/pq_graphql?_hash=ope2&eventId=${eventId}&bookmakerId=16&betType=HOME_DRAW_AWAY&betScope=FULL_TIME`;
        try {
            const res = await fetch(url);
            const json = await res.json();
            const odds = json?.data?.findPrematchOddsForBookmaker;
            return {
                home: odds?.home?.value || '-',
                draw: odds?.draw?.value || '-',
                away: odds?.away?.value || '-'
            };
        } catch {
            return { home: '-', draw: '-', away: '-' };
        }
    }

    // 🔹 Aplicar combinações anteriores ao abrir em modo edição
    function aplicarCombinacaoAntiga(combinacao) {
        const partes = combinacao.split('-');
        const botoes = document.querySelectorAll('.aposta-btn');

        let index = 0;
        for (const jogoId in palpites) {
            const val = partes[index] || '';
            if (val.includes('1')) palpites[jogoId].push('home');
            if (val.toLowerCase().includes('x')) palpites[jogoId].push('draw');
            if (val.includes('2')) palpites[jogoId].push('away');
            index++;
        }

        // Marca os botões selecionados visualmente
        botoes.forEach(btn => {
            const jogoId = btn.getAttribute('data-jogo');
            const tipo = btn.getAttribute('data-tipo');
            if (palpites[jogoId].includes(tipo)) {
                btn.classList.add('selecionado');
            }
        });

        atualizarContadores();
    }

    // 🔹 Seleção de palpites
    function ativarSelecao() {
        const botoes = document.querySelectorAll('.aposta-btn');
        botoes.forEach(btn => {
            btn.addEventListener('click', () => {
                const jogoId = btn.getAttribute('data-jogo');
                const tipo = btn.getAttribute('data-tipo');

                if (palpites[jogoId].includes(tipo)) {
                    palpites[jogoId] = palpites[jogoId].filter(t => t !== tipo);
                    btn.classList.remove('selecionado');
                } else {
                    palpites[jogoId].push(tipo);
                    btn.classList.add('selecionado');
                }

                atualizarContadores();
            });
        });
    }

    // 🔹 Limpar palpites
    btnLimpar.addEventListener('click', () => {
        document.querySelectorAll('.aposta-btn').forEach(btn => btn.classList.remove('selecionado'));
        for (const jogoId in palpites) palpites[jogoId] = [];
        atualizarContadores();
    });

    // 🔹 Atualizar contadores e valor total
    function atualizarContadores() {
        const secoEl = document.querySelector('.bg-dark .col:nth-child(1) .fs-5');
        const duploEl = document.querySelector('.bg-dark .col:nth-child(2) .fs-5');
        const triploEl = document.querySelector('.bg-dark .col:nth-child(3) .fs-5');
        const bilheteEl = document.querySelector('.bg-dark h5 span.text-white');
        const valorEl = document.querySelector('.bg-dark .valor-total');

        let secos = 0, duplos = 0, triplos = 0;
        let totalBilhetes = 1;
        let algumSelecionado = false;

        for (const jogoId in palpites) {
            const n = palpites[jogoId].length;
            if (n === 1) secos++;
            else if (n === 2) duplos++;
            else if (n === 3) triplos++;

            if (n > 0) {
                algumSelecionado = true;
                totalBilhetes *= n;
            }
        }

        if (!algumSelecionado) totalBilhetes = 0;

        if (secoEl) secoEl.textContent = secos;
        if (duploEl) duploEl.textContent = duplos;
        if (triploEl) triploEl.textContent = triplos;
        if (bilheteEl) bilheteEl.textContent = `${totalBilhetes} bilhete(s)`;

        const valorTotal = totalBilhetes * valorBilhete;
        if (valorEl) {
            valorEl.innerHTML = valorTotal.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
        }
    }

    // 🔹 Confirmar palpites (criar ou editar)
    btnConfirmar.addEventListener('click', async () => {
        const temPalpites = Object.values(palpites).some(p => p.length > 0);
        if (!temPalpites) {
            alert('⚠️ Nenhum palpite selecionado.');
            return;
        }

        let combinacaoCompacta = Object.entries(palpites)
            .map(([_, escolhas]) => {
                if (escolhas.length === 3) return '1x2';
                if (escolhas.length === 2) {
                    return escolhas.map(e => e === 'home' ? '1' : e === 'draw' ? 'x' : '2').join('');
                }
                if (escolhas.length === 1) {
                    return escolhas[0] === 'home' ? '1' : escolhas[0] === 'draw' ? 'x' : '2';
                }
                return '-';
            })
            .join('-');

        const quantidade = 1;
        const valorTotal = quantidade * valorBilhete;

        try {
            const url = modoEdicao
                ? `/carrinho/${carrinhoEditando}/atualizar`
                : `/carrinho/salvar`;

            const method = modoEdicao ? 'PUT' : 'POST';

            const res = await fetch(url, {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    rodada_id: window.rodadaSelecionada,
                    combinacao: combinacaoCompacta,
                    valor_bilhete: valorBilhete
                })
            });

            const data = await res.json();

            if (!data.success) {
                alert('❌ Erro ao salvar: ' + data.message);
                return;
            }

            alert(`✅ ${modoEdicao ? 'Bilhete atualizado' : 'Carrinho salvo'} com sucesso!\nCombinação: ${combinacaoCompacta}\nValor: R$ ${valorTotal.toFixed(2)}`);
        } catch (err) {
            console.error(err);
            alert('Erro inesperado ao salvar no carrinho.');
        }
    });
});
</script>






<script>
  /*
document.addEventListener('DOMContentLoaded', function() {
    const modalAposta = document.getElementById('ModalAposta');
    const container = document.getElementById('jogos-container');
    const btnConfirmar = document.querySelector('.btt-conf');
    const btnLimpar = document.querySelector('.btt-limpar button');
    let carregando = false;
    let palpites = {}; // Armazena o palpite de cada jogo
    let jogosData = {}; // Armazena dados dos jogos

    // 🔹 Quando o modal abrir
    modalAposta.addEventListener('show.bs.modal', async function(event) {
        const button = event.relatedTarget;
        const rodadaId = button?.getAttribute('data-id');
        if (!rodadaId || carregando) return;

        window.rodadaSelecionada = rodadaId;
        carregando = true;
        container.innerHTML = `<div class="p-3 text-secondary">⏳ Carregando jogos...</div>`;
        await carregarJogos(rodadaId);
        carregando = false;
    });

    // 🔹 Função para carregar jogos
    async function carregarJogos(rodadaId) {
        try {
            const response = await fetch(`/rodadas/${rodadaId}/jogos`);
            const data = await response.json();
            if (!data.success) {
                container.innerHTML = `<div class="text-danger">Erro ao carregar jogos.</div>`;
                return;
            }

            const oddsPromises = data.jogos.map(j => buscarOdds(j.id_partida));
            const oddsList = await Promise.all(oddsPromises);

            container.innerHTML = '';
            jogosData = {};

            data.jogos.forEach((jogo, index) => {
                const odds = oddsList[index];
                jogosData[jogo.id] = jogo;

                const card = document.createElement('div');
                card.classList.add('p-0', 'mb-0');

                card.innerHTML = `
                    <div class="d-flex align-items-center">
                        <div class="match-number">${index + 1}</div>
                        <div class="league ms-2">
                            🔍 ${jogo.data_jogo} — <strong>${jogo.competicao}</strong>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center odds position-relative">
                        <button class="team-btn aposta-btn position-relative d-flex flex-column justify-content-center align-items-center px-3 py-2 text-center" 
                                data-jogo="${jogo.id}" data-tipo="home" style="min-width: 110px;">
                            <img src="${jogo.time_casa_brasao}" class="team-logo position-absolute start-0 top-50 translate-middle-y ms-2" width="26">
                            <div class="fw-semibold">${jogo.time_casa_nome}</div>
                            <small class="text-muted">${odds.home}</small>
                        </button>

                        <button class="draw-btn aposta-btn d-flex flex-column align-items-center justify-content-center px-3 py-2 text-center" 
                                data-jogo="${jogo.id}" data-tipo="draw" style="min-width: 90px;">
                            <div class="fw-semibold mb-1">EMPATE</div>
                            <small class="text-muted">${odds.draw}</small>
                        </button>

                        <button class="team-btn aposta-btn position-relative d-flex flex-column justify-content-center align-items-center px-3 py-2 text-center" 
                                data-jogo="${jogo.id}" data-tipo="away" style="min-width: 110px;">
                            <img src="${jogo.time_fora_brasao}" class="team-logo position-absolute end-0 top-50 translate-middle-y me-2" width="26">
                            <div class="fw-semibold">${jogo.time_fora_nome}</div>
                            <small class="text-muted">${odds.away}</small>
                        </button>
                    </div>
                `;
                container.appendChild(card);
            });

            ativarSelecao();

        } catch (error) {
            console.error('Erro inesperado:', error);
            container.innerHTML = `<div class="text-danger">Erro ao buscar dados.</div>`;
        }
    }

    // 🔹 Buscar odds externas
    async function buscarOdds(eventId) {
        const url = `https://global.ds.lsapp.eu/odds/pq_graphql?_hash=ope2&eventId=${eventId}&bookmakerId=16&betType=HOME_DRAW_AWAY&betScope=FULL_TIME`;
        try {
            const res = await fetch(url);
            const json = await res.json();
            const odds = json?.data?.findPrematchOddsForBookmaker;
            return {
                home: odds?.home?.value || '-',
                draw: odds?.draw?.value || '-',
                away: odds?.away?.value || '-'
            };
        } catch {
            return { home: '-', draw: '-', away: '-' };
        }
    }

    // 🔹 Seleção de palpites
    function ativarSelecao() {
        const botoes = document.querySelectorAll('.aposta-btn');
        botoes.forEach(btn => {
            btn.addEventListener('click', () => {
                const jogoId = btn.getAttribute('data-jogo');
                const tipo = btn.getAttribute('data-tipo');

                document.querySelectorAll(`.aposta-btn[data-jogo="${jogoId}"]`)
                    .forEach(b => b.classList.remove('selecionado'));

                btn.classList.add('selecionado');
                palpites[jogoId] = tipo;

                atualizarContadores();
            });
        });
    }

    // 🔹 Limpar palpites
    btnLimpar.addEventListener('click', () => {
        document.querySelectorAll('.aposta-btn').forEach(btn => btn.classList.remove('selecionado'));
        palpites = {};
        atualizarContadores();
    });

    // 🔹 Atualizar contadores Seco/Duplo/Triplo
    function atualizarContadores() {
        const secoEl = document.querySelector('.bg-dark .col:nth-child(1) .fs-5');
        const duploEl = document.querySelector('.bg-dark .col:nth-child(2) .fs-5');
        const triploEl = document.querySelector('.bg-dark .col:nth-child(3) .fs-5');

        const n = Object.keys(palpites).length;

        // Seco = número de palpites
        secoEl.textContent = n;

        // Duplo = combinações de 2 (nC2)
        duploEl.textContent = n >= 2 ? (n * (n - 1)) / 2 : 0;

        // Triplo = combinações de 3 (nC3)
        triploEl.textContent = n >= 3 ? (n * (n - 1) * (n - 2)) / 6 : 0;
    }

    // 🔹 Confirmar palpites e enviar para backend
    btnConfirmar.addEventListener('click', async () => {
        const palpitesSelecionados = Object.keys(palpites);
        if (palpitesSelecionados.length === 0) {
            alert('⚠️ Nenhum palpite selecionado.');
            return;
        }

        const palpitesFormatados = palpitesSelecionados.map(jogoId => {
            const jogo = jogosData[jogoId];
            return {
                rodada_jogo_id: jogo.id,
                escolha: palpites[jogoId] === 'home' ? 'casa' :
                         palpites[jogoId] === 'draw' ? 'empate' : 'fora'
            };
        });

        try {
            const res = await fetch('/palpites', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    rodada_id: window.rodadaSelecionada,
                    palpites: palpitesFormatados
                })
            });

            const data = await res.json();

            if (!data.success) {
                alert('Erro ao registrar bilhete: ' + data.message);
                return;
            }

            const bilheteId = data.palpite_id;
            const codigoBilhete = data.codigo_bilhete;

            alert(
                `Bilhete criado: ${codigoBilhete}\n` +
                `Palpites: ${palpitesFormatados.map(p => `${p.rodada_jogo_id}: ${p.escolha}`).join(' | ')}`
            );

        } catch (err) {
            console.error(err);
            alert('Erro inesperado ao registrar o bilhete.');
        }
    });

});

*/
</script>




<style>
.aposta-btn {
  border: 2px solid transparent;
  border-radius: 10px;
  transition: all 0.2s ease-in-out;
}
.aposta-btn:hover {
  border-color: #ffc107;
  background-color: #f8f9fa1c;
}
.aposta-btn.selecionado {
  border-color: #0d6efd;
  background-color: #0d6efd;

}
</style>
