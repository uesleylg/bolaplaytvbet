@extends('Layout/Admin/AppAdmin')

@section('title', 'Carrinhos de Apostas')

@section('content')
<style>
  body {
    background: #0d1117 !important;
  }

  /* Tabs modernas */
  .config-tab {
    background: #161b22;
    border-radius: 8px;
    color: #9ca3af;
    border: 1px solid transparent;
    margin-right: 6px;
    padding: 10px 18px;
    transition: .3s;
    cursor: pointer;
  }

  .config-tab.active,
  .config-tab:hover {
    background: #1f2937;
    border-color: #0ea5e9;
    color: #fff;
  }

  /* Card moderno */
  .config-card {
    background: #161b22;
    border: 1px solid #1e2530;
    padding: 22px;
    border-radius: 14px;
  }

  /* Inputs */
  .form-control,
  .form-select,
  textarea {
    background: #0d1117 !important;
    border: 1px solid #30363d !important;
    color: #fff !important;
  }

  .form-control:focus,
  .form-select:focus,
  textarea:focus {
    border-color: #0ea5e9 !important;
    box-shadow: 0 0 0 1px #0ea5e9 !important;
  }

  /* Botões */
  .btn-primary {
    background: #0ea5e9;
    border: none;
  }

  .btn-primary:hover {
    background: #0284c7;
  }

  .btn-success {
    background: #10b981;
    border: none;
  }

  .btn-danger {
    background: #ef4444;
    border: none;
  }

  .slide-box {
    background: #0d1117;
    border: 1px solid #30363d;
    border-radius: 10px;
    padding: 15px;
  }
</style>

<div class="container-fluid py-4">

  <h3 class="text-white fw-semibold mb-4">
    <i class="fas fa-gear text-info me-2"></i> Configurações
  </h3>

  <!-- NAV TABS -->
 <!-- NAV TABS -->
<ul class="nav nav-tabs border-0 mb-4" role="tablist" style="gap:6px;">

  <li class="nav-item" role="presentation">
    <button class="config-tab active" id="geral-tab" data-bs-toggle="tab" data-bs-target="#geral" type="button" role="tab">Geral</button>
  </li>

  <li class="nav-item" role="presentation">
    <button class="config-tab" id="aparencia-tab" data-bs-toggle="tab" data-bs-target="#aparencia" type="button" role="tab">Aparência</button>
  </li>

  <li class="nav-item" role="presentation">
    <button class="config-tab" id="slide-tab" data-bs-toggle="tab" data-bs-target="#slide" type="button" role="tab">Slides</button>
  </li>

  <li class="nav-item" role="presentation">
    <button class="config-tab" id="contato-tab" data-bs-toggle="tab" data-bs-target="#contato" type="button" role="tab">Contato</button>
  </li>

  <li class="nav-item" role="presentation">
    <button class="config-tab" id="pagamento-tab" data-bs-toggle="tab" data-bs-target="#pagamento" type="button" role="tab">Pagamentos</button>
  </li>

  <li class="nav-item" role="presentation">
    <button class="config-tab" id="seguranca-tab" data-bs-toggle="tab" data-bs-target="#seguranca" type="button" role="tab">Segurança</button>
  </li>

</ul>

  <!-- TAB CONTENT -->
  <div class="tab-content">

    <!-- ========================= GERAL ========================= -->
   <div class="tab-pane fade show active" id="geral">
  <div class="config-card">

    <h5 class="text-white mb-3">Informações Gerais</h5>

    <form action="{{ route('admin.config.salvar') }}" method="POST">
      @csrf

      <div class="row g-3">

        <!-- Nome do Site -->
        <div class="col-md-6">
          <label class="text-white">Nome do Site</label>
          <input type="text" 
                 name="nome_site" 
                 class="form-control"
                 value="{{ $configs['nome_site'] ?? '' }}">
        </div>

        <!-- Modo Manutenção -->
        <div class="col-md-6">
          <label class="text-white">Modo Manutenção</label>
          <select name="modo_manutencao" class="form-select">
            <option value="0" {{ ($configs['modo_manutencao'] ?? 0) == 0 ? 'selected' : '' }}>Desativado</option>
            <option value="1" {{ ($configs['modo_manutencao'] ?? 0) == 1 ? 'selected' : '' }}>Ativado</option>
          </select>
        </div>

        <!-- Mensagem de manutenção -->
        <div class="col-12">
          <label class="text-white">Mensagem de Manutenção</label>
          <textarea name="mensagem_manutencao" 
                    class="form-control" 
                    rows="3">{{ $configs['mensagem_manutencao'] ?? '' }}</textarea>
        </div>

      </div>

      <button class="btn btn-primary mt-3">
        <i class="fas fa-check"></i> Salvar
      </button>

    </form>

  </div>
