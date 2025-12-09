@php
    $limite_saque = \App\Models\Configuracao::where('chave', 'limite_saque')->value('valor') ?? 20;
@endphp

<style>
.modal-custom {
    max-width: 500px;
}
</style>

<!-- Modal Solicitar Saque -->
<div class="modal fade" id="modalSaque" tabindex="-1" aria-labelledby="modalSaqueLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-custom">
    <div class="modal-content" style="border-radius: 12px; background-color: #0f172a; color: #e2e8f0;">

      <!-- Cabeçalho -->
      <div class="modal-header border-0" style="background-color:#1e293b; color:white; border-top-left-radius: 12px; border-top-right-radius: 12px;">
        <h5 class="modal-title" id="modalSaqueLabel">
          <i class="fa-solid fa-wallet me-2"></i> Solicitar Saque
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Corpo -->
      <div class="modal-body p-4">
        
        <div id="alert-area-saque"></div>

        <!-- Saldo disponível -->
        <div class="mb-3 text-center p-3 bg-secondary bg-opacity-25 rounded-3">
          <i class="fa-solid fa-coins me-2 text-warning"></i>
          Saldo disponível: <span id="saldoDisponivel">{{ auth()->user()->carteira->saldo ?? 0 }}</span>
        </div>

        <form id="formSaque" class="needs-validation" novalidate>
          @csrf
          <div class="row g-3">

            <!-- Valor do Saque -->
            <div class="col-12">
              <div class="form-floating">
                <input type="number" class="form-control bg-slate border-0 text-light" 
                       id="valor" name="valor" placeholder="Valor do Saque" 
                       required 
                       min="{{ $limite_saque }}"
                       max="{{ auth()->user()->carteira->saldo ?? 0 }}">
                <label for="valor"><i class="fa-solid fa-coins me-2"></i> Valor do Saque</label>
              </div>
              <div class="form-text text-warning mt-1">
                Valor mínimo de saque: R$ {{ $limite_saque }}
              </div>
              <div class="invalid-feedback">Informe um valor válido de saque.</div>
            </div>

            <!-- Chave PIX -->
            <div class="col-12">
              <div class="form-floating">
                <input type="text" class="form-control bg-slate border-0 text-light" 
                       id="chavePix" name="chavePix" placeholder="Chave PIX" required>
                <label for="chavePix"><i class="fa-solid fa-key me-2"></i> Chave PIX</label>
              </div>
              <div class="invalid-feedback">Informe sua chave PIX.</div>
            </div>

          </div>

          <!-- Botões -->
          <div class="d-flex gap-2 mt-4">
            <button type="button" class="btn fw-semibold flex-grow-1" data-bs-dismiss="modal"
                    style="background-color:#1e293b; color:white; border:none; border-radius:8px;">
              <i class="fa-solid fa-xmark me-2"></i> Cancelar
            </button>

            <button type="submit" class="btn fw-semibold flex-grow-1"
                    style="background-color:#facc15; color:#1e293b; border:none; border-radius:8px;">
              <i class="fa-solid fa-paper-plane me-2"></i> Solicitar
            </button>
          </div>

        </form>

        <style>
          .bg-slate { background-color: #1e293b !important; }
          .form-control:focus {
              background-color: #1e293b !important;
              border-color: #334155 !important;
              color: #fff !important;
              box-shadow: 0 0 0 0.2rem rgba(30, 41, 59, 0.4) !important;
          }
          label { color: #94a3b8 !important; }
          .btn:hover { opacity: 0.9; }
        </style>

      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('formSaque');
  const alertArea = document.getElementById('alert-area-saque');
  const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  const saldo = parseFloat(document.getElementById('saldoDisponivel').textContent.replace(',', '.'));
  const limiteMinimo = {{ $limite_saque }};

  form.addEventListener('submit', async function(e) {
    e.preventDefault();
    alertArea.innerHTML = '';

    const valorInput = parseFloat(document.getElementById('valor').value);

    if (valorInput < limiteMinimo) {
      alertArea.innerHTML = `<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
        Valor mínimo de saque é R$${limiteMinimo}.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>`;
      return;
    }

    if (valorInput > saldo) {
      alertArea.innerHTML = `<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        Valor maior que o saldo disponível.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>`;
      return;
    }

    if (!form.checkValidity()) {
      form.classList.add('was-validated');
      return;
    }

    const formData = new FormData(form);
    const btnSubmit = form.querySelector('button[type="submit"]');
    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Enviando...';

    try {
      const response = await axios.post(
        "{{ route('usuario.solicitar.saque') }}",
        formData,
        { headers: { 'X-CSRF-TOKEN': csrfToken } }
      );

      if (response.data.success) {
        alertArea.innerHTML = `<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
          ${response.data.message}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>`;
        setTimeout(() => location.reload(), 1500);
      } else {
        alertArea.innerHTML = `<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
          ${response.data.message || 'Erro ao solicitar saque.'}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>`;
      }

    } catch (error) {
      console.error(error);
      alertArea.innerHTML = `<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        Erro inesperado. Tente novamente.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>`;
    } finally {
      btnSubmit.disabled = false;
      btnSubmit.innerHTML = '<i class="fa-solid fa-paper-plane me-2"></i> Solicitar';
    }
  });
});
</script>
