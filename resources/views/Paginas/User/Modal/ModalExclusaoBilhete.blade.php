<div class="modal fade" id="ModalExcluirBilhete" tabindex="-1" aria-labelledby="ModalExcluirBilheteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content" style="border-radius: 10px;">

      <!-- Cabeçalho -->
      <div class="modal-header" style="background-color:#7f1d1d; color:white;">
        <div>
          <h5 class="modal-title" id="ModalExcluirBilheteLabel">
            <i class="fa-solid fa-triangle-exclamation me-2"></i> Confirmar Exclusão
          </h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <!-- Corpo -->
      <div class="modal-body bg-dark text-white">
        <div class="text-center mb-3">
          <i class="fa-solid fa-trash-can text-danger fs-1 mb-3"></i>
          <h5 class="fw-bold">Tem certeza que deseja excluir este bilhete?</h5>
          <p class="text-muted mt-2">
            Essa ação <strong>não poderá ser desfeita</strong>.  
            O bilhete será removido permanentemente.
          </p>
        </div>
      </div>

      <!-- Rodapé -->
      <div class="modal-footer bg-dark border-0 d-flex justify-content-center">
        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
          <i class="fa-solid fa-xmark me-1"></i> Cancelar
        </button>

<button type="button" class="btn btn-danger px-4" id="btnConfirmarExclusao">
  <i class="fa-solid fa-trash me-1"></i> Excluir Bilhete
</button>
      </div>

    </div>
  </div>
</div>



<script>
let bilheteIdParaExcluir = null;

// Quando clicar no botão da lixeira
document.addEventListener('click', function (e) {
  const botao = e.target.closest('.btn-excluir');
  if (!botao) return;

  bilheteIdParaExcluir = botao.dataset.id;
});

// Quando confirmar no modal
document.getElementById('btnConfirmarExclusao').addEventListener('click', function () {
  if (!bilheteIdParaExcluir) return;

  fetch(`/carrinho/${bilheteIdParaExcluir}/excluir`, {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      'Accept': 'application/json'
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // Fecha o modal
      const modal = bootstrap.Modal.getInstance(
        document.getElementById('ModalExcluirBilhete')
      );
      modal.hide();

      // Remove o item da tela ou recarrega
      location.reload();
    } else {
      console.error(data.message || 'Erro ao excluir');
    }
  })
  .catch(error => {
    console.error('Erro inesperado:', error);
  });
});
</script>
