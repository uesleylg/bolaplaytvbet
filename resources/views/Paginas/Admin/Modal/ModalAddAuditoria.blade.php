<!-- Modal Add Auditoria -->
<div class="modal fade" id="ModalAddAuditoria" tabindex="-1" aria-labelledby="ModalAddAuditoriaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 12px; overflow: hidden;">

      <!-- Cabeçalho -->
      <div class="modal-header" style="background-color:#1e293b; color:white;">
        <h5 class="modal-title" id="ModalAddAuditoriaLabel">
          <i class="fa-solid fa-shield-halved me-2 text-primary"></i> Adicionar Link de Auditoria
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <!-- Corpo -->
      <div class="modal-body text-white p-4" style="background-color: rgb(30 41 59);">

        <div class="text-center mb-4">
          <i class="fa-solid fa-file-shield text-primary fs-1 mb-3"></i>
          <h5 class="fw-bold">Informe o link da auditoria da rodada</h5>
          <p class="text-secondary">
            O link ficará disponível para consulta e transparência das apostas.
          </p>
        </div>

        <!-- Formulário -->
        <form id="formAddAuditoria" action="{{ route('admin.rodadas.auditoria.store') }}" method="POST">
            @csrf

            <!-- Campo do link -->
            <label class="fw-semibold mb-2">Link da Auditoria:</label>
            <div class="input-group mb-4 shadow-sm">
         <input 
    type="text" 
    name="link_auditoria" 
    id="inputLinkAuditoria"
    class="form-control bg-secondary text-white border-0"
    placeholder="https://exemplo.com/auditoria"
    required>
            <!-- Campo oculto para ID da rodada -->
            <input type="hidden" id="auditoriaRodadaId" name="rodada_id">
            <br><br>

            <!-- Botão Salvar -->
            <button 
            style="margin-top: 15px;"
              type="submit" 
              class="btn btn-primary w-100 fw-bold rounded-pill py-2 shadow-sm">
              <i class="fa-solid fa-save me-1"></i> Salvar Auditoria
            </button>
        </form>

      </div>

    </div>
  </div>
</div>
