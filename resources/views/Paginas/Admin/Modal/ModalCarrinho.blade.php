<!-- ==============================
     MODAL DE EDIÇÃO / CRIAÇÃO DE CARRINHO
================================== -->
<div class="modal fade" id="ModalCarrinho" tabindex="-1" aria-labelledby="ModalCarrinhoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4" style="background-color: #0f172a; color: #e2e8f0;">

      <!-- Cabeçalho -->
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold" id="ModalCarrinhoLabel">
          <i class="fa-solid fa-cart-shopping me-2 text-primary"></i>
          <span id="tituloModalCarrinho">Editar Carrinho</span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <!-- Corpo -->
      <form id="formCarrinho" class="p-3">
        <input type="hidden" id="carrinho_id" name="id">

        <div class="row g-3">
          <!-- Usuário (somente exibição) -->
          <div class="col-md-6">
            <label for="usuario_nome" class="form-label fw-semibold">Usuário</label>
            <input 
              type="text" 
              class="form-control bg-dark text-light border-secondary" 
              id="usuario_nome" 
              name="usuario_nome"
              readonly
            >
          </div>

          <!-- Rodada (somente exibição) -->
          <div class="col-md-6">
            <label for="rodada_nome" class="form-label fw-semibold">Rodada</label>
            <input 
              type="text" 
              class="form-control bg-dark text-light border-secondary" 
              id="rodada_nome" 
              name="rodada_nome"
              readonly
            >
          </div>

          <!-- Status -->
          <div class="col-md-6">
            <label for="status" class="form-label fw-semibold">Status</label>
            <select class="form-select bg-dark text-light border-secondary" id="status" name="status">
              <option value="pendente">🕓 Pendente</option>
              <option value="pago">✅ Pago</option>
              <option value="cancelado">❌ Cancelado</option>
            </select>
          </div>

          <!-- Valor Total -->
          <div class="col-md-6">
            <label for="valor_total" class="form-label fw-semibold">Valor Total (R$)</label>
            <input 
              type="number" 
              step="0.01" 
              class="form-control bg-dark text-light border-secondary" 
              id="valor_total" 
              name="valor_total">
          </div>

          <!-- Combinações -->
          <div class="col-12">
            <label for="combinacoes_compactadas" class="form-label fw-semibold">Combinações</label>
            <textarea 
              class="form-control bg-dark text-light border-secondary" 
              id="combinacoes_compactadas" 
              name="combinacoes_compactadas"
              rows="3"
              placeholder="Ex: 1x2-12x3-1x3..."></textarea>
          </div>
        </div>

        <!-- Rodapé -->
        <div class="modal-footer border-0 mt-4">
          <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">
            <i class="fa-solid fa-xmark me-1"></i> Cancelar
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-floppy-disk me-1"></i> Salvar Alterações
          </button>
        </div>
      </form>

    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('ModalCarrinho');
  const titulo = document.getElementById('tituloModalCarrinho');
  const form = document.getElementById('formCarrinho');

  // Quando o modal é aberto
  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const mode = button.getAttribute('data-mode');

    if (mode === 'create') {
      titulo.textContent = 'Novo Carrinho';
      form.reset();
      document.getElementById('carrinho_id').value = '';
      document.getElementById('usuario_nome').value = '';
      document.getElementById('rodada_nome').value = '';
    } else {
      titulo.textContent = 'Editar Carrinho';
      document.getElementById('carrinho_id').value = button.dataset.id || '';
      document.getElementById('usuario_nome').value = button.dataset.usuario_nome || '';
      document.getElementById('rodada_nome').value = button.dataset.rodada_nome || '';
      document.getElementById('status').value = button.dataset.status || 'pendente';
      document.getElementById('valor_total').value = button.dataset.valor || '';
      document.getElementById('combinacoes_compactadas').value = button.dataset.combinacoes || '';
    }
  });

  // Enviar o formulário (UPDATE)
  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const carrinhoId = document.getElementById('carrinho_id').value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    const data = {
      status: document.getElementById('status').value,
      valor_total: document.getElementById('valor_total').value,
      combinacoes_compactadas: document.getElementById('combinacoes_compactadas').value
    };

    try {
      const response = await axios.put(`/admin/carrinhos/${carrinhoId}`, data, {
        headers: {
          'X-CSRF-TOKEN': csrfToken
        }
      });

      if (response.status === 200) {
        // Fecha modal
        const modalInstance = bootstrap.Modal.getInstance(modal);
        modalInstance.hide();

        // Mensagem de sucesso
        alert('✅ Carrinho atualizado com sucesso!');
        location.reload();
      }
    } catch (error) {
      console.error('Erro ao atualizar carrinho:', error);
      alert('❌ Erro ao atualizar o carrinho. Verifique o console.');
    }
  });
});
</script>
