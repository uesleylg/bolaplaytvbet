<div class="modal fade" id="ModalCadastroRodada" tabindex="-1" aria-labelledby="ModalCadastroRodada" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 12px; background-color: #0f172a; color: #e2e8f0;">

      <!-- Cabeçalho -->
      <div class="modal-header border-0" style="background-color:#1e293b; color:white; border-top-left-radius: 12px; border-top-right-radius: 12px;">
        <h5 class="modal-title" id="meuModalLabel">
          <i class="fa-solid fa-plus me-2"></i> Cadastrar Rodada
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <!-- Corpo -->
      <div class="modal-body p-4">
        <div id="alert-area"></div>
        <form id="formCadastroRodada" method="POST" autocomplete="off">
          @csrf

          <!-- Nome da Rodada -->
          <div class="row g-3 mb-3">
            <div class="col-12">
              <div class="form-floating">
                <input type="text" class="form-control bg-slate border-0 text-light"
                       id="nomeRodada" name="nome" placeholder="Nome da rodada">
                <label for="nomeRodada">
                  <i class="fa-solid fa-flag-checkered me-2"></i> Nome da Rodada
                </label>
              </div>
            </div>
          </div>

          <!-- Valor e Premiação -->
          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="number" class="form-control bg-slate border-0 text-light"
                       id="valorBilhete" name="valorBilhete" placeholder="Valor do bilhete" step="0.01">
                <label for="valorBilhete">
                  <i class="fa-solid fa-money-bill-wave me-2"></i> Valor do Bilhete (R$)
                </label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="number" class="form-control bg-slate border-0 text-light"
                       id="premiacaoEstimada" name="premiacaoEstimada" placeholder="Premiação Estimada" step="0.01">
                <label for="premiacaoEstimada">
                  <i class="fa-solid fa-trophy me-2"></i> Premiação Estimada (R$)
                </label>
              </div>
            </div>
          </div>

          <!-- Descrição -->
          <div class="row g-3 mt-3">
            <div class="col-12">
              <div class="form-floating">
                <textarea class="form-control bg-slate border-0 text-light"
                          id="descricao" name="descricao" placeholder="Descrição" rows="2"></textarea>
                <label for="descricao">
                  <i class="fa-solid fa-align-left me-2"></i> Descrição
                </label>
              </div>
            </div>
          </div>

          <!-- Datas -->
          <div class="row g-3 mt-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="datetime-local" class="form-control bg-slate border-0 text-light"
                       id="dataInicio" name="dataInicio">
                <label for="dataInicio">
                  <i class="fa-solid fa-calendar-day me-2"></i> Início
                </label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="datetime-local" class="form-control bg-slate border-0 text-light"
                       id="dataEncerramento" name="dataEncerramento">
                <label for="dataEncerramento">
                  <i class="fa-solid fa-calendar-xmark me-2"></i> Encerramento
                </label>
              </div>
            </div>
          </div>

          <!-- Modo e Nº de palpites -->
          <div class="row g-3 mt-3 align-items-end">
            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select bg-slate border-0 text-light" id="modoJogo" name="modoJogo">
                  <option value="padrao" selected>Padrão</option>
                  <option value="predefinido">Pré-definido</option>
                </select>
                <label for="modoJogo">
                  <i class="fa-solid fa-futbol me-2"></i> Modo do Jogo
                </label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="number" class="form-control bg-slate border-0 text-light"
                       id="numPalpites" name="numPalpites" placeholder="Número de palpites" min="1">
                <label for="numPalpites">
                  <i class="fa-solid fa-list-ol me-2"></i> Nº de Palpites
                </label>
              </div>
            </div>
          </div>

          <!-- Apostas múltiplas -->
          <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="permite_multiplas" name="permite_multiplas" value="1" checked>
              <label class="form-check-label fw-semibold text-light" for="permite_multiplas">
                <i class="fa-solid fa-sliders me-2"></i> Permitir Apostas Múltiplas
              </label>
            </div>

            <button type="submit" class="btn px-4 py-2 fw-semibold"
                    style="background-color:#1e293b; color:white; border:none; border-radius:8px;">
              <i class="fa-solid fa-save me-2"></i> Criar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('formCadastroRodada');
  const modalTitle = document.getElementById('meuModalLabel');
  const submitButton = form.querySelector('button[type="submit"]');
  const alertArea = document.getElementById('alert-area');
  const modalCadastro = document.getElementById('ModalCadastroRodada');
  const checkbox = document.getElementById('permite_multiplas');

  // 🔸 Função de alerta elegante
  function showAlert(message, type = 'success') {
    const alert = document.createElement('div');
    alert.className = `alert alert-${type} alert-dismissible fade show mt-3`;
    alert.role = 'alert';
    alert.innerHTML = `
      <i class="fa-solid ${type === 'success' ? 'fa-circle-check' : 'fa-triangle-exclamation'} me-2"></i>
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    alertArea.innerHTML = '';
    alertArea.appendChild(alert);
    setTimeout(() => {
      alert.classList.remove('show');
      alert.classList.add('fade');
      setTimeout(() => alert.remove(), 300);
    }, 5000);
  }

  // 🔸 Preencher modal ao clicar em "Editar"
  document.querySelectorAll('.btn-editar-rodada').forEach(button => {
    button.addEventListener('click', () => {
      modalTitle.innerHTML = '<i class="fa-solid fa-pen me-2"></i> Editar Rodada';
      submitButton.innerHTML = '<i class="fa-solid fa-save me-2"></i> Salvar Alterações';
      submitButton.style.backgroundColor = '#f59e0b';
      form.setAttribute('data-editando', button.dataset.id);

      // Campos de texto
      document.getElementById('nomeRodada').value = button.dataset.nome || '';
      document.getElementById('valorBilhete').value = button.dataset.valor || '';
      document.getElementById('premiacaoEstimada').value = button.dataset.premiacao || '';
      document.getElementById('descricao').value = button.dataset.descricao || '';
      document.getElementById('dataInicio').value = button.dataset.inicio || '';
      document.getElementById('dataEncerramento').value = button.dataset.fim || '';
      document.getElementById('numPalpites').value = button.dataset.num || '';

      // Select modo
      const selectModo = document.getElementById('modoJogo');
      const modoValue = button.dataset.modo || 'padrao';
      [...selectModo.options].forEach(opt => opt.selected = (opt.value === modoValue));

      // Checkbox corrigido
      const valorMultiplas = button.dataset.multiplas;
      checkbox.checked = valorMultiplas === '1' || valorMultiplas === 'true';
    });
  });

  // 🔸 Resetar modal ao fechar
  modalCadastro.addEventListener('hidden.bs.modal', () => {
    form.reset();
    modalTitle.innerHTML = '<i class="fa-solid fa-plus me-2"></i> Cadastrar Rodada';
    submitButton.innerHTML = '<i class="fa-solid fa-save me-2"></i> Criar';
    submitButton.style.backgroundColor = '#1e293b';
    form.removeAttribute('data-editando');
    checkbox.checked = true; // padrão ligado
  });

  // 🔸 Enviar formulário (cadastrar ou editar)
  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const payload = {
      nome: document.getElementById('nomeRodada').value,
      valorBilhete: document.getElementById('valorBilhete').value,
      premiacaoEstimada: document.getElementById('premiacaoEstimada').value,
      descricao: document.getElementById('descricao').value,
      dataInicio: document.getElementById('dataInicio').value,
      dataEncerramento: document.getElementById('dataEncerramento').value,
      modoJogo: document.getElementById('modoJogo').value,
      numPalpites: document.getElementById('numPalpites').value,
      permite_multiplas: checkbox.checked ? 1 : 0,
      _token: '{{ csrf_token() }}'
    };

    // Verifica se está editando
    const idEditando = form.getAttribute('data-editando');
    const url = idEditando 
      ? `{{ url('admin/rodadas') }}/${idEditando}`
      : `{{ route('admin.rodadas.store') }}`;
    const method = idEditando ? 'put' : 'post';

    try {
      await axios({ method, url, data: payload });

      showAlert(idEditando ? 'Rodada atualizada com sucesso!' : 'Rodada cadastrada com sucesso!', 'success');

      // Atualiza a página ou tabela (opcional)
      setTimeout(() => location.reload(), 1500);

      form.reset();
      checkbox.checked = true;
      form.removeAttribute('data-editando');
    } catch (error) {
      const message = error.response?.data?.message || 'Erro ao salvar rodada. Verifique os campos.';
      showAlert(message, 'danger');
      console.error(error);
    }
  });
});
</script>


<style>
  .bg-slate { background-color: #1e293b !important; }
  .form-control:focus, .form-select:focus {
    background-color: #1e293b !important;
    border-color: #334155 !important;
    color: #fff !important;
    box-shadow: 0 0 0 0.2rem rgba(30, 41, 59, 0.4) !important;
  }
  .form-select option { background-color: #1e293b; color: #f1f5f9; }
  label { color: #94a3b8 !important; }
  .form-check-input {
    background-color: #334155; border-color: #475569;
  }
  .form-check-input:checked {
    background-color: #2563eb; border-color: #2563eb;
  }
  .btn:hover { background-color: #334155 !important; }
</style>
