@extends('Layout/User/App')

@section('title', 'Regras do Bolão')

@section('content')
@include('Slide.SlidePadrao')

<style>
    /* Fundo já é #0f172a no layout */
    .rules-page {
        color: #e5e7eb;
    }

    .rules-page .text-muted {
        color: #9ca3af !important;
    }

    .rule-card {
        background-color: #111827;
        border: 1px solid #1f2937;
        border-left: 4px solid #3b82f6;
        color: #e5e7eb;
    }

    .rule-card h4 {
        color: #f9fafb;
    }

    .rule-card ul li,
    .rule-card ol li {
        margin-bottom: .4rem;
    }

    .rule-warning {
        background-color: #1f2933;
        border: 1px solid #92400e;
        border-left: 4px solid #f59e0b;
    }
</style>

<div class="container py-2 rules-page">

    <!-- Título -->
    <div class="text-center mb-5">
        <h1 class="fw-bold text-white">
            <i class="fa-solid fa-futbol text-primary"></i>
            Regras do Bolão Play
        </h1>
        <p class="text-muted">
            Regulamento oficial e transparência do nosso bolão
        </p>
    </div>

    <!-- Introdução -->
    <div class="card mb-4 rule-card">
        <div class="card-body">
            <h4 class="fw-bold mb-3">
                <i class="fa-solid fa-clipboard-list text-primary"></i> Introdução
            </h4>
            <p>
                Cada cartela contém <strong>8 jogos</strong>, e cada jogo possui
                <strong>3 opções de marcação</strong>:
            </p>
            <ul>
                <li><strong>1</strong> – Casa (time mandante)</li>
                <li><strong>X</strong> – Empate</li>
                <li><strong>2</strong> – Fora (time visitante)</li>
            </ul>
            <p>
                Cada acerto vale <strong>1 ponto</strong>, sendo o máximo possível
                <strong>8 pontos</strong>. Ganha quem somar mais pontos.
            </p>
        </div>
    </div>

    <!-- Transparência -->
    <div class="card mb-4 rule-card">
        <div class="card-body">
            <h4 class="fw-bold mb-3">
                <i class="fa-solid fa-shield-halved text-primary"></i> Compromisso com a Transparência
            </h4>
            <p>
                O <strong>PDF da auditoria (mapa das cartelas)</strong> é o nosso compromisso
                com a transparência e o jogo limpo.
            </p>
            <p>
                Salve o PDF em seu celular ou computador. Ao final da rodada,
                você poderá verificar que os vencedores já constavam no documento
                antes do início dos jogos.
            </p>
        </div>
    </div>

    <!-- Auditoria -->
    <div class="card mb-4 rule-card">
        <div class="card-body">
            <h4 class="fw-bold mb-3">
                <i class="fa-solid fa-file-pdf text-primary"></i> Auditoria (Mapa das Cartelas)
            </h4>
            <p>
                A auditoria com todas as cartelas da rodada vigente é publicada
                em <strong>PDF e JPG</strong> no site e nos grupos oficiais.
            </p>
            <p>
                Cada página contém <strong>24 cartelas</strong> em palpites secos.
            </p>
        </div>
    </div>

    <!-- Classificação -->
    <div class="card mb-4 rule-card">
        <div class="card-body">
            <h4 class="fw-bold mb-3">
                <i class="fa-solid fa-ranking-star text-primary"></i> Classificação (Ranking)
            </h4>
            <p>
                A classificação é válida <strong>exclusivamente</strong>
                para cartelas adquiridas pelo site.
            </p>
            <p>
                Cartelas adquiridas manualmente não participam do ranking geral.
            </p>
        </div>
    </div>

    <!-- Ganhadores -->
    <div class="card mb-4 rule-card">
        <div class="card-body">
            <h4 class="fw-bold mb-3">
                <i class="fa-solid fa-trophy text-primary"></i> Ganhadores
            </h4>
            <p>
                A apuração dos vencedores ocorre manualmente após
                o término de todos os jogos da rodada.
            </p>
            <p>
                As cartelas vencedoras são divulgadas no site
                e nos grupos oficiais.
            </p>
        </div>
    </div>

    <!-- Observação -->
    <div class="card mb-4 rule-warning">
        <div class="card-body">
            <h4 class="fw-bold mb-3 text-warning">
                <i class="fa-solid fa-circle-exclamation"></i> Observação Importante
            </h4>
            <p>
                Cartelas com jogos <strong>sem marcação</strong> ou com
                <strong>marcações duplas ou triplas</strong> não serão canceladas.
            </p>
            <p>
                Apenas o jogo irregular será anulado, mantendo válidos
                os demais palpites secos.
            </p>
        </div>
    </div>

    <!-- Regulamento -->
    <div class="card mb-4 rule-card">
        <div class="card-body">
            <h4 class="fw-bold mb-3">
                <i class="fa-solid fa-scale-balanced text-primary"></i> Regulamento Geral
            </h4>
            <ol>
                <li>Valor da cartela: <strong>R$ 10,00</strong>.</li>
                <li>São aceitos palpites secos, duplos e triplos.</li>
                <li>Ganha quem fizer mais pontos.</li>
                <li>Em caso de empate, o prêmio será dividido.</li>
                <li>Resultados válidos aos 90 minutos + acréscimos.</li>
                <li>Pagamentos em até <strong>24 horas</strong> após a rodada.</li>
            </ol>
        </div>
    </div>


</div>
@endsection
