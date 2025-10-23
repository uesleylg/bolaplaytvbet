

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:#2c2e50; border:1px solid #fdf50347;">

      <!-- Cabeçalho -->
      <div class="modal-header d-flex" style="font-size:18px; color:white; font-weight:bold; text-align:left; border:none;">
        ⚽BolaPlay <div style="margin-left:5px; color:#0dcaf0;">Bet</div>
        <button type="button" class="btn-close btn-close-white position-absolute end-0 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Corpo -->
      <div class="modal-body p-3">
        <div id="alert-container" class="alert-login"></div>

        <!-- Abas -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Entrar</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">Registrar</button>
          </li>
        </ul>

        <!-- Conteúdo das Abas -->
        <div class="tab-content mt-3" id="myTabContent">

          <!-- Aba Login -->
          <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
            <form id="login-form">
              @csrf
              <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Usuário" id="loginUsername" maxlength="8" required oninput="this.value=this.value.slice(0,8)" style="color:white !important;">
              </div>

              <div class="mb-3">
                <div class="input-group">
                  <input type="password" name="senha" class="form-control password-input" placeholder="Senha" id="loginPassword" maxlength="12" required>
                  <button class="btn btn-outline-secondary btn-show-password" type="button" tabindex="-1">
                    <i class="fa-solid fa-eye"></i>
                  </button>
                </div>
                <div>
        

                  <a class="small text-muted" 
   style="color:white; cursor:pointer;" 
   id="recuperacao-tab-link">
   Esqueceu a senha?
</a>

                </div>
              </div>

              <button type="submit" id="login-user" class="btn w-100 text-dark fw-bold" style="background:#FAEF5C; border:0;">
                <i class="fa-solid fa-right-to-bracket"></i> Entrar
              </button>
            </form>
          </div>

          <!-- Aba Registro -->
          <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
            <form id="register-form">
              @csrf
              <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Nome de Usuário" id="registerUsername" maxlength="8" required oninput="this.value=this.value.slice(0,8)">
              </div>
              <div class="mb-3">
                <input type="tel" name="telefone" class="form-control" placeholder="Telefone" id="phone" maxlength="15" required>
              </div>
              <div class="mb-3">
                <div class="input-group">
                  <input type="password" name="senha" class="form-control password-input" placeholder="Senha" id="registerPassword" maxlength="12" required>
                  <button class="btn btn-outline-secondary btn-show-password" type="button" tabindex="-1">
                    <i class="fa-solid fa-eye"></i>
                  </button>
                </div>
                <span class="text-muted small"><i class="fa-solid fa-circle-exclamation"></i> A senha deve ter pelo menos 6 caracteres!</span>
              </div>

              <input type="hidden" name="referencia" value="">

              <button type="submit" id="cadastrar-user" class="btn w-100 text-dark fw-bold" style="background:#FAEF5C; border:0;">
                Continuar
              </button>
            </form>
          </div>

          <!-- Aba Recuperação -->
          <div class="tab-pane fade" id="emailrecuperacao" role="tabpanel" aria-labelledby="recuperacao-tab">
            <div id="alerta" style="display:none;"></div>
            <form id="reset-form" class="formrecupera">
              <div class="mb-3">
                <input type="text" name="usuario_reset" class="form-control" placeholder="Usuário ou E-mail" id="recuEmail" required>
              </div>
              <button type="submit" id="reset-user" class="btn w-100 text-dark fw-bold" style="background:#FAEF5C; border:0;">
                <i class="fa-solid fa-key"></i> Recuperar
              </button>
            </form>
          </div>

        </div>
      </div>
      <br>
    </div>
  </div>
</div>


<!-- JS necessários -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>

  document.addEventListener('DOMContentLoaded', function () {
  const loginModal = document.getElementById('loginModal');

  loginModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget; // botão que abriu o modal
    const tab = button.getAttribute('data-tab'); // pega "login" ou "register"
    
    const tabTrigger = document.querySelector(`#myTab button[data-bs-target="#${tab}"]`);
    if(tabTrigger) {
      const bootstrapTab = new bootstrap.Tab(tabTrigger);
      bootstrapTab.show(); // mostra a aba correta
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const loginTab = document.getElementById('login'); // aba login
  const registerTab = document.getElementById('register'); // aba registro
  const recuperarTab = document.getElementById('emailrecuperacao'); // aba recuperação
  const linkRecuperacao = document.getElementById('recuperacao-tab-link'); // link "Esqueceu a senha?"

  // Cria o link "Voltar ao login" e esconde inicialmente
  const voltarLogin = document.createElement('a');
  voltarLogin.textContent = 'Voltar ao login';
  voltarLogin.href = '#';
  voltarLogin.className = 'small text-muted mt-2 d-block';
  voltarLogin.style.cursor = 'pointer';
  voltarLogin.style.color = 'white';
  voltarLogin.style.display = 'none';
  recuperarTab.appendChild(voltarLogin);

  // Quando clica em "Esqueceu a senha?"
  linkRecuperacao.addEventListener('click', function (e) {
    e.preventDefault();
    loginTab.classList.remove('show', 'active');
    recuperarTab.classList.add('show', 'active');
    voltarLogin.style.display = 'block';
  });

  // Quando clica em "Voltar ao login"
  voltarLogin.addEventListener('click', function (e) {
    e.preventDefault();
    recuperarTab.classList.remove('show', 'active');
    loginTab.classList.add('show', 'active');
    voltarLogin.style.display = 'none';
  });

  // Escuta quando qualquer aba do Bootstrap é mostrada
  const tabButtons = document.querySelectorAll('#myTab button[data-bs-toggle="tab"]');
  tabButtons.forEach(function(btn) {
    btn.addEventListener('shown.bs.tab', function () {
      // Remove a aba de recuperação sempre que trocar para login ou registro
      if (recuperarTab.classList.contains('show')) {
        recuperarTab.classList.remove('show', 'active');
        voltarLogin.style.display = 'none';
      }
    });
  });
});


  document.querySelectorAll('.btn-show-password').forEach(button => {
    button.addEventListener('mousedown', () => {
      const input = button.parentElement.querySelector('.password-input');
      if (input) input.type = 'text';
    });
    button.addEventListener('mouseup', () => {
      const input = button.parentElement.querySelector('.password-input');
      if (input) input.type = 'password';
    });
    button.addEventListener('mouseleave', () => {
      const input = button.parentElement.querySelector('.password-input');
      if (input) input.type = 'password';
    });
    button.addEventListener('touchstart', () => {
      const input = button.parentElement.querySelector('.password-input');
      if (input) input.type = 'text';
    }, { passive: true });
    button.addEventListener('touchend', () => {
      const input = button.parentElement.querySelector('.password-input');
      if (input) input.type = 'password';
    });
  });


</script>
