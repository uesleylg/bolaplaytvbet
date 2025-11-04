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
        <form id="formUsuario" class="needs-validation" novalidate>
          <div class="row g-3">
            <!-- Nome -->
            <div class="col-md-6">
              <label for="name" class="form-label fw-semibold text-secondary">
                <i class="fa-solid fa-user me-1"></i> Nome completo
              </label>
              <input type="text" class="form-control bg-transparent text-light border-secondary" id="name" name="name" placeholder="Digite o nome" required>
              <div class="invalid-feedback">Por favor, insira o nome completo.</div>
            </div>

            <!-- Email -->
            <div class="col-md-6">
              <label for="email" class="form-label fw-semibold text-secondary">
                <i class="fa-solid fa-envelope me-1"></i> E-mail
              </label>
              <input type="email" class="form-control bg-transparent text-light border-secondary" id="email" name="email" placeholder="exemplo@email.com" required>
              <div class="invalid-feedback">Insira um e-mail válido.</div>
            </div>

            <!-- Senha -->
            <div class="col-md-6">
              <label for="password" class="form-label fw-semibold text-secondary">
                <i class="fa-solid fa-lock me-1"></i> Senha
              </label>
              <input type="password" class="form-control bg-transparent text-light border-secondary" id="password" name="password" placeholder="********" required>
              <div class="invalid-feedback">Informe uma senha.</div>
            </div>

            <!-- Telefone -->
            <div class="col-md-6">
              <label for="phone" class="form-label fw-semibold text-secondary">
                <i class="fa-solid fa-phone me-1"></i> Telefone
              </label>
              <input type="text" class="form-control bg-transparent text-light border-secondary" id="phone" name="phone" placeholder="(11) 99999-9999">
            </div>

            <!-- Perfil -->
            <div class="col-md-6">
              <label for="profile_id" class="form-label fw-semibold text-secondary">
                <i class="fa-solid fa-id-badge me-1"></i> Perfil
              </label>
              <select class="form-select bg-transparent text-light border-secondary" id="profile_id" name="profile_id" required>
                <option value="" selected disabled>Selecione o perfil</option>
                <option value="1">Cliente</option>
                <option value="3">Revendedor</option>
                <option value="2">Administrador</option>
                
              </select>
              <div class="invalid-feedback">Escolha um perfil.</div>
            </div>

            <!-- Referência -->
            <div class="col-md-6">
              <label for="referencia_id" class="form-label fw-semibold text-secondary">
                <i class="fa-solid fa-users me-1"></i> Referência
              </label>
              <input type="number" class="form-control bg-transparent text-light border-secondary" id="referencia_id" name="referencia_id" placeholder="ID do usuário de referência">
            </div>
          </div>

          <!-- Botões -->
          <div class="mt-4 d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-outline-light px-4" data-bs-dismiss="modal">
              <i class="fa-solid fa-xmark me-1"></i> Cancelar
            </button>
            <button type="submit" class="btn btn-primary px-4" style="background-color:#2563eb; border:none;">
              <i class="fa-solid fa-check me-1"></i> Salvar
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

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
