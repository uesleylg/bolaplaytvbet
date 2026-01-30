<!-- Modal Add Bilhetes Externos -->
<div class="modal fade" id="ModalAddBilhetesExternos" tabindex="-1" aria-labelledby="ModalAddBilhetesExternosLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 12px; overflow: hidden;">

      <!-- Cabeçalho -->
      <div class="modal-header" style="background-color:#1e293b; color:white;">
        <h5 class="modal-title" id="ModalAddBilhetesExternosLabel">
          <i class="fa-solid fa-ticket me-2 text-primary"></i> Adicionar Bilhetes Externos
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <!-- Corpo -->
      <div class="modal-body text-white p-4" style="background-color: rgb(30 41 59);">

        <div class="text-center mb-4">
          <i class="fa-solid fa-ticket text-primary fs-1 mb-3"></i>
          <h5 class="fw-bold">Informe o total de bilhetes externos da rodada</h5>
          <p class="text-secondary">
            Esse valor será contabilizado no ranking geral da rodada.
          </p>
        </div>

        <!-- Formulário -->
        <form id="formAddBilhetesExternos" action="" method="POST">
            @csrf

            <!-- Campo do total -->
            <label class="fw-semibold mb-2">Total de Bilhetes Externos:</label>
            <div class="input-group mb-4 shadow-sm">
              <input 
                type="number" 
                name="bilhetes_externos" 
                id="inputBilhetesExternos"
                class="form-control bg-secondary text-white border-0"
                placeholder="0"
                min="0"
                required>
            </div>

            <!-- Campo oculto para ID da rodada -->
            <input type="hidden" id="bilhetesExternosRodadaId" name="rodada_id">

            <!-- Botão Salvar -->
            <button 
              type="submit" 
              class="btn btn-primary w-100 fw-bold rounded-pill py-2 shadow-sm">
              <i class="fa-solid fa-save me-1"></i> Salvar Bilhetes Externos
            </button>
        </form>

      </div>

    </div>
  </div>
</div>


<script>
  // Quando o modal estiver prestes a abrir
  var modalBilhetesExternos = document.getElementById('ModalAddBilhetesExternos');

  modalBilhetesExternos.addEventListener('show.bs.modal', function (event) {

    // Botão que abriu o modal
    var button = event.relatedTarget;

    // Pega os dados do botão
    var rodadaId = button.getAttribute('data-id');
    var bilhetesExternos = button.getAttribute('data-bilhete-externo');

    // Campos do modal
    var inputId = modalBilhetesExternos.querySelector('#bilhetesExternosRodadaId');
    var inputTotal = modalBilhetesExternos.querySelector('#inputBilhetesExternos');

    // Preenche os valores
    inputId.value = rodadaId;
    inputTotal.value = bilhetesExternos || 0;

    // Atualiza o action do form se necessário
    //  var form = modalBilhetesExternos.querySelector('#formAddBilhetesExternos');
    //  form.action = `/admin/rodadas/${rodadaId}/bilhetes-externos`; // ajuste conforme sua rota real
  });
</script>
