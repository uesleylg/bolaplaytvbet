@extends('Layout/App')


@section('title', 'BolaPlay Bet')

@section('content')


 <style>
  .text-muted {
    --bs-text-opacity: 1;
    color: rgb(195 195 195 / 75%) !important;
}
  input.form-control::placeholder {
  color: #aaa;             /* cor do placeholder */
}

.form-control, input{
  font-size: 18px;
  color:white;
  background-color: #01223e;
  border:none;
}
.nav-link {
color:white;

}



  .premio{
    box-shadow: 0 0 8px rgb(0 0 0 / 40%);
background: url("{{ asset('img/campo.png') }}") no-repeat 50%;

     border:  solid 1px #ffee00ff;
    width: 50%;
     color:white;  background-color: #011d81;
      padding: 10px;
       margin-bottom: 10px;
        border-radius:20px;
        font-weight: bold;
  }
  .btt-conf{
   
    width: 100%; 
     font-family: 'Roboto', sans-serif;
    font-weight: bold;
    padding:10px;
    background-color: #011d81;
  }
  .col-4 {
    flex: 0 0 auto;
    width: 40%;
}
  .modal{
--bs-modal-width: 625px;
  }
      .game-card {
      background-color: #1b2430;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 15px;
      box-shadow: 0 0 8px rgba(0,0,0,0.4);
    }

    .league {
      color: #9bbcf5;
      font-size: 0.9rem;
      font-weight: 500;
    }

    .match-number {
      background-color: #0d6efd;
      border-radius: 50%;
      color: #fff;
      width: 28px;
      height: 28px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      margin-right: 10px;
    }

    .odds button {
      background-color: #212d40;
      color: #fff;
      border: none;
      padding: 10px;
      border-radius: 6px;
      width: 100%;
      font-weight: 600;
      transition: 0.2s;
    }

    .odds button:hover {
      background-color: #0d6efd;
    }

    .odds small {
      display: block;
      font-size: 0.8rem;
      opacity: 0.8;
    }
  .home-bar{
    color: #0dcaf0;
    font-size:50px;
    padding-bottom:10px;
  }
  .pulse {
  color: red;
  animation: pulse-animation 1s infinite;
}

@keyframes pulse-animation {
  0% {
    transform: scale(1);
    opacity: 1;
  }
  50% {
    transform: scale(1.2);
    opacity: 0.5;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
  .legenda-premio{
    font-family: 'Bebas Neue', sans-serif;
    font-size: 23px;
    text-align:center;
  }
  .card-title-btt{
    font-family: 'Roboto', sans-serif;
    font-weight: bold;
  }

    .story-card {
      text-align: center;
      transition: transform 0.3s ease;
      flex: 1 1 100px; /* deixa os cards flexíveis */
      max-width: 130px; /* limita o tamanho máximo */
    }

    .story-card:hover {
      transform: scale(1.05);
    }

    .story-img {
      width: 100%;
      aspect-ratio: 1 / 1; /* mantém formato quadrado sempre */
      border-radius: 50%;
      background-size: cover;
      background-position: center;
      margin: 0 auto 10px;
      border: 3px solid #ff3366;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      transition: all 0.3s ease;
    }

    .story-card:hover .story-img {
      border-color: #ff6f61;
      box-shadow: 0 6px 14px rgba(0,0,0,0.3);
    }

    .story-name {
      font-family: 'Bebas Neue', sans-serif;
       letter-spacing: 2px;
      font-weight: 500;
      font-size: 1rem;
      color: #ffffff;
      text-wrap: nowrap;
    }

    /* Centraliza os stories e deixa responsivo */
    .stories-wrapper {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px; /* espaçamento entre os cards */
    }

    @media (max-width: 576px) {
      .story-card {
        max-width: 100px;
      }
    }
  </style>


<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  
  <!-- Indicadores -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>

  <!-- Slides -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('img/banner01.png') }}" class="d-block w-100" alt="Slide 1" />
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/banner01.png') }}" class="d-block w-100" alt="Slide 2" />
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/banner01.png') }}" class="d-block w-100" alt="Slide 3" />
    </div>
  </div>

  <!-- Controles -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Próximo</span>
  </button>

