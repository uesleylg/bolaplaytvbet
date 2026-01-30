<div class="modal fade" id="ModalAposta" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 10px;">

      <!-- Cabeçalho -->
      <div class="modal-header" style="background-color:#1e293b; color:white;">
        <div>
          <h5 class="modal-title" id="modalTitulo">Bilhete</h5>
          <small id="modalResumo" style="color:#d3d3d3;"></small>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Corpo -->
      <div class="modal-body text-center" style="max-height:70vh; overflow-y:auto;">
        <div class="container">

          <!-- RESUMO -->
          <div class="row mb-3">
            <div class="col-6">
              <p>
                <strong style="color:#64748b;">COMPRADOR</strong><br>
                <b id="modalComprador">—</b>
              </p>
              <p>
                <strong style="color:#64748b;">ACERTOS</strong><br>
                <b id="modalAcertos">—</b>
              </p>
            </div>

            <div class="col-6">
              <p>
                <strong style="color:#64748b;">DATA DE COMPRA</strong><br>
                <b id="modalData">—</b>
              </p>
              <p>
                <strong style="color:#64748b;">VALOR PAGO</strong><br>
                <span style="color:rgb(5 150 105);">
                  <b id="modalValor">R$ 0,00</b>
                </span>
              </p>
            </div>
          </div>

          <hr>

          <!-- TÍTULO APOSTAS -->
          <h5 class="text-start mb-3">
            <i class="fa-solid fa-ticket"></i>
            Apostas do Bilhete
          </h5>

          <!-- APOSTAS (DINÂMICO) -->
          <div id="modalApostas"></div>

        </div>
      </div>
    </div>
  </div>
</div>



<script>
  
document.addEventListener("click", function (e) {

    const row = e.target.closest(".ranking-row");
    if (!row) return;

    // ==========================
    // APOSTAS (JSON)
    // ==========================
    let apostas = [];
    try {
        apostas = JSON.parse(row.dataset.apostas || "[]");
    } catch (e) {
        console.error("Erro ao ler apostas", e);
    }

    if (!Array.isArray(apostas)) apostas = [];

    const total = apostas.length;
    const acertos = apostas.filter(a => a.status === "acertou").length;

    // ==========================
    // CABEÇALHO
    // ==========================
    document.getElementById("modalTitulo").innerText =
        "Bilhete " + (row.dataset.codigo || "");

    document.getElementById("modalResumo").innerText =
        `${acertos} acertos de ${total} jogos`;

    // ==========================
    // DADOS GERAIS
    // ==========================
    document.getElementById("modalComprador").innerText =
        row.dataset.usuario || "—";

    document.getElementById("modalAcertos").innerText =
        `${acertos} de ${total}`;

    document.getElementById("modalData").innerText =
        row.dataset.data || "—";

    document.getElementById("modalValor").innerText =
        "R$ " + (row.dataset.valor || "0,00");

    // ==========================
    // MONTA OS CARDS
    // ==========================
    let html = "";

    apostas.forEach((aposta, index) => {

        let icon = "";
        if (aposta.status === "acertou") {
            icon = `<i class="fa-solid fa-circle-check" style="font-size:35px;color:rgb(16 185 129);"></i>`;
        } else if (aposta.status === "errou") {
            icon = `<i class="fa-solid fa-circle-xmark" style="font-size:35px;color:red;"></i>`;
        } else {
            icon = `<i class="fa-solid fa-clock" style="font-size:35px;color:rgb(179 179 179 / 78%);"></i>`;
        }

        let apostaTraduzida = "—";
        if (aposta.aposta === "1") apostaTraduzida = "Casa";
        else if (aposta.aposta === "x") apostaTraduzida = "Empate";
        else if (aposta.aposta === "2") apostaTraduzida = "Fora";

        let placar = "";
        if (aposta.placar_casa !== null && aposta.placar_fora !== null) {
            placar = `
                <div style="font-size:14px;color:#64748b;margin-top:2px;">
                    Placar: <b>${aposta.placar_casa} x ${aposta.placar_fora}</b>
                </div>`;
        }

        html += `
            <div class="card w-100 mb-2">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div class="d-flex align-items-start text-start">
                        <span style="margin-right:10px;">${icon}</span>
                        <div>
                            <div style="font-weight:bold;">
                                JG ${index + 1} - (${(aposta.status || 'pendente').toUpperCase()})
                            </div>
                            <div>${aposta.time_casa || ''} vs ${aposta.time_fora || ''}</div>
                            ${placar}
                        </div>
                    </div>

                    <div class="text-end">
                        <div style="font-size:0.9rem;color:gray;">Aposta</div>
                        <div style="font-weight:bold;">${apostaTraduzida}</div>
                    </div>

                </div>
            </div>
        `;
    });

    document.getElementById("modalApostas").innerHTML = html;
});
</script>

