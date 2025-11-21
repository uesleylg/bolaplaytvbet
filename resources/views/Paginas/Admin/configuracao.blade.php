@extends('Layout/Admin/AppAdmin')

@section('title', 'Configurações')

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

    .upload-area {
    background: #0d1117;
    border: 2px dashed #30363d;
    border-radius: 12px;
    padding: 25px;
    text-align: center;
    cursor: pointer;
    transition: .3s;
        height: auto;
  }

  .upload-area:hover {
    border-color: #4a5568;
    background: #111827;
  }

  .upload-area i {
    font-size: 32px;
    color: #9ca3af;
  }

  .upload-area span {
    display: block;
    margin-top: 6px;
    color: #9ca3af;
    font-size: 14px;
  }

  .upload-area img {
    max-width: 100%;
    max-height: 120px;
    margin-top: 15px;
    border-radius: 10px;
    box-shadow: 0 0 10px #000;
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
<form action="{{ route('admin.config.salvar') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row g-4">

        <!-- LOGO DESKTOP -->
        <div class="col-md-6">
            <label class="text-white fw-semibold">Logo Desktop (300x80px)</label>
            <div class="upload-area mt-1 position-relative" onclick="document.getElementById('logo_desktop').click()" id="area_logo_desktop">
                @if(!empty($configs['logo_desktop']))
                    <img id="preview_logo_desktop_saved" src="{{ asset('storage/' . $configs['logo_desktop']) }}" style="max-width:100%; margin-top:10px;">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0"
                            onclick="event.stopPropagation(); excluirImagem('logo_desktop')">
                        <i class="fas fa-trash"></i>
                    </button>
                @else
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Clique para selecionar uma imagem</span>
                    <img id="preview_logo_desktop" style="display:none; max-width:100%; margin-top:10px;">
                @endif
            </div>
            <input type="file" id="logo_desktop" name="logo_desktop" class="d-none"
                   onchange="previewImage(this, 'preview_logo_desktop', 'preview_logo_desktop_saved', 'area_logo_desktop')">
        </div>

        <!-- LOGO MOBILE -->
        <div class="col-md-6">
            <label class="text-white fw-semibold">Logo Mobile (200x45px)</label>
            <div class="upload-area mt-1 position-relative" onclick="document.getElementById('logo_mobile').click()" id="area_logo_mobile">
                @if(!empty($configs['logo_mobile']))
                    <img id="preview_logo_mobile_saved" src="{{ asset('storage/' . $configs['logo_mobile']) }}" style="max-width:100%; margin-top:10px;">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0"
                            onclick="event.stopPropagation(); excluirImagem('logo_mobile')">
                        <i class="fas fa-trash"></i>
                    </button>
                @else
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Clique para selecionar uma imagem</span>
                    <img id="preview_logo_mobile" style="display:none; max-width:100%; margin-top:10px;">
                @endif
            </div>
            <input type="file" id="logo_mobile" name="logo_mobile" class="d-none"
                   onchange="previewImage(this, 'preview_logo_mobile', 'preview_logo_mobile_saved', 'area_logo_mobile')">
        </div>

        <!-- FAVICON -->
        <div class="col-md-6">
            <label class="text-white fw-semibold">Favicon (32x32px)</label>
            <div class="upload-area mt-1 position-relative" onclick="document.getElementById('favicon').click()" id="area_favicon">
                @if(!empty($configs['favicon']))
                    <img id="preview_favicon_saved" src="{{ asset('storage/' . $configs['favicon']) }}" style="max-height:60px; margin-top:10px;">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0"
                            onclick="event.stopPropagation(); excluirImagem('favicon')">
                        <i class="fas fa-trash"></i>
                    </button>
                @else
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Clique para selecionar uma imagem</span>
                    <img id="preview_favicon" style="display:none; max-height:60px; margin-top:10px;">
                @endif
            </div>
            <input type="file" id="favicon" name="favicon" class="d-none"
                   onchange="previewImage(this, 'preview_favicon', 'preview_favicon_saved', 'area_favicon')">
        </div>

        <!-- COR PRIMÁRIA -->
        <div class="col-md-6">
            <label class="text-white fw-semibold">Cor primária do site</label>
            <input type="color" class="form-control form-control-color mt-1"
                   name="cor_primaria"
                   value="{{ $configs['cor_primaria'] ?? '#000000' }}"
                   style="border-radius:10px; height:48px;">
        </div>

    </div>

    <button class="btn btn-primary mt-4 px-4 py-2" style="border-radius:10px;">
        <i class="fas fa-check"></i> Salvar
    </button>
</form>
  </div>
</div>

<!-- JS -->
<script>
function previewImage(input, previewId, savedId = null) {
    const file = input.files[0];
    const preview = document.getElementById(previewId);

    if (savedId) {
        const saved = document.getElementById(savedId);
        if (saved) saved.style.display = "none";
    }

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = "block";
        }
        reader.readAsDataURL(file);
    }
}

