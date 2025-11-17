<div class="modal fade" id="ModalVerJogosRodada" tabindex="-1" aria-labelledby="ModalVerJogosRodada" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 12px; background-color: #0f172a; color: #e2e8f0;">

      <!-- Cabeçalho -->
      <div class="modal-header border-0" style="background-color:#1e293b; color:white; border-top-left-radius: 12px; border-top-right-radius: 12px;">
        <h5 class="modal-title">
          <i class="fa-solid fa-futbol me-2"></i> Jogos da Rodada
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Corpo -->
      <div class="modal-body p-4">

        <div id="alert-area"></div>

        <!-- TOPO: Total de jogos + botão excluir -->
        <div class="d-flex justify-content-between align-items-center mb-3">

          <h6 class="fw-semibold mb-0">
            <span id="totalJogoss"></span>
          </h6>

          <button id="btnExcluirJogos" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-semibold shadow-sm">
            <i class="fa-solid fa-trash me-1"></i> Excluir Jogos
          </button>

        </div>

        <!-- Lista dos jogos -->
        <div id="listaJogoss"></div>

      </div>

    </div>
  </div>
</div>



<script>
document.addEventListener("DOMContentLoaded", () => {

  const modal = document.getElementById("ModalVerJogosRodada");
  const listaJogosDiv = document.getElementById("listaJogoss");
  const totalJogosSpan = document.getElementById("totalJogoss");
  const btnExcluir = document.getElementById("btnExcluirJogos");

  // Quando abrir o modal Ver Jogos
  modal.addEventListener("show.bs.modal", async (event) => {

    const button = event.relatedTarget;
    const rodadaId = button.getAttribute("data-id");

    modal.setAttribute("data-rodada-id", rodadaId);

    listaJogosDiv.innerHTML = `
      <p class="text-center text-secondary mt-3">Carregando jogos...</p>
    `;

    try {
      const response = await fetch(`/rodadas/${rodadaId}/jogos`);
      const data = await response.json();

      if (!data.success) {
        listaJogosDiv.innerHTML = `
          <p class="text-danger text-center mt-3">Erro ao carregar jogos.</p>
        `;
        return;
      }

      const jogos = data.jogos;

      totalJogosSpan.textContent = `Total de jogos: ${jogos.length}`;

      if (jogos.length === 0) {
        listaJogosDiv.innerHTML = `
          <p class="text-center text-warning mt-3 fw-semibold">Nenhum jogo cadastrado.</p>
        `;
        return;
      }

      listaJogosDiv.innerHTML = jogos.map(jogo => `
        <div class="list-group-item d-flex justify-content-between align-items-center border-0 rounded-3 mb-3 p-3 shadow-sm"
             style="background-color:#161b22;">

          <div>
            <div class="fw-semibold text-light d-flex align-items-center mb-1">
              <img src="${jogo.time_casa_brasao}" width="30" class="me-2 rounded-circle border border-secondary">
              ${jogo.time_casa_nome}
              <span class="text-secondary mx-2">vs</span>
              ${jogo.time_fora_nome}
              <img src="${jogo.time_fora_brasao}" width="30" class="ms-2 rounded-circle border border-secondary">
            </div>

            <small class="text-muted">
              <i class="fa-regular fa-clock me-1"></i> ${jogo.data_jogo} |
              <i class="fa-solid fa-trophy me-1 text-warning"></i> ${jogo.competicao}
            </small>
          </div>

        </div>
      `).join("");

    } catch (e) {
      console.log(e);
      listaJogosDiv.innerHTML = `
        <p class="text-danger text-center mt-3">Erro inesperado ao carregar jogos.</p>
      `;
    }

  });



  // Botão EXCLUIR TODOS OS JOGOS
  btnExcluir.addEventListener("click", async () => {

    const rodadaId = modal.getAttribute("data-rodada-id");

    if (!rodadaId) {
      alert("Erro: ID da rodada não encontrado.");
      return;
    }

    if (!confirm("Deseja realmente excluir TODOS os jogos desta rodada?")) {
      return;
    }

    try {
      const response = await fetch(`/admin/rodadas/${rodadaId}/jogos/excluir`, {
        method: "DELETE",
        headers: {
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
      });

      const data = await response.json();

      if (!data.success) {
        alert("Erro ao excluir os jogos.");
        return;
      }

      // Atualiza a interface
      listaJogosDiv.innerHTML = `
        <p class="text-center text-danger mt-4 fw-semibold">
          Nenhum jogo cadastrado nesta rodada.
        </p>
      `;

      totalJogosSpan.textContent = "Total de jogos: 0";

    } catch (error) {
      console.log(error);
      alert("Erro inesperado.");
    }

  });

});
</script>
