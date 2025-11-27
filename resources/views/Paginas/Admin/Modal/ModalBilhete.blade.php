<div class="modal fade" id="ModalAposta" tabindex="-1" aria-labelledby="ModalAposta" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content" style="border-radius: 10px;">

      <!-- Cabeçalho -->
      <div class="modal-header" style="background-color:#1e293b; color:white;">
        <div>
          <h5 class="modal-title" id="modalTitulo">Bilhete</h5>
          <small id="modalResumo" style="color:#d3d3d3;">0 acertos de 0 jogos</small>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <br>

      <!-- Corpo -->
      <div class="modal-body text-center" style="max-height: 80vh; overflow-y: auto;">
        <div class="container">

          <div class="row">

            <!-- Coluna 1 -->
            <div class="col-6">
              <p>
                <strong style="color: rgb(100 116 139);font-family: 'Roboto', sans-serif;">COMPRADOR</strong><br>
                <b id="modalComprador"></b>
              </p>

              <p>
                <strong style="color: rgb(100 116 139);font-family: 'Roboto', sans-serif;">ACERTOS</strong><br>
                <b id="modalAcertos"></b>
              </p>
            </div>

            <!-- Coluna 2 -->
            <div class="col-6">
              <p>
                <strong style="color: rgb(100 116 139);font-family: 'Roboto', sans-serif;">DATA DE COMPRA</strong><br>
                <b id="modalData"></b>
              </p>

              <p>
                <strong style="color: rgb(100 116 139);font-family: 'Roboto', sans-serif;">VALOR PAGO</strong><br>
                <span style="color:rgb(5 150 105);">
                  <b id="modalValor"></b>
                </span>
              </p>
            </div>

          </div>

          <hr style="color:#b3b3b3;">
          <h5 style="text-align: left;">
            <i class="fa-solid fa-ticket"></i> Seus Palpites - <span id="modalResumo2"></span> jogos
          </h5>

          <!-- LISTA DAS APOSTAS -->
          <div id="modalApostas"></div>

        </div>
      </div>

    </div>

  </div>
</div>