function excluirImagem(chave) {
    if(!confirm('Deseja realmente excluir esta imagem?')) return;

    fetch("{{ route('admin.config.excluir') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ chave: chave })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            alert('Imagem excluída com sucesso!');
            location.reload(); // Atualiza a página
        } else {
            alert('Erro ao excluir imagem.');
        }
    })
    .catch(err => console.error(err));
}

</script>

    <!-- ========================= SLIDES ========================= -->
<div class="tab-pane fade" id="slide">
    <div class="config-card">

        <h5 class="text-white mb-3">Slides do Site (Máximo 3)</h5>

        <form action="{{ route('admin.slides.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">

                <!-- ===================== SLIDE 1 ===================== -->
                <div class="col-md-6">
                    <h6 class="text-info mb-2">Slide 1</h6>

                    {{-- DESKTOP --}}
                    <label class="text-white fw-semibold">Imagem Desktop (1920x600)</label>

                    <div class="upload-area position-relative mt-1"
                         onclick="document.getElementById('desk1').click()">

                        @if (!empty($slides[0]->imagem_desktop))
                            <img id="desk1_saved"
                                 src="{{ asset('storage/'.$slides[0]->imagem_desktop) }}"
                                 style="max-width:100%; margin-top:10px;">
                            <button type="button"
                                    class="btn btn-sm btn-danger position-absolute top-0 end-0"
                                    onclick="event.stopPropagation(); excluirSlideImagem(1,'desktop')">
                                <i class="fas fa-trash"></i>
                            </button>
                        @else
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Clique para enviar imagem</span>
                            <img id="desk1_preview" style="display:none; max-width:100%; margin-top:10px;">
                        @endif
                    </div>

                    <input type="file"
                           id="desk1"
                           name="slides[1][desktop]"
                           class="d-none"
                           onchange="previewImage(this,'desk1_preview','desk1_saved')">

                    {{-- MOBILE --}}
                    <label class="text-white fw-semibold mt-3">Imagem Mobile (1080x900)</label>

                    <div class="upload-area position-relative mt-1"
                         onclick="document.getElementById('mob1').click()">

                        @if (!empty($slides[0]->imagem_mobile))
                            <img id="mob1_saved"
                                 src="{{ asset('storage/'.$slides[0]->imagem_mobile) }}"
                                 style="max-width:100%; margin-top:10px;">
                            <button type="button"
                                    class="btn btn-sm btn-danger position-absolute top-0 end-0"
                                    onclick="event.stopPropagation(); excluirSlideImagem(1,'mobile')">
                                <i class="fas fa-trash"></i>
                            </button>
                        @else
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Clique para enviar imagem</span>
                            <img id="mob1_preview" style="display:none; max-width:100%; margin-top:10px;">
                        @endif
                    </div>

                    <input type="file"
                           id="mob1"
                           name="slides[1][mobile]"
                           class="d-none"
                           onchange="previewImage(this,'mob1_preview','mob1_saved')">
                </div>

                <!-- ===================== SLIDE 2 ===================== -->
                <div class="col-md-6">
                    <h6 class="text-info mb-2">Slide 2</h6>

                    {{-- Desktop --}}
                    <label class="text-white fw-semibold">Imagem Desktop</label>
                    <div class="upload-area mt-1 position-relative"
                         onclick="document.getElementById('desk2').click()">

                        @if (!empty($slides[1]->imagem_desktop))
                            <img id="desk2_saved"
                                 src="{{ asset('storage/'.$slides[1]->imagem_desktop) }}"
                                 style="max-width:100%; margin-top:10px;">
                            <button type="button"
                                    class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                    onclick="event.stopPropagation(); excluirSlideImagem(2,'desktop')">
                                <i class="fas fa-trash"></i>
                            </button>
                        @else
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Clique para enviar imagem</span>
                            <img id="desk2_preview" style="display:none; max-width:100%; margin-top:10px;">
                        @endif
                    </div>

                    <input type="file"
                           id="desk2"
                           name="slides[2][desktop]"
                           class="d-none"
                           onchange="previewImage(this,'desk2_preview','desk2_saved')">

                    {{-- MOBILE --}}
                    <label class="text-white fw-semibold mt-3">Imagem Mobile</label>
                    <div class="upload-area mt-1 position-relative"
                         onclick="document.getElementById('mob2').click()">

                        @if (!empty($slides[1]->imagem_mobile))
                            <img id="mob2_saved"
                                 src="{{ asset('storage/'.$slides[1]->imagem_mobile) }}"
                                 style="max-width:100%; margin-top:10px;">
                            <button type="button"
                                    class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                    onclick="event.stopPropagation(); excluirSlideImagem(2,'mobile')">
                                <i class="fas fa-trash"></i>
                            </button>
                        @else
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Clique para enviar imagem</span>
                            <img id="mob2_preview" style="display:none; max-width:100%; margin-top:10px;">
                        @endif
                    </div>

                    <input type="file"
                           id="mob2"
                           name="slides[2][mobile]"
                           class="d-none"
                           onchange="previewImage(this,'mob2_preview','mob2_saved')">
                </div>

                <!-- ===================== SLIDE 3 ===================== -->
                <div class="col-md-6">
                    <h6 class="text-info mb-2">Slide 3</h6>

                    {{-- Desktop --}}
                    <label class="text-white fw-semibold">Imagem Desktop</label>
                    <div class="upload-area mt-1 position-relative"
                         onclick="document.getElementById('desk3').click()">

                        @if (!empty($slides[2]->imagem_desktop))
                            <img id="desk3_saved"
                                 src="{{ asset('storage/'.$slides[2]->imagem_desktop) }}"
                                 style="max-width:100%; margin-top:10px;">
                            <button type="button"
                                    class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                    onclick="event.stopPropagation(); excluirSlideImagem(3,'desktop')">
                                <i class="fas fa-trash"></i>
                            </button>
                        @else
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Clique para enviar imagem</span>
                            <img id="desk3_preview" style="display:none; max-width:100%; margin-top:10px;">
                        @endif
                    </div>

                    <input type="file"
                           id="desk3"
                           name="slides[3][desktop]"
                           class="d-none"
                           onchange="previewImage(this,'desk3_preview','desk3_saved')">

                    {{-- Mobile --}}
                    <label class="text-white fw-semibold mt-3">Imagem Mobile</label>
                    <div class="upload-area mt-1 position-relative"
                         onclick="document.getElementById('mob3').click()">

                        @if (!empty($slides[2]->imagem_mobile))
                            <img id="mob3_saved"
                                 src="{{ asset('storage/'.$slides[2]->imagem_mobile) }}"
                                 style="max-width:100%; margin-top:10px;">
                            <button type="button"
                                    class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                    onclick="event.stopPropagation(); excluirSlideImagem(3,'mobile')">
                                <i class="fas fa-trash"></i>
                            </button>
                        @else
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Clique para enviar imagem</span>
                            <img id="mob3_preview" style="display:none; max-width:100%; margin-top:10px;">
                        @endif
                    </div>

                    <input type="file"
                           id="mob3"
                           name="slides[3][mobile]"
                           class="d-none"
                           onchange="previewImage(this,'mob3_preview','mob3_saved')">
                </div>

            </div>

            <button class="btn btn-primary mt-4">
                <i class="fas fa-check"></i> Salvar Slides
            </button>
        </form>
    </div>
