@extends('Layout/User/App')

@section('title', 'Indicação')

@section('content')

<style>
    .meta-card {
        background: #1e293b;
        border-radius: 18px;
        padding: 22px;
        transition: .3s;
        border: 1px solid rgba(255,255,255,0.05);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .meta-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 0 18px rgba(0,0,0,0.4);
    }

    .meta-icon {
        font-size: 42px;
        color: #38bdf8;
    }

    .progress-custom {
        height: 12px;
        border-radius: 20px;
    }

    .badge-nivel {
        background: #38bdf8;
        color: #0f172a;
        border-radius: 8px;
        padding: 4px 10px;
        font-weight: bold;
        font-size: 12px;
    }

    .ind-card-wrapper {
        display: grid;
        gap: 20px;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    }
.top-card {
    background: linear-gradient(135deg, #1e3a8a, #3b82f6);
    border-radius: 18px;
    padding: 25px;
    color: #f1f5f9;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
}


    .premio {
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: bold;
        color: #facc15;
        margin-top: 8px;
    }

    .resgatar-btn {
        margin-top: 12px;
    }

    .regras-card {
        background: #0f172a;
        border-radius: 18px;
        padding: 20px 25px;
        margin-bottom: 25px;
        border: 1px solid rgba(255,255,255,0.1);
    }

    .regras-card h5 {
        color: #38bdf8;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .regras-card ul {
        list-style: none;
        padding-left: 0;
    }

    .regras-card ul li {
        position: relative;
        padding-left: 25px;
        margin-bottom: 10px;
        color: #ffffff;
        font-size: 14px;
    }

    .regras-card ul li::before {
        content: "\f00c"; /* ícone check */
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        left: 0;
        color: #38bdf8;
    }
    .historico-card {
        background: #0f172a;
        border-radius: 18px;
        padding: 20px 25px;
        margin-top: 30px;
        border: 1px solid rgba(255,255,255,0.1);
        box-shadow: 0 6px 18px rgba(0,0,0,0.2);
    }

    .historico-card h5 {
        color: #38bdf8;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .historico-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    .historico-table th, .historico-table td {
        padding: 12px 15px;
        color: #fff;
    }

    .historico-table th {
        text-align: left;
        color: #38bdf8;
        font-weight: bold;
        border-bottom: 2px solid rgba(255,255,255,0.1);
    }

    .historico-table tr {
        background: #1e293b;
        border-radius: 12px;
        transition: .3s;
    }

    .historico-table tr:hover {
        background: #2c3e50;
    }

    .status-badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: bold;
    }

    .status-pendente {
        background: #facc15;
        color: #0f172a;
    }

    .status-aprovado {
        background: #38bdf8;
        color: #0f172a;
    }
</style>

<div class="container py-4">

    <!-- TÍTULO PRINCIPAL -->
    <h3 class="fw-bold text-white mb-3">
        <i class="fa-solid fa-users-line me-2"></i>
        Programa de Indicação
    </h3>

    <!-- CARD DO LINK DE INDICAÇÃO -->
    <div class="top-card mb-4 shadow">
        <h5 class="fw-bold">
            Seu link exclusivo
            <i class="fa-solid fa-link ms-2"></i>
        </h5>

        <div class="input-group mt-3">
     @php
    $namePart = Str::upper(Str::substr(auth()->user()->name, 0, 2)); 
    $ref = auth()->user()->prefixo . $namePart . 'X' . auth()->user()->id . 'QZ';
@endphp

<input 
    type="text" 
    class="form-control"
    value="{{ url('/') }}?reference={{ $ref }}"
    readonly
