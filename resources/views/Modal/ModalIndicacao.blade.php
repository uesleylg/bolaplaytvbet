<!-- Modal Link de Indicação -->
<div class="modal fade" id="ModalIndicacao" tabindex="-1" aria-labelledby="ModalIndicacaoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 12px; overflow: hidden;">

      <!-- Cabeçalho -->
      <div class="modal-header" style="background-color:#1e293b; color:white;">
        <h5 class="modal-title" id="ModalIndicacaoLabel">
          <i class="fa-solid fa-link me-2 text-warning"></i> Seu Link de Indicação
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <!-- Corpo -->
      <div class="modal-body  text-white p-4" style="background-color: rgb(30 41 59);">
        <div class="text-center mb-4">
          <i class="fa-solid fa-users-between-lines text-warning fs-1 mb-3"></i>
          <h5 class="fw-bold">Convide seus amigos e ganhe recompensas!</h5>
          <p class="text-secondary">Compartilhe o link abaixo e acompanhe suas indicações no painel.</p>
        </div>

        <!-- Campo do link -->
        <div class="input-group mb-3 shadow-sm">
          <input type="text" id="linkIndicacao" class="form-control bg-secondary text-white border-0" 
                 value="https://bolaplaytv.com/indicacao/ABC123"
                 readonly>
          <button class="btn btn-warning fw-bold" id="copiarLink">
            <i class="fa-regular fa-copy me-1"></i> Copiar
          </button>
        </div>

        <!-- Mensagem de feedback -->
        <div id="copiadoMsg" class="text-center text-success fw-bold" style="display:none;">
          <i class="fa-solid fa-check-circle me-1"></i> Link copiado com sucesso!
        </div>

        <!-- Dica -->
        <div class="mt-4 p-3 bg-secondary bg-opacity-25 rounded-3 text-center">
          <i class="fa-solid fa-gift text-warning fs-5 me-2"></i>
          <span>Para cada amigo que apostar pelo seu link, você ganha bônus exclusivos!</span>
        </div>
      </div>

      <!-- Rodapé -->
    
    </div>
  </div>
</div>

<!-- Script para copiar o link -->
<script>
document.getElementById('copiarLink').addEventListener('click', function() {
  const input = document.getElementById('linkIndicacao');
  input.select();
  input.setSelectionRange(0, 99999); // compatibilidade mobile
  navigator.clipboard.writeText(input.value);
  
  const msg = document.getElementById('copiadoMsg');
  msg.style.display = 'block';
  setTimeout(() => msg.style.display = 'none', 2500);
});
</script>
