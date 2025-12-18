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

            <!-- Título -->
            <div class="col-md-8">
              <div class="form-floating">
                <input type="text" class="form-control bg-slate border-0 text-light"
                       id="titulo" name="titulo" placeholder="Título" required>
                <label for="titulo">
                  <i class="fa-solid fa-heading me-2"></i> Título da Meta
                </label>
              </div>
              <div class="invalid-feedback">Informe um título para a meta.</div>
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

            <!-- Quantidade de Indicados -->
            <div class="col-md-6">
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

                      <!-- Modo -->
<div class="col-md-6">
  <div class="form-floating">
    <select class="form-select bg-slate border-0 text-light"
            id="modo" name="modo" required>
      <option value="" disabled selected>Selecione o modo</option>
      <option value="primeira">Primeira</option>
      <option value="recorrente">Recorrente</option>
    </select>
    <label for="modo">
      <i class="fa-solid fa-repeat me-2"></i> Modo da Meta
    </label>
  </div>
  <div class="invalid-feedback">Selecione o modo da meta.</div>
</div>

            <!-- Bônus -->
            <div class="col-md-12">
              <div class="form-floating">
                <input type="number" step="0.01" class="form-control bg-slate border-0 text-light"
                       id="bonus_valor" name="bonus_valor" placeholder="Bônus" required>
                <label for="bonus_valor">
                  <i class="fa-solid fa-coins me-2"></i> Bônus (R$)
                </label>
              </div>
              <div class="invalid-feedback">Informe o valor do bônus.</div>
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

        <!-- Estilos -->
        <style>
          .bg-slate { background-color: #1e293b !important; }
          .form-control:focus, .form-select:focus {
            background-color: #1e293b !important;
            border-color: #334155 !important;
            color: #fff !important;
            box-shadow: 0 0 0 0.2rem rgba(30, 41, 59, 0.4) !important;
          }
          label { color: #94a3b8 !important; }
          .form-check-input { background-color: #334155; border-color: #475569; }
          .form-check-input:checked { background-color: #2563eb; border-color: #2563eb; }
          .btn:hover { background-color: #334155 !important; }
        </style>

      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const modalMeta = new bootstrap.Modal(document.getElementById("ModalMeta"));
    const form = document.getElementById("formMeta");
    const alertArea = document.getElementById("alert-meta-area");

    const statusSwitch = document.getElementById("statusMeta");
    const statusLabel = document.getElementById("statusMetaLabel");

    let editMode = false;
    let currentId = null;

    // 🔄 Atualiza texto do switch
    statusSwitch.addEventListener("change", () => {
        statusSwitch.value = statusSwitch.checked ? "Ativo" : "Inativo";
        statusLabel.textContent = statusSwitch.value;
    });

    // 🔵 BOTÃO EDITAR — carrega dados no modal
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".editarMeta");
        if (!btn) return;

        const id = btn.dataset.id;
        currentId = id;
        editMode = true;

        // Muda título do modal
        document.getElementById("ModalMetaLabel").innerHTML = `
            <i class="fa-solid fa-pen me-2"></i> Editar Meta
        `;

        // Carrega dados pelo backend
        axios.get(`/admin/metas/${id}`)
            .then(res => {
                const meta = res.data.data;

                // Preenche campos
                document.getElementById("nivel").value = meta.nivel;
                document.getElementById("titulo").value = meta.titulo;
                document.getElementById("descricao").value = meta.descricao;
                document.getElementById("quantidade_indicados").value = meta.quantidade_indicados;
                document.getElementById("bonus_valor").value = meta.bonus_valor;

                statusSwitch.checked = meta.status === "Ativo";
                statusSwitch.value = meta.status;
                statusLabel.textContent = meta.status;

                modalMeta.show();
            })
            .catch(err => {
                alert("Erro ao carregar meta!");
                console.error(err);
            });
    });

    // 🟢 BOTÃO CRIAR — reseta modal
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".openCreateMeta");
        if (!btn) return;

        editMode = false;
        currentId = null;

        form.reset();
        statusSwitch.checked = true;
        statusLabel.textContent = "Ativo";

        document.getElementById("ModalMetaLabel").innerHTML = `
            <i class="fa-solid fa-bullseye me-2"></i> Cadastrar Meta
        `;

        alertArea.innerHTML = "";
        modalMeta.show();
    });


    // 🟦 SUBMIT — funciona para criar e editar
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        alertArea.innerHTML = "";

        const formData = new FormData(form);

        let url = "{{ route('admin.metas.store') }}";
        let method = "post";

        if (editMode) {
            url = `/admin/metas/update/${currentId}`;
            method = "post";
            formData.append("_method", "PUT");
        }

        axios({
            method: method,
            url: url,
            data: formData,
        })
        .then(response => {
            alertArea.innerHTML = `
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fa-solid fa-check-circle me-2"></i>
                    ${response.data.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;

            setTimeout(() => location.reload(), 1200);
        })
        .catch(error => {
            if (error.response?.status === 422) {
                const erros = error.response.data.errors;
                let msg = `
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Erro ao salvar:</strong><br>
                `;

                Object.values(erros).forEach(err => msg += `• ${err}<br>`);

                msg += `
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;

                alertArea.innerHTML = msg;

            } else {
                alertArea.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Erro inesperado!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
            }
        });
    });

});
</script>
