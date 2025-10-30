@extends('Layout/App')


@section('title', 'BolaPlay Bet')

@section('content')





<div style="padding-top: 0px !important;" class="container py-5">





<div style="margin-top: 20px; color: white; background-color: rgb(30 41 59);; border: 1px solid #ffffff4d;  font-size: 18px; padding: 15px; border-radius: 10px; margin-bottom: 0px; font-family: 'Roboto', sans-serif; font-weight: bolder; box-shadow: 0 0 10px 2px #00000052; display: flex; justify-content: space-between; align-items: center;">
  
  <div class="text-mobile">
   <i style="color: #fffb00ff;" class="fa-solid fa-trophy"></i> BOLÃO HOJE - 23/10/2025 <br> <label style="color:#00ffa9; font-weight: 200;">Premiação: R$ 2.000,00</label>
  </div>

  <div style="display: flex; align-items: center; gap: 10px;">
      <button class="text-mobile-vermais" data-bs-toggle="modal" data-bs-target="#ModalVermais" style="border:1px solid #cececeff; border-radius:10px; background-color:#334155; color:white; padding: 5px 15px; font-weight: bold;">
        <i class="fa-solid fa-list"></i> Ver outros
      </button>
    <i data-bs-toggle="modal" data-bs-target="#ModalInfo" class="fa-solid fa-circle-question text-mobile-info" style=" cursor: pointer;"></i>
  </div>
</div>

<div style="border-radius: 0 0 10px 10px;
 color:#ffe200; font-weight: bold; background: ; padding:10px; text-align: center;">


<div class="">


  <div class="card bg-dark text-white border-0 rounded-4 shadow p-4" style="background: #0f172a;">
 

    <div class="row text-center g-3 flex-nowrap overflow-auto">
      <div class="col-4">
        <div class="p-3 bg-secondary bg-opacity-25 rounded-4 h-100">
          <i class="fa-solid fa-ticket fs-3 text-warning mb-2"></i>
          <h6 class="text-uppercase fw-semibold mb-1">Bilhetes do Site</h6>
          <h4 class="fw-bold text-light text-valor">13.788</h4>
        </div>
      </div>

      <div class="col-4">
        <div class="p-3 bg-secondary bg-opacity-25 rounded-4 h-100">
          <i class="fa-solid fa-globe fs-3 text-warning mb-2"></i>
          <h6 class="text-uppercase fw-semibold mb-1">Bilhetes Externos</h6>
          <h4 class="fw-bold text-light text-valor">5</h4>
        </div>
      </div>

      <div class="col-4">
        <div class="p-3 bg-secondary bg-opacity-25 rounded-4 h-100">
          <i class="fa-solid fa-list-ol fs-3 text-warning mb-2"></i>
          <h6 class="text-uppercase fw-semibold mb-1">Total de Bilhetes</h6>
          <h4 class="fw-bold text-light text-valor">13.793</h4>
        </div>
      </div>
    </div>
  </div>




<div class="alerta-card p-4 rounded-4 shadow-sm">
  <h5 class="fw-bold text-warning">
    <i class="fa-solid fa-triangle-exclamation"></i> ATENÇÃO
  </h5>

  <p class="mb-3">
    Existem bilhetes externos concorrendo ao prêmio junto com os do site. 
    O líder do ranking <strong>pode não ser o vencedor final</strong>.
  </p>

  <p class="fw-bold text-warning mb-3">
    📄 Um PDF de Auditoria será divulgado antes dos jogos com todos os bilhetes participantes.
  </p>

  <a href="#" class="btn-auditoria" target="_blank">
    <i class="bi bi-file-earmark-pdf-fill"></i> PDF DE AUDITORIA
  </a>
</div>




<div class="text-title-rank"><i class="fa-solid fa-futbol"></i> Resultado dos jogos:</div>

