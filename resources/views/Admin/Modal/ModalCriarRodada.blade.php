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
        <form id="formCadastroRodada" autocomplete="off">

          <!-- Linha 1: Valor e Premiação -->
          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="number" class="form-control bg-slate border-0 text-light" id="valorBilhete" placeholder="Valor do bilhete" step="0.01">
                <label for="valorBilhete"><i class="fa-solid fa-money-bill-wave me-2"></i> Valor do Bilhete (R$)</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="number" class="form-control bg-slate border-0 text-light" id="premiacaoEstimada" placeholder="Premiação Estimada">
                <label for="premiacaoEstimada"><i class="fa-solid fa-trophy me-2"></i> Premiação Estimada (R$)</label>
              </div>
            </div>
          </div>

          <!-- Linha 2: Descrição -->
          <div class="row g-3 mt-3">
            <div class="col-12">
              <div class="form-floating">
                <textarea class="form-control bg-slate border-0 text-light" id="descricao" placeholder="Descrição" rows="2"></textarea>
                <label for="descricao"><i class="fa-solid fa-align-left me-2"></i> Descrição</label>
              </div>
            </div>
          </div>

          <!-- Linha 3: Datas -->
          <div class="row g-3 mt-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="datetime-local" class="form-control bg-slate border-0 text-light" id="dataInicio">
                <label for="dataInicio"><i class="fa-solid fa-calendar-day me-2"></i> Início</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="datetime-local" class="form-control bg-slate border-0 text-light" id="dataEncerramento">
                <label for="dataEncerramento"><i class="fa-solid fa-calendar-xmark me-2"></i> Encerramento</label>
              </div>
            </div>
          </div>

          <!-- Linha 4: Modo do jogo e Nº de palpites -->
          <div class="row g-3 mt-3 align-items-end">
            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select bg-slate border-0 text-light" id="modoJogo">
                  <option value="casa_empate_visitante" selected>Casa | Empate | Visitante</option>
                </select>
                <label for="modoJogo"><i class="fa-solid fa-futbol me-2"></i> Modo do Jogo</label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="number" class="form-control bg-slate border-0 text-light" id="numPalpites" placeholder="Número de palpites" min="1">
                <label for="numPalpites"><i class="fa-solid fa-list-ol me-2"></i> Nº de Palpites</label>
              </div>
            </div>
          </div>

          <!-- Linha 5: Permitir apostas múltiplas -->
          <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="permiteMultiplas">
              <label class="form-check-label fw-semibold text-light" for="permiteMultiplas">
                <i class="fa-solid fa-sliders me-2"></i> Permitir Apostas Múltiplas
              </label>
            </div>

            <button type="submit" class="btn px-4 py-2 fw-semibold" style="background-color:#1e293b; color:white; border:none; border-radius:8px;">
              <i class="fa-solid fa-save me-2"></i> Criar
            </button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>

<style>
  /* Dark visual refinado */
  .bg-slate {
    background-color: #1e293b !important;
  }
  .form-control:focus, .form-select:focus {
    background-color: #1e293b !important;
    border-color: #334155 !important;
    color: #fff !important;
    box-shadow: 0 0 0 0.2rem rgba(30, 41, 59, 0.4) !important;
  }
  .form-select option {
    background-color: #1e293b;
    color: #f1f5f9;
  }
  label {
    color: #94a3b8 !important;
  }
  .form-check-input {
    background-color: #334155;
    border-color: #475569;
  }
  .form-check-input:checked {
    background-color: #2563eb;
    border-color: #2563eb;
  }
  .btn:hover {
    background-color: #334155 !important;
  }
</style>