</div>

<script>
  function previewImage(input, previewId, savedId = null) {
    const file = input.files[0];
    const preview = document.getElementById(previewId);

    if (savedId) {
        const saved = document.getElementById(savedId);
        if (saved) saved.style.display = "none";
    }

    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

function excluirSlideImagem(id, type) {

    if (!confirm("Deseja realmente excluir esta imagem?")) return;

    fetch(`/admin/slides/${id}/delete-image`, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ type: type })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) location.reload();
        else alert("Erro ao excluir imagem!");
    });
}

</script>



    <!-- ========================= CONTATO ========================= -->
   <div class="tab-pane fade" id="contato">
  <div class="config-card">

    <h5 class="text-white mb-3">Informações de Contato</h5>

    <form action="{{ route('admin.config.salvar') }}" method="POST">
      @csrf

      <div class="row g-3">

        <!-- WHATSAPP -->
        <div class="col-md-6">
          <label class="text-white fw-semibold">WhatsApp</label>
          <input type="text" name="contato_whatsapp" class="form-control"
                 value="{{ $configs['contato_whatsapp'] ?? '' }}">
        </div>

        <!-- EMAIL -->
        <div class="col-md-6">
          <label class="text-white fw-semibold">Email</label>
          <input type="email" name="contato_email" class="form-control"
                 value="{{ $configs['contato_email'] ?? '' }}">
        </div>

        <!-- INSTAGRAM -->
        <div class="col-md-6">
          <label class="text-white fw-semibold">Instagram</label>
          <input type="text" name="contato_instagram" class="form-control"
                 value="{{ $configs['contato_instagram'] ?? '' }}">
        </div>

        <!-- TELEGRAM -->
        <div class="col-md-6">
          <label class="text-white fw-semibold">Telegram</label>
          <input type="text" name="contato_telegram" class="form-control"
                 value="{{ $configs['contato_telegram'] ?? '' }}">
        </div>

      </div>

      <button class="btn btn-primary mt-3 px-4 py-2" style="border-radius:10px;">
        <i class="fas fa-check"></i> Salvar
      </button>

    </form>

  </div>