<!-- 🔹 CARROSSEL DE PARTIDAS - ESTILO 2025 -->
<section class="position-relative  bg-dark-custom rounded-4 overflow-hidden">

  <!-- Botões de Navegação -->
  <button id="scrollLeft" class="btn-nav position-absolute shadow d-flex align-items-center justify-content-center">
    <i class="fa-solid fa-chevron-left"></i>
  </button>

  <button id="scrollRight" class="btn-nav position-absolute shadow d-flex align-items-center justify-content-center">
    <i class="fa-solid fa-chevron-right"></i>
  </button>

  <!-- Container dos Cards -->
  <div id="cardsContainer" style="padding-top: 10px;" class="d-flex overflow-auto px-3 pb-4 scroll-smooth gap-3 justify-content-start">
    
    <!-- CARD -->
    <div class="match-card">
      <div class="match-header">
        <span class="badge bg-success">ENCERRADO</span>
        <small class="fw-semibold text-secondary">EUROPA: Campeões</small>
      </div>

      <div class="match-body">
        <div class="team text-center">
          <img src="https://upload.wikimedia.org/wikipedia/en/5/53/Arsenal_FC.svg" alt="Arsenal">
          <p class="team-name">ARSENAL</p>
        </div>

        <div class="score text-center">
          <span class="fw-bold fs-4 text-success">4</span>
          <span class="fw-bold fs-5 mx-1 text-light">X</span>
          <span class="fw-bold fs-4 text-danger">0</span>
        </div>

        <div class="team text-center">
          <img src="https://upload.wikimedia.org/wikipedia/en/5/53/Arsenal_FC.svg" alt="Atlético Madrid">
          <p class="team-name">ARSENAL</p>
        </div>
      </div>

      <p class="match-stats">C: 6934 (74.5%) • E: 1356 (14.6%) • V: 1012 (10.9%)</p>
    </div>


      <!-- CARD -->
    <div class="match-card">
      <div class="match-header">
        <span class="badge bg-success">ENCERRADO</span>
        <small class="fw-semibold text-secondary">EUROPA: Campeões</small>
      </div>

      <div class="match-body">
        <div class="team text-center">
          <img src="https://upload.wikimedia.org/wikipedia/en/5/53/Arsenal_FC.svg" alt="Arsenal">
          <p class="team-name">ARSENAL</p>
        </div>

        <div class="score text-center">
          <span class="fw-bold fs-4 text-success">4</span>
          <span class="fw-bold fs-5 mx-1 text-light">X</span>
          <span class="fw-bold fs-4 text-danger">0</span>
        </div>

        <div class="team text-center">
          <img src="https://upload.wikimedia.org/wikipedia/en/5/53/Arsenal_FC.svg" alt="Atlético Madrid">
          <p class="team-name">ARSENAL</p>
        </div>
      </div>

      <p class="match-stats">C: 6934 (74.5%) • E: 1356 (14.6%) • V: 1012 (10.9%)</p>
    </div>



      <!-- CARD -->
    <div class="match-card">
      <div class="match-header">
        <span class="badge bg-success">ENCERRADO</span>
        <small class="fw-semibold text-secondary">EUROPA: Campeões</small>
      </div>

      <div class="match-body">
        <div class="team text-center">
          <img src="https://upload.wikimedia.org/wikipedia/en/5/53/Arsenal_FC.svg" alt="Arsenal">
          <p class="team-name">ARSENAL</p>
        </div>

        <div class="score text-center">
          <span class="fw-bold fs-4 text-success">4</span>
          <span class="fw-bold fs-5 mx-1 text-light">X</span>
          <span class="fw-bold fs-4 text-danger">0</span>
        </div>

        <div class="team text-center">
          <img src="https://upload.wikimedia.org/wikipedia/en/5/53/Arsenal_FC.svg" alt="Atlético Madrid">
          <p class="team-name">ARSENAL</p>
        </div>
      </div>

      <p class="match-stats">C: 6934 (74.5%) • E: 1356 (14.6%) • V: 1012 (10.9%)</p>
    </div>



      <!-- CARD -->
    <div class="match-card">
      <div class="match-header">
        <span class="badge bg-success">ENCERRADO</span>
        <small class="fw-semibold text-secondary">EUROPA: Campeões</small>
      </div>

      <div class="match-body">
        <div class="team text-center">
          <img src="https://upload.wikimedia.org/wikipedia/en/5/53/Arsenal_FC.svg" alt="Arsenal">
          <p class="team-name">ARSENAL</p>
        </div>

        <div class="score text-center">
          <span class="fw-bold fs-4 text-success">4</span>
          <span class="fw-bold fs-5 mx-1 text-light">X</span>
          <span class="fw-bold fs-4 text-danger">0</span>
        </div>

        <div class="team text-center">
          <img src="https://upload.wikimedia.org/wikipedia/en/5/53/Arsenal_FC.svg" alt="Atlético Madrid">
          <p class="team-name">ARSENAL</p>
        </div>
      </div>

      <p class="match-stats">C: 6934 (74.5%) • E: 1356 (14.6%) • V: 1012 (10.9%)</p>
    </div>



    <!-- CARD AO VIVO -->
    <div class="match-card live">
      <div class="match-header">
        <span class="badge bg-warning text-dark">AO VIVO</span>
        <small class="fw-semibold text-secondary">LIBERTADORES</small>
      </div>

      <div class="match-body">
        <div class="team text-center">
          <img src="https://upload.wikimedia.org/wikipedia/en/5/53/Arsenal_FC.svg" alt="Palmeiras">
          <p class="team-name">PALMEIRAS</p>
        </div>

        <div class="score text-center">
          <span class="fw-bold fs-4 text-success">2</span>
          <span class="fw-bold fs-5 mx-1 text-light">X</span>
          <span class="fw-bold fs-4 text-danger">1</span>
        </div>

        <div class="team text-center">
          <img src="https://upload.wikimedia.org/wikipedia/en/5/53/Arsenal_FC.svg" alt="LDU">
          <p class="team-name">LDU</p>
        </div>
      </div>

      <p class="match-stats">C: 4235 (68%) • E: 903 (14.5%) • V: 1098 (17.5%)</p>
    </div>

    <!-- Outros cards... -->
  </div>
