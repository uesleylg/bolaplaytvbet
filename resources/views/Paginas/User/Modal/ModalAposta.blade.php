<!-- ============================
     MODAL PIX - 2025 PREMIUM UI
============================= -->
<div class="modal fade" id="ModalPix" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content pix-card">

      <div class="modal-header border-0 p-3 pix-header">
        <h5 class="modal-title d-flex align-items-center gap-2">
          <i class="fa-brands fa-pix fa-beat" style="font-size: 22px;"></i>
          Pagamento via PIX
        </h5>
        <button type="button" class="btn-close btn-close-white shadow-sm" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center px-4 pb-4">

        <!-- 🔄 LOADING -->
        <div id="pixLoading">
          <div class="spinner-border text-success mb-3" style="width: 3rem; height: 3rem;"></div>
          <p class="mt-3 text-muted">Gerando PIX...<br><small>Isso leva só alguns segundos.</small></p>
        </div>

        <!-- 📌 CONTEÚDO DO PIX -->
        <div id="pixContent" style="display: none;">
          
          <p class="text-muted mb-1">Valor do pagamento</p>
          <h3 class="fw-bold text-success mb-4" id="pixValor"></h3>

          <div class="pix-qr-wrapper mx-auto mb-3">
            <img id="pixQrImg" src="" class="pix-qr-image" />
          </div>

          <p class="mt-3 text-muted small">Ou copie o código abaixo:</p>

          <div class="input-group mt-2 shadow-sm">
            <textarea id="pixCopiaCola" class="form-control text-center p-2" rows="3" readonly></textarea>
            <button class="btn btn-success" onclick="copiarPix()">Copiar</button>
          </div>

        </div>

      </div>

      <div class="modal-footer border-0 px-4 pb-4 d-flex justify-content-between">
        <button class="btn btn-light px-4 shadow-sm" data-bs-dismiss="modal">Fechar</button>
        <button class="btn btn-success px-4 shadow-sm">Já paguei</button>
      </div>

    </div>
  </div>
</div>



<!-- ================================
     ESTILO MODERNO PIX 2025 (SÓLIDO)