</div>


  <div class="container py-5" style="padding-bottom: 0px !important;">
    <div class="stories-wrapper">

      <div class="story-card">
       <i class="fa-solid fa-trophy home-bar"></i>
        <div class="story-name">RANKING</div>
      </div>

      <div class="story-card">
       <i class="fa-solid fa-play home-bar"></i>
        <div class="story-name">JOGO AO VIVO</div>
      </div>

      <div class="story-card">
     <i class="fa-brands fa-telegram home-bar"></i>
        <div class="story-name">INDICAÇÃO</div>
      </div>

  

    </div>
  </div>


  <div class="container py-5">
    <div style="color: white;background-color: #34495e; font-size: 18px; padding: 15px; border-radius: 10px; margin-bottom: 30px;  font-family: 'Roboto', sans-serif;     font-weight: bolder;   box-shadow: 0 0 10px 2px #00000052;"><i style="color:#5dff5d;" class="fa-solid fa-circle pulse"></i>  RODADAS ATIVAS DA SEMANA</div>
    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-md-4" data-bs-toggle="modal" data-bs-target="#ModalAposta">
        <div class="card  shadow-sm">
          <img src="{{ asset('img/premio01.png') }}" class="card-img-top" alt="Imagem 1">
          <div class="card-body">
            <h5 class="card-title legenda-premio">R$ 2.000,00 Premio Estimado</h5>
          
           
          </div>
           <a href="#" style="background-color:#00346c;" class="btn btn-primary w-100 card-title-btt">Participar Bolão</a>
        </div>
      </div>

      <!-- Card 2 -->
       <div class="col-md-4">
        <div class="card  shadow-sm">
          <img src="{{ asset('img/premio01.png') }}" class="card-img-top" alt="Imagem 1">
          <div class="card-body">
            <h5 class="card-title legenda-premio">R$ 2.000,00 Premio Estimado</h5>
          
           
          </div>
           <a href="#" style="background-color:#00346c;" class="btn btn-primary w-100 card-title-btt">Participar Bolão</a>
        </div>
      </div>

      <!-- Card 3 -->
    <div class="col-md-4">
        <div class="card  shadow-sm">
          <img src="{{ asset('img/premio01.png') }}" class="card-img-top" alt="Imagem 1">
          <div class="card-body">
            <h5 class="card-title legenda-premio">R$ 2.000,00 Premio Estimado</h5>
          
           
          </div>
           <a href="#" style="background-color:#00346c;" class="btn btn-primary w-100 card-title-btt">Participar Bolão</a>
        </div>
      </div>


      </div>
    </div>
  </div>

  
  <div class="container py-5">
     <div style="color: white;background-color: #34495e; font-size: 18px; padding: 15px; border-radius: 10px; margin-bottom: 30px; font-family: 'Roboto', sans-serif;     font-weight: bolder;    box-shadow: 0 0 10px 2px #00000052;"><i style="color:red;" class="fa-solid fa-circle"></i> RODADAS ENCERRADAS - Ultimas 3</div>
    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-md-4">
        <div class="card  shadow-sm">
          <img src="{{ asset('img/premio01.png') }}" class="card-img-top" alt="Imagem 1">
          <div class="card-body">
            <h5 class="card-title legenda-premio">R$ 2.000,00 Premio Estimado</h5>
          
           
          </div>
           <a href="#" style="background-color:#00346c;" class="btn btn-primary w-100 card-title-btt">Bolão Finalizado</a>
        </div>
      </div>

      <!-- Card 2 -->
       <div class="col-md-4">
        <div class="card  shadow-sm">
          <img src="{{ asset('img/premio01.png') }}" class="card-img-top" alt="Imagem 1">
          <div class="card-body">
            <h5 class="card-title legenda-premio">R$ 2.000,00 Premio Estimado</h5>
          
           
          </div>
           <a href="#" style="background-color:#00346c;" class="btn btn-primary w-100 card-title-btt">Bolão Finalizado</a>
        </div>
      </div>

      <!-- Card 3 -->
    <div class="col-md-4">
        <div class="card  shadow-sm">
          <img src="{{ asset('img/premio01.png') }}" class="card-img-top" alt="Imagem 1">
          <div class="card-body">
            <h5 class="card-title legenda-premio">R$ 2.000,00 Premio Estimado</h5>
          
           
          </div>
           <a href="#" style="background-color:#00346c;" class="btn btn-primary w-100 card-title-btt">Bolão Finalizado</a>
        </div>
      </div>


      </div>
    </div>
  </div>


 
 <div class="modal fade" id="ModalAposta" tabindex="-1" aria-labelledby="ModalAposta" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"><!-- centraliza verticalmente -->
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title" id="meuModalLabel">FAÇA SUA APOSTA</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        
        <div class="modal-body text-center">
          


            <div class="container">
              <center>
              <div class="premio"><i class="fa-solid fa-gem"></i> PREMIAÇÃO ESTIMADA <i class="fa-solid fa-gem"></i><BR> R$ 2.000,00</div>
  </center>
    <!-- Jogo 1 -->
     <i class="fa-solid fa-circle-info"></i> Para cada partida, selecione uma das opções: <b>Time vencedor</b> ou <b>empate</b> <br>
    <div class="game-card">
      <div class="d-flex align-items-center mb-2">
        <div class="match-number">1</div>
        <div class="league">
          🔍 21/10 16:00 — <strong>EUROPA:</strong> Liga dos Campeões - Fase da Liga
        </div>
      </div>
      <div class="row text-center g-2 odds">
        <div class="col-4">
          <button> <img src="https://static.flashscore.com/res/image/data/xCI9eFAN-OS9FbeGg.png"> ARSENAL-ENG <small></small></button>
        </div>
        <div style="width:20%;" class="col-4">
          <button>EMPATE <small></small></button>
        </div>
        <div class="col-4">
          <button>ATL. MADRID-ESP <img src="https://static.flashscore.com/res/image/data/Kv2QSkhT-nLBjwR1F.png"> <small></small></button>
        </div>
      </div>
    </div>

    <!-- Jogo 2 -->
    <div class="game-card">
      <div class="d-flex align-items-center mb-2">
        <div class="match-number">2</div>
        <div class="league">
          🔍 21/10 16:00 — <strong>EUROPA:</strong> Liga dos Campeões - Fase da Liga
        </div>
      </div>
      <div class="row text-center g-2 odds">
        <div class="col-4">
          <button>LEVERKUSEN-ALE <small></small></button>
        </div>
        <div style="width:20%;" class="col-4">
          <button>EMPATE <small></small></button>
        </div>
        <div class="col-4">
          <button>PSG-FRA <small></small></button>
        </div>
      </div>
    </div>

    <!-- Jogo 3 -->
    <div class="game-card">
      <div class="d-flex align-items-center mb-2">
        <div class="match-number">3</div>
        <div class="league">
          🔍 21/10 16:00 — <strong>EUROPA:</strong> Liga dos Campeões - Fase da Liga
        </div>
      </div>
      <div class="row text-center g-2 odds">
        <div class="col-4">
          <button>NEWCASTLE-ENG <small></small></button>
        </div>
        <div style="width:20%;" class="col-4">
          <button>EMPATE <small></small></button>
        </div>
        <div class="col-4">
          <button>BENFICA-POR <small></small></button>
        </div>
      </div>
    </div>