</section>

<!-- 🔹 CSS Estilo 2025 -->
<style>

.btn-auditoria {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background-color: #facc15;
  color: #0f172a;
  font-weight: 600;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  text-decoration: none;
  transition: all 0.2s ease;
  margin-top: 0.8rem;
}

.btn-auditoria:hover {
  background-color: #eab308;
  color: #000;
  transform: translateY(-2px);
}

/* Ícone PDF */
.btn-auditoria i {
  font-size: 1rem;
}

/* Mobile adjustments */
@media (max-width:768px) {
  .alerta-card {
    padding: 1rem;
  }
  .alerta-card h5 {
    font-size: 1rem;
  }
  .btn-auditoria {
    width: 100%;
    justify-content: center;
  }
}

  .alerta-card {
    margin-top:20px;
  background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
  color: #f8fafc;
  border-left: 6px solid #facc15;
  border-right: 6px solid #facc15;
  border-radius: 16px;
  box-shadow: 0 0 20px rgba(250, 204, 21, 0.1);
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.alerta-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 0 25px rgba(250, 204, 21, 0.2);
}

.alerta-card h5 {
  display: flex;
  align-items: center;
  gap: 0.4rem;
}

.alerta-card p {
  line-height: 1.5;
  font-size: 0.95rem;
}

