
 <style>


    .card {
      border: none;
      border-radius: 16px;
      overflow: hidden;
      margin-bottom: 1.2rem;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
      transition: transform 0.2s ease-in-out, box-shadow 0.2s;
    }

    .card:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
    }

    .card-header {
      font-weight: 600;
      font-size: 1.2rem;
    }

    .card-current {
      background: linear-gradient(135deg, #ffe000, #ffb800);
      color: #202242;
    }

    .card-past {
        color: white;
      background: #1e293b;
    }

    .card-body {
      padding: 1.2rem 1.4rem;
    }

    .prize {
      font-size: 1.4rem;
      font-weight: 700;
    }

    .date {
      opacity: 0.8;
      font-size: 0.9rem;
    }

    .btn-custom {
      border-radius: 10px;
      font-weight: 600;
      padding: 0.5rem 1.5rem;
    }
  </style>

<div class="modal fade" id="ModalVermais" tabindex="-1" aria-labelledby="ModalVermais" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 10px;">

      <!-- Cabeçalho -->
      <div class="modal-header" style="background-color:#1e293b; color:white;">
        <div>
          <h5 class="modal-title" id="meuModalLabel">
            <i class="fa-solid fa-list"></i> Últimos 5 bolões
          </h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <!-- Conteúdo -->
      <div class="container py-4" style="max-height: 70vh; overflow-y: auto;">

        <!-- Bolão Atual -->
        <div class="card card-current text-dark mb-3">
          <div class="card-header text-center">
            <i class="fa-solid fa-clock"></i>
            Bolão do Dia - {{ \Carbon\Carbon::parse($rodada->data_inicio)->format('d/m/Y') }}
          </div>

          <div class="card-body text-center">
            <div class="prize mb-2">
              R$ {{ number_format($rodada->premiacao_estimada, 2, ',', '.') }} Estimado
            </div>

            <div class="date mb-3">
              Encerramento às {{ \Carbon\Carbon::parse($rodada->data_fim)->format('H:i') }}
            </div>

            <a href="{{ url('/ranking/' . $rodada->id) }}" class="btn btn-dark btn-custom">
              Apostar Agora
            </a>
          </div>
        </div>

        <!-- Bolões Passados -->
        @foreach($ultimasRodadas as $r)
        <div class="card card-past mb-3">
          <div class="card-header text-center">
            <i class="fa-solid fa-trophy"></i>
            Bolão - {{ \Carbon\Carbon::parse($r->data_inicio)->format('d/m/Y') }}
          </div>

          <div class="card-body text-center">

            <div class="prize mb-2" style="color:#00ffa9;">
              R$ {{ number_format($r->premiacao_estimada, 2, ',', '.') }}
            </div>

            <div class="date mb-3">ENCERRADO</div>

            <a href="{{ url('/ranking/' . $r->id) }}" class="btn btn-outline-light btn-custom">
              Ver Resultados
            </a>
          </div>
        </div>
        @endforeach

      </div>

    </div>
  </div>
</div>
