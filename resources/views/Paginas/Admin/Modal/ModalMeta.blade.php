<div class="modal fade" id="ModalMeta" tabindex="-1" aria-labelledby="ModalMetaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 12px; background-color: #0f172a; color: #e2e8f0;">

      <!-- Cabeçalho -->
      <div class="modal-header border-0" style="background-color:#1e293b; color:white; border-top-left-radius: 12px; border-top-right-radius: 12px;">
        <h5 class="modal-title" id="ModalMetaLabel">
          <i class="fa-solid fa-bullseye me-2"></i> Cadastrar Meta
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <!-- Corpo -->
      <div class="modal-body p-4">

        <div id="alert-meta-area"></div>

        <form id="formMeta" class="needs-validation" novalidate>
          @csrf

          <div class="row g-3">

            <!-- Nível -->
            <div class="col-md-4">
              <div class="form-floating">
                <input type="number" class="form-control bg-slate border-0 text-light"
                       id="nivel" name="nivel" placeholder="Nível" required>
                <label for="nivel">
                  <i class="fa-solid fa-layer-group me-2"></i> Nível
                </label>
              </div>
              <div class="invalid-feedback">Informe o nível da meta.</div>
            </div>

            <!-- Quantidade de Indicados -->
            <div class="col-md-4">
              <div class="form-floating">
                <input type="number" class="form-control bg-slate border-0 text-light"
                       id="quantidade_indicados" name="quantidade_indicados"
                       placeholder="Indicados" required>
                <label for="quantidade_indicados">
                  <i class="fa-solid fa-users me-2"></i> Qtde. Indicados
                </label>
              </div>
              <div class="invalid-feedback">Informe a quantidade mínima.</div>
            </div>

            <!-- Bônus -->
            <div class="col-md-4">
              <div class="form-floating">
                <input type="number" step="0.01" class="form-control bg-slate border-0 text-light"
                       id="bonus_valor" name="bonus_valor" placeholder="Bônus" required>
                <label for="bonus_valor">
                  <i class="fa-solid fa-coins me-2"></i> Bônus (R$)
                </label>
              </div>
              <div class="invalid-feedback">Informe o valor do bônus.</div>
            </div>

            <!-- Descrição -->
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" class="form-control bg-slate border-0 text-light"
                       id="descricao" name="descricao" placeholder="Descrição" required>
                <label for="descricao">
                  <i class="fa-solid fa-pen me-2"></i> Descrição da Meta
                </label>
              </div>
              <div class="invalid-feedback">Descreva brevemente a meta.</div>
            </div>

          </div>

          <!-- Status -->
          <div class="mt-4">
            <label class="form-label fw-semibold text-light d-block">
              <i class="fa-solid fa-toggle-on me-2"></i> Status da Meta
            </label>

            <div class="form-check form-switch d-flex align-items-center">
              <input class="form-check-input me-2"
                     type="checkbox"
                     id="statusMeta"
                     name="status"
                     value="Ativo"
                     checked
                     style="width: 3rem; height: 1.5rem; cursor:pointer;">
              <label class="form-check-label fw-semibold text-light" id="statusMetaLabel">Ativo</label>
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

        <!-- Estilo -->
        <style>
          .bg-slate { background-color: #1e293b !important; }
          .form-control:focus, .form-select:focus {
            background-color: #1e293b !important;
            border-color: #334155 !important;
            color: #fff !important;
            box-shadow: 0 0 0 0.2rem rgba(30, 41, 59, 0.4) !important;
          }
          label { color: #94a3b8 !important; }

          .form-check-input {
            background-color: #334155; border-color: #475569;
          }
          .form-check-input:checked {
            background-color: #2563eb; border-color: #2563eb;
          }
          .btn:hover { background-color: #334155 !important; }
        </style>

      </div>

    </div>
  </div>
</div>