/* Responsivo */
@media (max-width: 768px) {
  .alerta-card {
    padding: 1.2rem;
  }
  .alerta-card p {
  
    font-size: 0.8rem;
        text-align: justify;
  }
}


  .bg-dark-custom {
    background-color: #0f172a;
  }

  .scroll-smooth { scroll-behavior: smooth; }

  .match-card {
    flex: 0 0 auto;
    width: 280px;
    background: #1e293b;
    border: 1px solid #198754;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    padding: 1rem;
    transition: all 0.3s ease;
  }

  .match-card.live {
    border-color: #ffc107;
    background: #2b3648;
  }

  .match-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(25,135,84,0.25);
  }

  .match-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: .75rem;
  }

  .match-body {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: .5rem;
  }

  .team img {
    width: 45px;
    height: 45px;
    object-fit: contain;
  }

  .team-name {
    font-size: .85rem;
    font-weight: 600;
    margin-top: .25rem;
    color: #f8fafc;
    text-transform: uppercase;
  }

  .match-stats {
    font-size: .8rem;
    color: #94a3b8;
    text-align: center;
    margin: 0;
  }

  /* 🔹 Botões */
  .btn-nav {
    width: 52px;
    height: 52px;
    border: none;
    border-radius: 50%;
    color: #fff;
    background: radial-gradient(circle at center, #198754, #145c3b);
    box-shadow: 0 0 15px rgba(25,135,84,0.5);
    transition: all 0.3s ease;
    z-index: 10;
  }

  .btn-nav:hover {
    box-shadow: 0 0 25px rgba(25,135,84,0.8);
    transform: scale(1.1);
  }

  /* 🔹 Posição estratégica */
  #scrollLeft {
    top: 48%;
    left: 1rem;
  }

  #scrollRight {
    top: 48%;
    right: 1rem;
  }

  /* 🔹 Mobile */
  @media (max-width: 768px) {
    .match-card { width: 95%; }

    .btn-nav {
      width: 42px;
      height: 42px;
      font-size: 0.85rem;
      box-shadow: 0 0 10px rgba(25,135,84,0.4);
      background: radial-gradient(circle at center, #198754, #0e422c);
      opacity: 0.95;
    }

    #scrollLeft {
      top: unset;
      bottom: 0rem;
      left: 35%;
    }

    #scrollRight {
      top: unset;
      bottom: 0rem;
      right: 35%;
    }
  }
</style>

<!-- 🔹 Script de Rolagem -->
<script>
  const container = document.getElementById("cardsContainer");
  const scrollAmount = () => {
    const card = container.querySelector(".match-card");
    const gap = parseInt(window.getComputedStyle(container).gap) || 0;
    return card.offsetWidth + gap;
  };

  document.getElementById("scrollLeft").addEventListener("click", () => {
    container.scrollBy({ left: -scrollAmount(), behavior: "smooth" });
  });

  document.getElementById("scrollRight").addEventListener("click", () => {
    container.scrollBy({ left: scrollAmount(), behavior: "smooth" });
  });
</script>

<div class="text-title-rank"><i class="fa-solid fa-ranking-star"></i> Resumo do Ranking:</div>

<div class="container my-4">
  <div class="ranking-card p-4 rounded-4 shadow-sm">

    <ul class="list-unstyled mb-0">
      <li class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary">
        <span><i class="bi bi-trophy-fill text-warning me-2"></i>22 bilhete(s)</span>
        <span class="fw-bold text-success">8 ponto(s)</span>
      </li>
      <li class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary">
        <span><i class="bi bi-star-fill text-warning me-2"></i>360 bilhete(s)</span>
        <span class="fw-bold text-info">7 ponto(s)</span>
      </li>
      <li class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary">
        <span><i class="bi bi-lightning-fill text-warning me-2"></i>1726 bilhete(s)</span>
        <span class="fw-bold text-primary">6 ponto(s)</span>
      </li>
      <li class="d-flex justify-content-between align-items-center py-2">
        <span><i class="bi bi-x-circle-fill text-danger me-2"></i>5 bilhete(s)</span>
        <span class="fw-bold text-danger">0 ponto(s)</span>
      </li>
    </ul>
  </div>
</div>

<div class="text-title-rank"><i class="fa-solid fa-ranking-star"></i> Ranking dos Bilhetes:</div>
<div style="position: relative; width: 100%; ">
  <i class="fa-solid fa-magnifying-glass" style="position: absolute; top: 50%; left: 12px; transform: translateY(-50%); color: #fff;"></i>
  <input type="text" class="form-control w-100" placeholder="Buscar bilhete ou nome..." style="
    font-size: 20px;
    padding-left: 40px;
    border-radius: 12px;
    border: 2px solid #334155;
    background-color: #0f172a;
    color: #fff;
    height: 55px;
    font-weight: 500;
    transition: all 0.3s ease;
  " 
  onfocus="this.style.borderColor='#ffe200'; this.style.boxShadow='0 0 10px #ffe200';" 
  onblur="this.style.borderColor='#334155'; this.style.boxShadow='none';">
</div>



  
    <div class="table-responsive" style="margin-top: 20px;">

<style>

