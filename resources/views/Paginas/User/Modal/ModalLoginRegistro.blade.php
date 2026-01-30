

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
       
  <!-- ALERTA DE MENSAGENS -->
  <div class="alert-area-mobile" id="alert-area"></div>

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
    <input type="text" name="username" class="form-control validate-lowercase" placeholder="Usuário" id="loginUsername" maxlength="10" required>
  </div>

  <div class="mb-3">
    <div class="input-group">
      <input type="password" name="senha" class="form-control password-input" placeholder="Senha" id="loginPassword" maxlength="12" required>
      <button class="btn btn-outline-secondary btn-show-password" type="button" tabindex="-1">
        <i class="fa-solid fa-eye"></i>
      </button>
    </div>

    <div>
      <a class="small text-muted" style="cursor:pointer;" id="recuperacao-tab-link">
        Esqueceu a senha?
      </a>
    </div>
  </div>


<button type="submit" id="login-user" class="btn w-100 text-dark fw-bold" style="background:#FAEF5C; border:0;">
  <span id="login-text">
    <i class="fa-solid fa-right-to-bracket"></i> Entrar
  </span>
</button>

</form>



          </div>

          <!-- Aba Registro -->
          <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
         <form id="register-form">
  @csrf
  <div class="mb-3">
    <input type="text" name="name" class="form-control validate-lowercase" placeholder="Usuário" id="registerName" maxlength="10" required oninput="this.value=this.value.slice(0,8)">
  </div>

  <div class="mb-3">
    <input 
  type="email" 
  name="email" 
  class="form-control" 
  placeholder="E-mail" 
  id="registerEmail" 
  required>
  </div>

  <div class="mb-3">
    <input type="tel" name="phone" class="form-control" placeholder="Telefone" id="registerPhone" maxlength="15" required>
  </div>

  <div class="mb-3">
    <div class="input-group">
      <input type="password" name="password" class="form-control password-input" placeholder="Senha" id="registerPassword" maxlength="12" required>
      <button class="btn btn-outline-secondary btn-show-password" type="button" tabindex="-1">
        <i class="fa-solid fa-eye"></i>
      </button>
    </div>
    <span class="text-muted small">
      <i class="fa-solid fa-circle-exclamation"></i> A senha deve ter pelo menos 6 caracteres!
    </span>
  </div>

  <input type="hidden" name="referencia_id" value="">

 <button type="submit" id="cadastrar-user" class="btn w-100 text-dark fw-bold" style="background:#FAEF5C; border:0;">
  <span id="cadastrar-text">Continuar</span>
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


<style>

   @media (max-width: 425px) {

    .nav-tabs, .alert-area-mobile{
      font-size:13px;
    }
    
   }
  </style>


  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- JS necessários -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>

document.querySelectorAll('.validate-lowercase').forEach(function(input) {
  input.addEventListener('input', function() {
    // Pega o valor atual e a posição do cursor
    let start = this.selectionStart;
    let end = this.selectionEnd;
    let value = this.value;

    // Remove caracteres inválidos (permite apenas a-z minúsculo e 0-9)
    value = value.replace(/[^a-z0-9]/gi, ''); // 'i' ignora case, pega maiúsculas e minúsculas
    value = value.toLowerCase(); // força minúsculas

    // Limita ao maxlength
    value = value.slice(0, this.maxLength);

    // Atualiza o valor mantendo o cursor
    this.value = value;
    this.setSelectionRange(start, end);
  });
});


  document.getElementById('registerPhone').addEventListener('input', function (e) {
    let valor = e.target.value;

    // Remove tudo que não for número
    valor = valor.replace(/\D/g, '');

    // Limita a 11 dígitos (DD + número)
    valor = valor.substring(0, 11);

    // Formata de acordo com a quantidade de números
    if (valor.length > 10) {
        valor = valor.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
    } else if (valor.length > 6) {
        valor = valor.replace(/^(\d{2})(\d{4})(\d{0,4})$/, '($1) $2-$3');
    } else if (valor.length > 2) {
        valor = valor.replace(/^(\d{2})(\d{0,5})$/, '($1) $2');
    } else if (valor.length > 0) {
        valor = valor.replace(/^(\d*)$/, '($1');
    }

    e.target.value = valor;
});


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
  button.addEventListener('click', () => {
    const input = button.parentElement.querySelector('.password-input');
    const icon = button.querySelector('i');

    if (!input) return;

    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  });
});







