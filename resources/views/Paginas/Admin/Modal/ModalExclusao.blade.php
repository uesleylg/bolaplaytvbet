<!-- Modal de Confirmação de Exclusão (REUTILIZÁVEL) -->
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
          Tem certeza que deseja excluir 
          <strong id="deleteItemName" class="text-warning"></strong>?
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


<script>
document.addEventListener("click", function (e) {
    const btn = e.target.closest(".btnOpenDeleteModal");
    if (!btn) return;

    // Dados recebidos do botão
    const itemId = btn.dataset.id;
    const itemName = btn.dataset.name ?? 'este item';
    const deleteUrl = btn.dataset.url;

    // Coloca o nome no modal
    document.getElementById("deleteItemName").innerText = itemName;

    // Salva os dados no botão de confirmar exclusão
    const confirmBtn = document.getElementById("btnConfirmDelete");
    confirmBtn.dataset.id = itemId;
    confirmBtn.dataset.url = deleteUrl;

    // Abrir modal
    const modal = new bootstrap.Modal(document.getElementById("ModalConfirmDelete"));
    modal.show();
});

// Confirmar exclusão
document.getElementById("btnConfirmDelete").addEventListener("click", function () {
    const itemId = this.dataset.id;
    const deleteUrl = this.dataset.url;

    fetch(deleteUrl, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert("Erro ao excluir.");
        }
    })
    .catch(err => {
        alert("Erro no servidor.");
        console.error(err);
    });
});
</script>