.text-uppercase {
      color:#ffffff99;
   
    }
  .ranking-container {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.08);
  }

  .ranking-header {
    display: grid;
    grid-template-columns: 60px 100px 1fr 90px repeat(8, 35px);
    padding: 0.75rem 1rem;
    background: #1e293b;
    color: #ffe200;
    font-weight: 600;
    font-size: 0.9rem;
    text-align: center;
  }

  .ranking-row {
    display: grid;
    grid-template-columns: 60px 100px 1fr 90px repeat(8, 35px);
    align-items: center;
    padding: 0.6rem 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    background: #1e293b;
    transition: all 0.2s ease;
  }

  .ranking-row:nth-child(even) {
    background: #162032;
  }

  .ranking-row:hover {
    background: #243249;
    transform: translateY(-1px);
    cursor: pointer;
  }

  .ranking-row i {
    font-size: 18px;
   
    margin: auto;
  }

  .ranking-row .fa-circle-check { color: rgb(16 185 129); }
  .ranking-row .fa-circle-xmark { color: #ef4444; }
  .ranking-row .fa-trophy { color: #ffd700; }
  .ranking-row .fa-medal { color: #e98e00; }

  .ranking-row span {
    font-size: 0.9rem;
    color: #e2e8f0;
  }

  .result-icons-mobile{
    display: none;
  }

  /* MOBILE MODE */
  @media (max-width: 768px) {
    .text-valor{
      font-size: 13px;
    }
    .text-uppercase {
      color:#ffffff99;
      font-size: 9px;
    }
    .ranking-row i {
    font-size: 18px;
    margin: 0px;
}
    .ranking-header {
      display: none;
    }

    .ranking-row {
      border: 1px solid #ffffff5c;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 0.4rem;
      padding: 1rem;
      background: #1e293b;
      border-radius: 10px;
      margin-bottom: 0.8rem;
    }

    .ranking-row:hover {
      transform: none;
      background: #243249;
    }

    .ranking-row > div {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 0.9rem;
      color: #cbd5e1;
    }

    .ranking-row > div:first-child {
      font-weight: 600;
      color: #ffe200;
      font-size: 1rem;
    }

    /* Mostra os ícones agrupados no mobile */
    .ranking-row .result-icons-mobile {
      display: flex;
      gap: 6px;
      flex-wrap: wrap;
      margin-top: 0.5rem;
    }

    .ranking-row .result-icons-mobile i {
      font-size: 18px;
    }

    /* Esconde os ícones do layout desktop */
    .ranking-row .icon-col {
      display: none;
    }
  }
</style>

<div class=" my-4">


  <div class="ranking-container">

    <!-- Cabeçalho (Desktop) -->
    <div class="ranking-header">
      <div>#</div>
      <div>Bilhete</div>
      <div>Comprador</div>
      <div>Acertos</div>
      <div>01</div><div>02</div><div>03</div><div>04</div><div>05</div><div>06</div><div>07</div><div>08</div>
    </div>

    <!-- Linha 1 -->
    <div class="ranking-row" data-bs-toggle="modal" data-bs-target="#ModalAposta">
      <div><i class="fa-solid fa-trophy"></i> 1º</div>
      <div><i class="fa-solid fa-ticket"></i> BLT-001</div>
      <div><i class="fa-solid fa-user"></i> João Silva</div>
      <div><span>4 acertos</span></div>

      <!-- Ícones por coluna (desktop) -->
      <div class="icon-col"><i class="fa-solid fa-circle-xmark"></i></div>
      <div class="icon-col"><i class="fa-solid fa-circle-check"></i></div>
      <div class="icon-col"><i class="fa-solid fa-circle-check"></i></div>
      <div class="icon-col"><i class="fa-solid fa-circle-check"></i></div>
      <div class="icon-col"><i class="fa-solid fa-circle-check"></i></div>
      <div class="icon-col"><i class="fa-solid fa-circle-check"></i></div>
      <div class="icon-col"><i class="fa-solid fa-circle-check"></i></div>
      <div class="icon-col"><i class="fa-solid fa-circle-check"></i></div>

      <!-- Versão mobile -->
      <div class="result-icons-mobile">
        <i class="fa-solid fa-circle-xmark"></i>
        <i class="fa-solid fa-circle-check"></i>
        <i class="fa-solid fa-circle-check"></i>
        <i class="fa-solid fa-circle-check"></i>
        <i class="fa-solid fa-circle-check"></i>
        <i class="fa-solid fa-circle-check"></i>
        <i class="fa-solid fa-circle-check"></i>
        <i class="fa-solid fa-circle-check"></i>
      </div>
    </div>

    <!-- Linha 2 -->
    <div class="ranking-row">
      <div><i class="fa-solid fa-medal"></i> 2º</div>
      <div><i class="fa-solid fa-ticket"></i> BLT-002</div>
      <div><i class="fa-solid fa-user"></i> Maria Santos</div>
      <div><span>3 acertos</span></div>
      <div class="icon-col"><i class="fa-solid fa-circle-xmark"></i></div>
      <div class="icon-col"><i class="fa-solid fa-circle-check"></i></div>
      <div class="icon-col"><i class="fa-solid fa-circle-check"></i></div>
      <div class="icon-col"><i class="fa-solid fa-circle-check"></i></div>
      <div class="icon-col"><i class="fa-solid fa-circle-check"></i></div>
      <div class="icon-col"><i class="fa-solid fa-circle-check"></i></div>
      <div class="icon-col"><i class="fa-solid fa-circle-check"></i></div>
      <div class="icon-col"><i class="fa-solid fa-circle-check"></i></div>
      <div class="result-icons-mobile">
        <i class="fa-solid fa-circle-xmark"></i>
        <i class="fa-solid fa-circle-check"></i>
        <i class="fa-solid fa-circle-check"></i>
        <i class="fa-solid fa-circle-check"></i>
        <i class="fa-solid fa-circle-check"></i>
        <i class="fa-solid fa-circle-check"></i>
        <i class="fa-solid fa-circle-check"></i>
        <i class="fa-solid fa-circle-check"></i>
      </div>
    </div>

  </div>
</div>



  </div>




<style>

.ranking-card {
  background-color: #1e293b;
  color: #fff;
  border: 1px solid #334155;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.ranking-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 0 15px rgba(255, 255, 0, 0.08);
}

.ranking-card ul li {
  font-size: 0.95rem;
}

.ranking-card i {
  font-size: 1.1rem;
}

/* Responsivo */
@media (max-width: 768px) {
  .ranking-card {
    padding: 1rem 1.2rem;
  }
  .ranking-card ul li {
    font-size: 0.9rem;
  }
}

.text-title-rank{
  color:#ffffffad;
  text-align: left;
  margin-top:20px;
  margin-bottom:20px;
}
  .card {
  flex: 0 0 calc(25% - 1rem); /* 4 cards por linha (desktop) */
  scroll-snap-align: start;
}

@media (max-width: 992px) {
  .card {
    flex: 0 0 calc(33.333% - 1rem); /* 3 por linha (tablet) */
  }
}

@media (max-width: 768px) {
  .card {
    flex: 0 0 calc(50% - 1rem); /* 2 por linha */
  }
}

@media (max-width: 576px) {
  .card {
    flex: 0 0 100%; /* 1 por linha (mobile) */
  }
}


@media (max-width: 425px) {
.text-mobile{
  font-size:12px;
}
.text-mobile-vermais{
  font-size:10px;
}
.text-mobile-info{
   font-size:12px;
}
}

  .table-modern {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  background: rgba(15,23,42,0.9); /* fundo glass */
  backdrop-filter: blur(8px);       /* blur moderno */
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}

.table-modern thead {
  background: linear-gradient(90deg, #0f172a, #1e293b);
  color: #ffe200;
  font-weight: 600;
}

.table-modern tbody tr {
  transition: all 0.3s ease;
  cursor: pointer;
}

.table-modern tbody tr:hover {
  background: rgba(255,255,255,0.05);
  transform: scale(1.01);
}

.table-modern td i {
  font-size: 22px;
}

</style>



</div>
@include('Modal.ModalIndicacao')
@include('Modal.ModalVermais')
@include('Modal.ModalInfo')
 @include('Modal.ModalLoginRegistro')
 @include('Modal.ModalBilhete')
@endsection
