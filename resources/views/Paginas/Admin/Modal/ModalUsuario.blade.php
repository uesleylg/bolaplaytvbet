<div class="modal fade" id="ModalUsuario" tabindex="-1" aria-labelledby="ModalUsuario" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 12px; background-color: #0f172a; color: #e2e8f0;">

      <!-- Cabeçalho -->
      <div class="modal-header border-0" style="background-color:#1e293b; color:white; border-top-left-radius: 12px; border-top-right-radius: 12px;">
        <h5 class="modal-title" id="meuModalLabel">
          <i class="fa-solid fa-user-plus me-2"></i> Cadastrar Usuário
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <!-- Corpo -->
      <div class="modal-body p-4">
        <!-- Área para alertas -->
<div id="alert-area"></div>

<form id="formUsuario" class="needs-validation" novalidate>
  @csrf

  <div class="row g-3">
    <!-- Usuário -->
    <div class="col-md-6">
      <div class="form-floating">
        <input type="text" class="form-control bg-slate border-0 text-light"
               id="name" name="name" placeholder="Usuário" required>
        <label for="name">
          <i class="fa-solid fa-user me-2"></i> Usuário
        </label>
      </div>
      <div class="invalid-feedback">Por favor, insira o nome completo.</div>
    </div>

    <!-- Email -->
    <div class="col-md-6">
      <div class="form-floating">
        <input type="email" class="form-control bg-slate border-0 text-light"
               id="email" name="email" placeholder="E-mail" required>
        <label for="email">
          <i class="fa-solid fa-envelope me-2"></i> E-mail
        </label>
      </div>
      <div class="invalid-feedback">Insira um e-mail válido.</div>
    </div>

    <!-- Senha -->
    <div class="col-md-6">
      <div class="form-floating">
        <input type="password" class="form-control bg-slate border-0 text-light"
               id="password" name="password" placeholder="Senha" required>
        <label for="password">
          <i class="fa-solid fa-lock me-2"></i> Senha
        </label>
      </div>
      <div class="invalid-feedback">Informe uma senha.</div>
    </div>

    <!-- Telefone -->
    <div class="col-md-6">
      <div class="form-floating">
        <input type="text" class="form-control bg-slate border-0 text-light"
               id="phone" name="phone" placeholder="Telefone">
        <label for="phone">
          <i class="fa-solid fa-phone me-2"></i> Telefone
        </label>
      </div>
    </div>

    <!-- Perfil -->
    <div class="col-md-6">
      <div class="form-floating">
        <select class="form-select bg-slate border-0 text-light"
                id="profile_id" name="profile_id" required>
          <option value="" disabled selected>Selecione</option>
          <option value="1">Cliente</option>
          <option value="2">Revendedor</option>
          <option value="3">Administrador</option>
        </select>
        <label for="profile_id">
          <i class="fa-solid fa-id-badge me-2"></i> Perfil
        </label>
      </div>
      <div class="invalid-feedback">Escolha um perfil.</div>
    </div>

    <!-- Referência -->
    <div class="col-md-6">
      <div class="form-floating">
        <input type="number" class="form-control bg-slate border-0 text-light"
               id="referencia_id" name="referencia_id" placeholder="Referência">
        <label for="referencia_id">
          <i class="fa-solid fa-users me-2"></i> Referência (ID)
        </label>
      </div>
    </div>
  </div>

  <!-- Status -->
  <div class="mt-4" id="status-container" style="display:none;">
    <label class="form-label fw-semibold text-light d-block">
      <i class="fa-solid fa-toggle-on me-2"></i> Status da Conta
    </label>

    <div class="form-check form-switch d-flex align-items-center">
      <input class="form-check-input me-2"
             type="checkbox"
             id="status"
             name="status"
             value="Ativo"
             style="width: 3rem; height: 1.5rem; cursor:pointer;">
      <label class="form-check-label fw-semibold text-light" id="statusLabel">Ativo</label>
    </div>
  </div>

  <!-- Botões -->
  <div class="d-flex justify-content-end gap-2 mt-4">
    <button type="button" class="btn px-4 py-2 fw-semibold"
            data-bs-dismiss="modal"
            style="background-color:#1e293b; color:white; border:none; border-radius:8px;">
      <i class="fa-solid fa-xmark me-2"></i> Cancelar
    </button>

    <button type="submit" class="btn px-4 py-2 fw-semibold"
            style="background-color:#2563eb; color:white; border:none; border-radius:8px;">
      <i class="fa-solid fa-check me-2"></i> Salvar
    </button>
  </div>

</form>

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

<!-- Máscara para telefone -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
  $('#phone').mask('(00) 00000-0000');