<div style="text-align: left;">
  <i class="fa-solid fa-circle-info"></i> Você precisa apostar em <b> todos os 8 jogos obrigatoriamente da rodada.</b><br>

<i class="fa-solid fa-circle-info"></i> Ainda esta com duvidas? <b>Clique aqui e saiba mais</b>


</div>
  </div>



        </div>


           <div class="modal-footer">
            
             <div class="container text-center mt-4">
  <div class="row justify-content-center g-3">
    <!-- Valor da aposta -->
    <div style="width: 50%;" class="col-12 col-md-4">
      <div class="p-3 bg-dark text-light rounded-4 shadow-sm">
       
        <div class="fw-bold mt-2">VALOR DA APOSTA</div>
        <div class="fs-4">R$ 10,00</div>
      </div>
    </div>

    <!-- Premiação estimada -->
    <div style="width: 50%; " class="col-12 col-md-4">
      <div class="p-3 bg-dark text-light rounded-4 shadow-sm">
       
        <div class="fw-bold mt-2">PREMIAÇÃO ESTIMADA</div>
        <div class="fs-4">R$ 2.000,00</div>
      </div>
    </div>
  </div>
</div>
        
          <button  type="button" class="btn btn-primary btt-conf">CONFIRMAR APOSTA</button>
        </div>
     

      </div>
    </div>
  </div>







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




@endsection