================================ -->
<style>
  /* Cartão sólido, sem transparência */
  .pix-card {
    border-radius: 18px;
    overflow: hidden;
    background: #ffffff; /* <- sólido */
    border: 1px solid #e5e7eb;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
  }

  /* Cabeçalho moderno */
  .pix-header {
    background: linear-gradient(135deg, #0baa57 0%, #34d399 100%);
    color: white;
  }

  /* Caixa do QR */
  .pix-qr-wrapper {
    background: white;
    padding: 12px;
    border-radius: 12px;
    width: 250px;
    height: 250px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid #e5e7eb;
  }

  .pix-qr-image {
    width: 100%;
    border-radius: 10px;
  }

  textarea {
    resize: none;
    font-size: 14px;
  }

  .modal-content {
    animation: fadeSlideUp 0.25s ease-out;
  }

  @keyframes fadeSlideUp {
    from {
      opacity: 0;
      transform: translateY(10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>



<!-- ======================
     FUNÇÃO COPIAR PIX
======================= -->
<script>
  function copiarPix() {
    const input = document.getElementById("pixCopiaCola");
    input.select();
    document.execCommand("copy");

    Swal.fire({
      icon: "success",
      title: "Código copiado!",
      text: "Cole no seu app do banco para pagar.",
      timer: 1800,
      showConfirmButton: false
    });
  }
</script>



<div class="modal fade" id="ModalAposta" tabindex="-1" aria-labelledby="ModalAposta" aria-hidden="true" >
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
              <h4 id="premio-estimado" class="fw-bold text-warning mb-0">R$ 0,00</h4>

            </div>
          </div>

          <button type="button" class="btn btn-primary btt-conf">CONFIRMAR APOSTA</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script>

// 🔹 Abrir modal manualmente e passar atributos
document.querySelectorAll('.abrirAposta').forEach(card => {
    card.addEventListener('click', function () {

        const rodadaId = this.getAttribute('data-id');
        const editar = this.getAttribute('data-editar') === 'true';
        const carrinhoId = this.getAttribute('data-carrinho-id');
        const combinacao = this.getAttribute('data-combinacao');

        const modalEl = document.getElementById('ModalAposta');

        // Passa valores ao modal
        modalEl.setAttribute('data-id', rodadaId);
        modalEl.setAttribute('data-editar', editar);
        modalEl.setAttribute('data-carrinho-id', carrinhoId || '');
        modalEl.setAttribute('data-combinacao', combinacao || '');

        // Abre manualmente
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    });
});


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
    modalAposta.addEventListener('show.bs.modal', async function() {

        // Agora pegamos diretamente DO MODAL
        const rodadaId = modalAposta.getAttribute('data-id');
        const editar = modalAposta.getAttribute('data-editar') === 'true';
        const carrinhoId = modalAposta.getAttribute('data-carrinho-id');
        const combinacao = modalAposta.getAttribute('data-combinacao');

        if (!rodadaId || carregando) return;

        window.rodadaSelecionada = rodadaId;
        modoEdicao = editar;
        carrinhoEditando = carrinhoId || null;
        combinacaoOriginal = combinacao || '';

        carregando = true;

        container.innerHTML = `
            <div class="placeholder-glow p-3">
                <div class="placeholder col-12 mb-3" style="height:60px;border-radius:10px;"></div>
                <div class="placeholder col-12 mb-3" style="height:60px;border-radius:10px;"></div>
                <div class="placeholder col-12 mb-3" style="height:60px;border-radius:10px;"></div>
            </div>
        `;

        await carregarJogos(rodadaId);
        carregando = false;

        if (modoEdicao && combinacaoOriginal) {
            aplicarCombinacaoAntiga(combinacaoOriginal);
        }

        btnConfirmar.textContent = modoEdicao ? 'ATUALIZAR APOSTA' : 'CONFIRMAR APOSTA';
    });



    // 🔹 Carregar jogos + odds
    async function carregarJogos(rodadaId) {
        try {
            const response = await fetch(`/rodadas/${rodadaId}/jogos`);
            const data = await response.json();

            if (!data.success) {
                container.innerHTML = `<div class="text-danger">Erro ao carregar jogos.</div>`;
                return;
            }

            valorBilhete = parseFloat(data.rodada.valor_bilhete);

            const premioEstimadoEl = document.getElementById("premio-estimado");
if (premioEstimadoEl) {
    premioEstimadoEl.textContent = parseFloat(data.rodada.premiacao_estimada).toLocaleString(
        'pt-BR',
        { style: 'currency', currency: 'BRL' }
    );
}

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
                          <a href="${jogo.link_jogo}" target="_blank" class="text-decoration-none ">
        🔍 ${jogo.data_jogo} — <strong>${jogo.competicao}</strong>
    </a>
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

        } catch (err) {
            console.error(err);
            container.innerHTML = `<div class="text-danger">Erro ao buscar dados.</div>`;
        }
    }



    // 🔹 Odds externas
    async function buscarOdds(eventId) {
        const url =
            `https://global.ds.lsapp.eu/odds/pq_graphql?_hash=ope2&eventId=${eventId}&bookmakerId=16&betType=HOME_DRAW_AWAY&betScope=FULL_TIME`;

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



    // 🔹 Aplicar combinações antigas
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
        document.querySelectorAll('.aposta-btn').forEach(btn => {
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



    // 🔹 Atualizar contadores
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
                return escolhas.map(e =>
                    e === 'home' ? '1' :
                    e === 'draw' ? 'x' : '2'
                ).join('');
            }
            if (escolhas.length === 1) {
                return escolhas[0] === 'home' ? '1' :
                       escolhas[0] === 'draw' ? 'x' : '2';
            }
            return '-';
        })
        .join('-');

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

        alert(`✅ ${modoEdicao ? 'Bilhete atualizado' : 'Carrinho salvo'} com sucesso!`);

        if (modoEdicao) return;

        // ------------------------------------------------------------------
        // 🔥 GERAR PIX — usando o controller correto
        // ------------------------------------------------------------------

        const carrinhoIdsArray = data.carrinho_ids; 
        console.log("📦 Carrinhos enviados para PIX:", carrinhoIdsArray);

        const modalApostaBS = bootstrap.Modal.getInstance(modalAposta);
        modalApostaBS.hide();

        setTimeout(async () => {

            const modalPixEl = document.getElementById('ModalPix');
            const modalPix = new bootstrap.Modal(modalPixEl);

            document.getElementById("pixLoading").style.display = "block";
            document.getElementById("pixContent").style.display = "none";

            modalPix.show();

            await gerarPixPagamento(carrinhoIdsArray);

            document.getElementById("pixLoading").style.display = "none";
            document.getElementById("pixContent").style.display = "block";

        }, 300);

    } catch (err) {
        console.error(err);
        alert('Erro inesperado ao salvar no carrinho.');
    }
});


});

async function gerarPixPagamento(carrinhoIdsArray) {
    try {
        console.log("📦 Enviando carrinho_ids:", carrinhoIdsArray);

        const res = await fetch("/gerar-pix", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                carrinho_ids: carrinhoIdsArray
            })
        });

        const data = await res.json();

        if (!data.success) {
            alert("❌ Erro ao gerar PIX: " + data.message);
            return;
        }

        // Valor
        document.getElementById("pixValor").innerHTML =
            "R$ " + String(data.valor.toFixed(2)).replace(".", ",");

        // QR Code base64 (campo correto)
        document.getElementById("pixQrImg").src =
            "data:image/png;base64," + data.qr;

        // Copia e cola (campo correto)
        document.getElementById("pixCopiaCola").value = data.copia_cola;

    } catch (e) {
        console.error("Erro PIX:", e);
        alert("Erro inesperado ao gerar PIX");
    }
}



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