</div>


    <!-- ========================= APARÊNCIA ========================= -->
    <div class="tab-pane fade" id="aparencia">
      <div class="config-card">

        <h5 class="text-white mb-3">Aparência</h5>

        <div class="row g-4">

          <div class="col-md-6">
            <label class="text-white">Logo Desktop (300x80px)</label>
            <input type="file" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="text-white">Logo Mobile (200x60px)</label>
            <input type="file" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="text-white">Favicon (32x32px)</label>
            <input type="file" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="text-white">Cor primária do site</label>
            <input type="color" class="form-control form-control-color">
          </div>

        </div>

        <button class="btn btn-primary mt-3">
          <i class="fas fa-check"></i> Salvar
        </button>

      </div>
    </div>

    <!-- ========================= SLIDES ========================= -->
    <div class="tab-pane fade" id="slide">
      <div class="config-card">

        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="text-white">Slides do Site</h5>
          <button class="btn btn-success">
            <i class="fas fa-plus"></i> Novo Slide
          </button>
        </div>

        <div class="row g-4">

          <!-- Slide Box -->
          <div class="col-md-6">
            <div class="slide-box">

              <h6 class="text-info mb-3">Slide 1</h6>

              <label class="text-white">Imagem Desktop (1920x600)</label>
              <input type="file" class="form-control mb-3">

              <label class="text-white">Imagem Mobile (1080x900)</label>
              <input type="file" class="form-control">

              <button class="btn btn-danger btn-sm mt-3">
                <i class="fas fa-trash"></i> Remover
              </button>

            </div>
          </div>

        </div>

      </div>
    </div>

    <!-- ========================= CONTATO ========================= -->
    <div class="tab-pane fade" id="contato">
      <div class="config-card">

        <h5 class="text-white mb-3">Informações de Contato</h5>

        <div class="row g-3">

          <div class="col-md-6">
            <label class="text-white">WhatsApp</label>
            <input type="text" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="text-white">Email</label>
            <input type="email" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="text-white">Instagram</label>
            <input type="text" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="text-white">Telegram</label>
            <input type="text" class="form-control">
          </div>

        </div>

        <button class="btn btn-primary mt-3">
          <i class="fas fa-check"></i> Salvar
        </button>

      </div>
    </div>

    <!-- ========================= PAGAMENTOS ========================= -->
    <div class="tab-pane fade" id="pagamento">
      <div class="config-card">

        <h5 class="text-white mb-3">Pagamentos</h5>

        <div class="row g-3">

          <div class="col-md-6">
            <label class="text-white">Chave PIX</label>
            <input type="text" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="text-white">Nome do Dono da Conta</label>
            <input type="text" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="text-white">Banco</label>
            <input type="text" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="text-white">Tipo de Conta</label>
            <select class="form-select">
              <option>Poupança</option>
              <option>Corrente</option>
            </select>
          </div>

        </div>

        <button class="btn btn-primary mt-3">
          <i class="fas fa-check"></i> Salvar
        </button>

      </div>
    </div>

    <!-- ========================= SEGURANÇA ========================= -->
    <div class="tab-pane fade" id="seguranca">
      <div class="config-card">

        <h5 class="text-white mb-3">Segurança</h5>

        <div class="row g-3">

          <div class="col-md-6">
            <label class="text-white">reCAPTCHA Site Key</label>
            <input type="text" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="text-white">Limite de Tentativas Login</label>
            <input type="number" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="text-white">Tempo Bloqueio (minutos)</label>
            <input type="number" class="form-control">
          </div>

        </div>

        <button class="btn btn-primary mt-3">
          <i class="fas fa-check"></i> Salvar
        </button>

      </div>
    </div>

  </div>

</div>

@endsection