document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('login-form');
  const alertArea = document.getElementById('alert-area');
  const loginButton = document.getElementById('login-user');
  const loginText = document.getElementById('login-text');

  form.addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    const data = {
      name: formData.get('username'),
      password: formData.get('senha'),
    };

    alertArea.innerHTML = '';

    // 🔒 Desabilita o botão e muda o texto
    loginButton.disabled = true;
    loginText.innerHTML = `
      <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
      Entrando...
    `;

    try {
      const response = await axios.post('/login', data, {
        headers: {
          'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
        }
      });

      showAlert(
        response.data.message,
        response.data.success ? 'success' : 'danger'
      );

      if (response.data.success && response.data.redirect) {
        setTimeout(() => {
          window.location.href = response.data.redirect;
        }, 1500);
        return; // não reativa o botão porque vai redirecionar
      }

    } catch (error) {
      if (error.response && error.response.data && error.response.data.message) {
        showAlert(error.response.data.message, 'danger');
      } else {
        showAlert('Ocorreu um erro inesperado.', 'danger');
      }
    }

    // 🔓 Reativa o botão se der erro
    loginButton.disabled = false;
    loginText.innerHTML = `
      <i class="fa-solid fa-right-to-bracket"></i> Entrar
    `;
  });

  function showAlert(message, type = 'danger') {
    const alert = document.createElement('div');
    alert.className = `alert alert-${type} alert-dismissible fade show mt-3`;
    alert.setAttribute('role', 'alert');
    alert.innerHTML = `
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

    alertArea.innerHTML = '';
    alertArea.appendChild(alert);

    setTimeout(() => {
      const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
      bsAlert.close();
    }, 4000);
  }
});





document.addEventListener('DOMContentLoaded', function () {

  const urlParams = new URLSearchParams(window.location.search);
  const refCode = urlParams.get("reference");

  // Se existir um código, envia para o input hidden
  if (refCode) {
    const refInput = document.querySelector("input[name=referencia_id]");
    if (refInput) {
      refInput.value = refCode;
    }
  }

  const form = document.getElementById('register-form');
  const alertArea = document.getElementById('alert-area');
  const registerButton = document.getElementById('cadastrar-user');
  const registerText = document.getElementById('cadastrar-text');

  form.addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    alertArea.innerHTML = '';

    // 🔒 Desabilita botão e mostra loading
    registerButton.disabled = true;
    registerText.innerHTML = `
      <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
      Processando...
    `;

    try {
      const response = await axios.post('/register', formData, {
        headers: {
          'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
        }
      });

      if (response.data.success) {
        showAlert(response.data.message, 'success');

        setTimeout(() => {
          window.location.href = response.data.redirect;
        }, 1500);

        return; // não reativa o botão (vai redirecionar)
      } else {
        showAlert(response.data.message || 'Erro ao cadastrar.', 'danger');
      }

    } catch (error) {
      if (error.response && error.response.data && error.response.data.message) {
        showAlert(error.response.data.message, 'danger');
      } else {
        showAlert('Erro inesperado. Tente novamente.', 'danger');
      }
    }

    // 🔓 Reativa botão se houve erro
    registerButton.disabled = false;
    registerText.innerHTML = 'Continuar';
  });

  // Função de alerta
  function showAlert(message, type = 'danger') {
    const alert = `
      <div class="alert alert-${type} alert-dismissible fade show mt-3" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;

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