>



            <button class="btn btn-dark">
                <i class="fa-solid fa-copy"></i>
            </button>
        </div>

        <p class="mt-2 mb-0 fw-semibold">
            Compartilhe com amigos e ganhe recompensas ao bater metas!
        </p>
    </div>

     <!-- TÍTULO DAS METAS -->
    <h5 class="text-white fw-bold mb-3">
        <i class="fa-solid fa-trophy me-2 text-warning"></i>
        Suas Metas
    </h5>

    <!-- CARDS DAS METAS -->
    <div class="ind-card-wrapper">

       @foreach ($metas as $meta)
    <div class="meta-card shadow-sm">

        <div class="d-flex justify-content-between align-items-center">
            <span class="badge-nivel">Nível {{ $meta->nivel }}</span>

            @if ($meta->nivel == 1)
                <i class="fa-solid fa-medal meta-icon"></i>
            @elseif ($meta->nivel == 2)
                <i class="fa-solid fa-trophy meta-icon text-warning"></i>
            @else
                <i class="fa-solid fa-crown meta-icon text-warning"></i>
            @endif
        </div>

        <h5 class="text-white mt-3 mb-1">{{ $meta->titulo }}</h5>

        <p class="text-muted small mb-1">
            {{ $meta->descricao }}
        </p>

        <div class="premio">
            <i class="fa-solid fa-gift"></i>
            R$ {{ number_format($meta->bonus_valor, 2, ',', '.') }}
        </div>

        <!-- Barra de progresso -->
        <div class="progress progress-custom bg-dark mb-2">
            <div class="progress-bar 
                {{ $meta->atingido ? 'bg-success' : 'bg-info' }}"
                style="width: {{ $meta->progresso }}%">
            </div>
        </div>

        <span class="small {{ $meta->atingido ? 'text-success' : 'text-info' }}">
            {{ $indicados }}/{{ $meta->quantidade_indicados }} amigos indicados
        </span>

        <!-- Botão de resgate -->
        <button 
            class="btn btn-warning resgatar-btn mt-2"
            {{ $meta->atingido ? '' : 'disabled' }}>
            Resgatar
        </button>

    </div>
@endforeach


    </div>
<br>
    <!-- SEÇÃO DE REGRAS -->
<style>
/* CONTAINER QUE MOSTRA SÓ UMA PARTE */
.read-more-container {
    max-height: 100px;
    overflow: hidden;
    position: relative;
    transition: max-height 0.4s ease;
}

/* EFEITO DE GRADIENTE MOSTRANDO QUE TEM MAIS CONTEÚDO */
.read-more-container::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 40px;
    background: linear-gradient(to bottom, transparent, #0f172a);
}

/* QUANDO EXPANDE, SOME O GRADIENTE */
.read-more-container.expanded::after {
    display: none;
}

/* BOTÃO DE VER MAIS / VER MENOS */
.read-more-btn {
    color: #38bdf8;
    cursor: pointer;
    margin-top: 10px;
    font-weight: 600;
    display: inline-block;
}
</style>

<!-- SEÇÃO DE REGRAS -->
<div class="regras-card shadow-sm">
    <h5><i class="fa-solid fa-book me-2"></i>Regras do Programa</h5>

    <div class="read-more-container" id="regrasBox">
        <ul>
            <li>Você precisa convidar amigos utilizando seu link exclusivo.</li>
            <li>Apenas amigos que realizarem depósitos contam para a meta.</li>
            <li>As recompensas só podem ser resgatadas quando a meta for atingida.</li>
            <li>Cada meta possui uma recompensa específica, progressiva de acordo com os níveis.</li>
            <li>O resgate de metas não afeta suas conquistas anteriores.</li>
        </ul>
    </div>

    <span class="read-more-btn" id="btnToggle">Ver mais</span>
</div>

<script>
const box = document.getElementById("regrasBox");
const btn = document.getElementById("btnToggle");

btn.addEventListener("click", () => {
    box.classList.toggle("expanded");

    if (box.classList.contains("expanded")) {
        box.style.maxHeight = box.scrollHeight + "px";
        btn.textContent = "Ver menos";
    } else {
        box.style.maxHeight = "100px";
        btn.textContent = "Ver mais";
    }
});
</script>

   



 <!-- HISTÓRICO DE INDICAÇÕES -->
    <div class="historico-card shadow-sm">
        <h5><i class="fa-solid fa-history me-2"></i>Histórico de Indicações</h5>

        <table class="historico-table">
            <thead>
                <tr>
                    <th>Nome do Indicado</th>
                    <th>Status</th>
                    <th>Data de Cadastro</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>João Silva</td>
                    <td><span class="status-badge status-pendente">Pendente</span></td>
                    <td>25/11/2025</td>
                </tr>
                <tr>
                    <td>Maria Souza</td>
                    <td><span class="status-badge status-aprovado">Aprovado</span></td>
                    <td>24/11/2025</td>
                </tr>
                <tr>
                    <td>Carlos Lima</td>
                    <td><span class="status-badge status-pendente">Pendente</span></td>
                    <td>23/11/2025</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

@endsection