</div>


    <!-- ========================= PAGAMENTOS ========================= -->
    <div class="tab-pane fade" id="pagamento">
  <div class="config-card">

    <h5 class="text-white mb-3">Pagamentos</h5>

    <form action="{{ route('admin.config.salvar') }}" method="POST">
      @csrf

      <div class="row g-3">

        <!-- PIX -->
        <div class="col-md-6">
          <label class="text-white fw-semibold">Chave PIX</label>
          <input type="text" name="pagamento_pix" class="form-control"
                 value="{{ $configs['pagamento_pix'] ?? '' }}">
        </div>

        <!-- NOME DO TITULAR -->
        <div class="col-md-6">
          <label class="text-white fw-semibold">Nome do Dono da Conta</label>
          <input type="text" name="pagamento_nome_conta" class="form-control"
                 value="{{ $configs['pagamento_nome_conta'] ?? '' }}">
        </div>

        <!-- BANCO -->
        <div class="col-md-6">
          <label class="text-white fw-semibold">Banco</label>
          <input type="text" name="pagamento_banco" class="form-control"
                 value="{{ $configs['pagamento_banco'] ?? '' }}">
        </div>

        <!-- TIPO DE CONTA -->
        <div class="col-md-6">
          <label class="text-white fw-semibold">Tipo de Conta</label>
          <select name="pagamento_tipo_conta" class="form-select">

            <option value="Poupança"
              {{ (isset($configs['pagamento_tipo_conta']) && $configs['pagamento_tipo_conta'] == 'Poupança') ? 'selected' : '' }}>
              Poupança
            </option>

            <option value="Corrente"
              {{ (isset($configs['pagamento_tipo_conta']) && $configs['pagamento_tipo_conta'] == 'Corrente') ? 'selected' : '' }}>
              Corrente
            </option>

          </select>
        </div>

      </div>

      <button class="btn btn-primary mt-3 px-4 py-2" style="border-radius:10px;">
        <i class="fas fa-check"></i> Salvar
      </button>

    </form>

  </div>
</div>


    <!-- ========================= SEGURANÇA ========================= -->
   <div class="tab-pane fade" id="seguranca">
  <div class="config-card">

    <h5 class="text-white mb-3">Segurança</h5>

    <form action="{{ route('admin.config.salvar') }}" method="POST">
      @csrf

      <div class="row g-3">

        <!-- RECAPTCHA SITE KEY -->
        <div class="col-md-6">
          <label class="text-white fw-semibold">reCAPTCHA Site Key</label>
          <input type="text" name="recaptcha_site_key" class="form-control"
                 value="{{ $configs['recaptcha_site_key'] ?? '' }}">
        </div>


        <!-- LIMITE DE TENTATIVAS -->
        <div class="col-md-6">
          <label class="text-white fw-semibold">Limite de Tentativas Login</label>
          <input type="number" name="limite_login_tentativas" class="form-control"
                 value="{{ $configs['limite_login_tentativas'] ?? 5 }}">
        </div>

        <!-- TEMPO DE BLOQUEIO -->
        <div class="col-md-6">
          <label class="text-white fw-semibold">Tempo de Bloqueio (minutos)</label>
          <input type="number" name="limite_login_tempo_bloqueio" class="form-control"
                 value="{{ $configs['limite_login_tempo_bloqueio'] ?? 10 }}">
        </div>

      </div>

      <button class="btn btn-primary mt-3 px-4 py-2" style="border-radius:10px;">
        <i class="fas fa-check"></i> Salvar
      </button>

    </form>

  </div>
</div>


</div>


<script>
// Salvar aba ativa ao clicar
document.querySelectorAll('.nav-tabs button[data-bs-toggle="tab"]').forEach(tab => {
    tab.addEventListener('shown.bs.tab', function (e) {
        localStorage.setItem('aba_config_ativa', e.target.getAttribute('data-bs-target'));
    });
});

// Restaurar aba ao carregar a página
document.addEventListener('DOMContentLoaded', function () {
    let aba = localStorage.getItem('aba_config_ativa');

    if (aba) {
        let tabButton = document.querySelector(`button[data-bs-target="${aba}"]`);
        let tabContent = document.querySelector(aba);

        if (tabButton && tabContent) {
            let tab = new bootstrap.Tab(tabButton);
            tab.show();
        }
    }
});
</script>


@endsection