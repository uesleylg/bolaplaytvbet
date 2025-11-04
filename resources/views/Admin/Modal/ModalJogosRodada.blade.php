<div class="modal fade" id="ModalJogosRodada" tabindex="-1" aria-labelledby="ModalJogosRodada" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content" style="border-radius: 12px; background-color: #0f172a; color: #e2e8f0;">

      <!-- Cabeçalho -->
      <div class="modal-header border-0" style="background-color:#1e293b; color:white; border-top-left-radius: 12px; border-top-right-radius: 12px;">
        <h5 class="modal-title" id="meuModalLabel">
          <i class="fa-solid fa-calendar-days me-2"></i> Jogos disponíveis hoje
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <!-- Corpo -->
      <div class="modal-body p-4">
        <div class="mb-3 text-secondary">
          <i class="fa-regular fa-clock me-2"></i> Atualizado em <span class="text-light fw-bold">{{ date('d/m/Y H:i') }}</span>
        </div>

        <div class="list-group">
          <!-- Jogo 1 -->
          <div class="list-group-item d-flex justify-content-between align-items-center bg-dark border-secondary rounded-3 mb-2 p-3">
            <div>
              <div class="fw-bold text-light">
                <i class="fa-solid fa-shield-halved me-2 text-primary"></i> Flamengo 
                <span class="text-secondary mx-2">vs</span> 
                <i class="fa-solid fa-shield-halved me-2 text-danger"></i> Palmeiras
              </div>
              <small class="text-muted"><i class="fa-regular fa-clock me-1"></i> 18:30 | Maracanã</small>
            </div>
            <button class="btn btn-sm btn-primary rounded-pill px-3">
              <i class="fa-solid fa-plus me-1"></i> Selecionar
            </button>
          </div>

          <!-- Jogo 2 -->
          <div class="list-group-item d-flex justify-content-between align-items-center bg-dark border-secondary rounded-3 mb-2 p-3">
            <div>
              <div class="fw-bold text-light">
                <i class="fa-solid fa-shield-halved me-2 text-warning"></i> Corinthians 
                <span class="text-secondary mx-2">vs</span> 
                <i class="fa-solid fa-shield-halved me-2 text-success"></i> Santos
              </div>
              <small class="text-muted"><i class="fa-regular fa-clock me-1"></i> 20:00 | Neo Química Arena</small>
            </div>
            <button class="btn btn-sm btn-primary rounded-pill px-3">
              <i class="fa-solid fa-plus me-1"></i> Selecionar
            </button>
          </div>

          <!-- Jogo 3 -->
          <div class="list-group-item d-flex justify-content-between align-items-center bg-dark border-secondary rounded-3 mb-2 p-3">
            <div>
              <div class="fw-bold text-light">
                <i class="fa-solid fa-shield-halved me-2 text-info"></i> Grêmio 
                <span class="text-secondary mx-2">vs</span> 
                <i class="fa-solid fa-shield-halved me-2 text-danger"></i> Internacional
              </div>
              <small class="text-muted"><i class="fa-regular fa-clock me-1"></i> 21:45 | Arena do Grêmio</small>
            </div>
            <button class="btn btn-sm btn-primary rounded-pill px-3">
              <i class="fa-solid fa-plus me-1"></i> Selecionar
            </button>
          </div>
        </div>
      </div>

      <!-- Rodapé -->
      <div class="modal-footer border-0 d-flex justify-content-between">
        <span class="text-secondary small">Exibindo <strong>3</strong> jogos de hoje</span>
        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">
          Fechar
        </button>
      </div>
    </div>
  </div>
</div>
