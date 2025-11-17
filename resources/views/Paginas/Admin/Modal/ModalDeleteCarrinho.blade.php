<!-- ==============================
     MODAL DE CONFIRMAÇÃO DE EXCLUSÃO DE CARRINHO
================================== -->
<div class="modal fade" id="ModalConfirmDelete" tabindex="-1" aria-labelledby="ModalConfirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; background-color: #0f172a; color: #e2e8f0;">
      
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold text-danger" id="ModalConfirmDeleteLabel">
          <i class="fa-solid fa-triangle-exclamation me-2"></i> Confirmar Exclusão
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <div class="modal-body text-center">
        <i class="fa-solid fa-trash-can fa-3x text-danger mb-3"></i>
        <p class="fs-5">
          Tem certeza que deseja excluir o <strong id="deleteCarrinhoNome" class="text-warning"></strong>?
        </p>
        <p class="text-muted mb-0">Esta ação não poderá ser desfeita.</p>
      </div>

      <div class="modal-footer border-0 justify-content-center">
        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
          <i class="fa-solid fa-xmark me-1"></i> Cancelar
        </button>
        <button type="button" id="btnConfirmDelete" class="btn btn-danger px-4">
          <i class="fa-solid fa-trash me-1"></i> Excluir
        </button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const deleteButtons = document.querySelectorAll('.btn-delete-carrinho');
  const modalDelete = new bootstrap.Modal(document.getElementById('ModalConfirmDelete'));
  const deleteCarrinhoNome = document.getElementById('deleteCarrinhoNome');
  const confirmDeleteBtn = document.getElementById('btnConfirmDelete');
  const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

  let selectedCarrinhoId = null;

  // Quando clicar no botão de excluir
  deleteButtons.forEach(button => {
    button.addEventListener('click', () => {
      selectedCarrinhoId = button.getAttribute('data-id');
      const carrinhoNome = button.getAttribute('data-nome');

      deleteCarrinhoNome.textContent = carrinhoNome;
      modalDelete.show();
    });
  });

  // Confirma exclusão
  confirmDeleteBtn.addEventListener('click', async () => {
    if (!selectedCarrinhoId) return;

    confirmDeleteBtn.disabled = true;
    confirmDeleteBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Excluindo...';

    try {
      const deleteUrl = "{{ route('admin.carrinho.destroy', ':id') }}".replace(':id', selectedCarrinhoId);

      const response = await axios.post(deleteUrl, null, {
        headers: { 'X-CSRF-TOKEN': csrfToken },
        params: { _method: 'DELETE' }
      });

      if (response.data.success) {
        confirmDeleteBtn.innerHTML = '<i class="fa-solid fa-check me-1"></i> Excluído!';
        setTimeout(() => location.reload(), 1000);
      } else {
        alert(response.data.message || 'Erro ao excluir o carrinho.');
      }

    } catch (error) {
      console.error("Erro ao excluir carrinho:", error);
      alert(error.response?.data?.message || 'Erro inesperado ao excluir.');
    } finally {
      confirmDeleteBtn.disabled = false;
      confirmDeleteBtn.innerHTML = '<i class="fa-solid fa-trash me-1"></i> Excluir';
      modalDelete.hide();
    }
  });
});
</script>