</script>

      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('formUsuario');
  const alertArea = document.getElementById('alert-area');
  const modalEl = document.getElementById('ModalUsuario');
  const statusContainer = document.getElementById('status-container');
  const statusInput = document.getElementById('status');
  const statusLabel = document.getElementById('statusLabel');
  const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

  // Forçar nome minúsculo e sem espaço
  const nameInput = document.getElementById('name');
  nameInput.addEventListener('input', e => {
    e.target.value = e.target.value.toLowerCase().replace(/\s/g, '');
  });

  // Resetar o formulário ao abrir o modal
  modalEl.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const mode = button.getAttribute('data-mode');
    const modalTitle = modalEl.querySelector('.modal-title');

    form.reset();
    form.classList.remove('was-validated');
    alertArea.innerHTML = '';

    if (mode === 'edit') {
      // Preenche dados para edição
      modalTitle.innerHTML = `<i class="fa-solid fa-pen me-2"></i> Editar Usuário`;
      statusContainer.style.display = 'block';

      document.getElementById('name').value = button.dataset.name;
      document.getElementById('email').value = button.dataset.email;
      document.getElementById('phone').value = button.dataset.phone || '';
      document.getElementById('profile_id').value = button.dataset.profile || '';
      document.getElementById('referencia_id').value = button.dataset.referencia || '';
      document.getElementById('password').removeAttribute('required');
      document.getElementById('password').placeholder = 'Deixe em branco para manter';

      // Controle do status
      const currentStatus = button.dataset.status || 'Ativo';
      statusInput.checked = currentStatus === 'Ativo';
      statusInput.value = currentStatus;
      updateStatusLabel(currentStatus);

      form.setAttribute('data-id', button.dataset.id);
      form.setAttribute('data-mode', 'edit');
    } else {
      // Modo criar
      modalTitle.innerHTML = `<i class="fa-solid fa-user-plus me-2"></i> Cadastrar Usuário`;
      statusContainer.style.display = 'none';
      document.getElementById('password').setAttribute('required', true);
      form.removeAttribute('data-id');
      form.setAttribute('data-mode', 'create');
    }
  });

  // Alternar texto, valor e cor do status
  statusInput.addEventListener('change', function () {
    const newStatus = this.checked ? 'Ativo' : 'Bloqueado';
    this.value = newStatus;
    updateStatusLabel(newStatus);
  });

  // Função para atualizar o texto e cor do status
  function updateStatusLabel(status) {
    statusLabel.textContent = status;
    if (status === 'Ativo') {
      statusLabel.classList.remove('text-danger');
      statusLabel.classList.add('text-success');
    } else {
      statusLabel.classList.remove('text-success');
      statusLabel.classList.add('text-danger');
    }
  }

  // Envio do formulário
  form.addEventListener('submit', async function (e) {
    e.preventDefault();
    alertArea.innerHTML = '';

    if (!form.checkValidity()) {
      form.classList.add('was-validated');
      return;
    }

    const formData = new FormData(form);
    const mode = form.getAttribute('data-mode');
    const userId = form.getAttribute('data-id');
    const btnSubmit = form.querySelector('button[type="submit"]');

    // Adiciona o status atual
    formData.set('status', statusInput.checked ? 'Ativo' : 'Bloqueado');

    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Salvando...';

    try {
      let response;

      if (mode === 'edit') {
        // ✅ Rota dinâmica para update
        const updateUrl = "{{ route('admin.usuario.update', ':id') }}".replace(':id', userId);
        formData.append('_method', 'PUT'); // Laravel reconhece PUT via POST

        response = await axios.post(updateUrl, formData, {
          headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'multipart/form-data'
          }
        });
      } else {
        // ✅ Rota de criação
        const createUrl = "{{ route('admin.register.post') }}";
        response = await axios.post(createUrl, formData, {
          headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'multipart/form-data'
          }
        });
      }

      // ✅ Verificação de resposta
      if (response.data.success) {
        showAlert(response.data.message, 'success');
        setTimeout(() => {
          const modal = bootstrap.Modal.getInstance(modalEl);
          if (modal) modal.hide();
          location.reload();
        }, 1500);
      } else {
        showAlert(response.data.message || 'Erro ao salvar o usuário.', 'danger');
      }

    } catch (error) {
      console.error("Erro ao enviar formulário:", error);
      if (error.response?.data?.message) {
        showAlert(error.response.data.message, 'danger');
      } else {
        showAlert('Erro inesperado. Tente novamente.', 'danger');
      }
    } finally {
      btnSubmit.disabled = false;
      btnSubmit.innerHTML = '<i class="fa-solid fa-check me-1"></i> Salvar';
    }
  });

  // Função para exibir alertas no modal
  function showAlert(message, type = 'danger') {
    const alert = `
      <div class="alert alert-${type} alert-dismissible fade show mt-3" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>`;
    alertArea.innerHTML = alert;

    setTimeout(() => {
      const alertElement = alertArea.querySelector('.alert');
      if (alertElement) {
        alertElement.classList.remove('show');
        alertElement.classList.add('fade');
        setTimeout(() => alertArea.innerHTML = '', 300);
      }
    }, 4000);
  }
});
</script>



<!-- Script Bootstrap Validation -->
<script>
  (() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();
</script>
