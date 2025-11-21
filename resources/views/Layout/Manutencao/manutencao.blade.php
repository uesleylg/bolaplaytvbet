<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Em Manutenção — {{ $configs['nome_site'] ?? 'Nome do site' }}</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/afcee4f894.js" crossorigin="anonymous" defer></script>


</head>
<body>
<div class="manutencao-wrapper">

    <div class="ball-animation">
        <i class="fa-solid fa-futbol"></i>
    </div>

    <h2 class="title-manutencao">Estamos em Manutenção</h2>

    <p class="desc-manutencao">
        {{ $configs['mensagem_manutencao'] ?? 'Voltaremos em instantes. Estamos ajustando o sistema para melhorar sua experiência.' }}
    </p>

    <footer class="footer-manutencao">
        © {{ $configs['nome_site'] ?? 'Nome do site' }} — Todos os direitos reservados.
    </footer>
</div>

<style>
    .manutencao-wrapper {
        text-align: center;
        padding: 60px 20px;
        color: #fff;
        animation: fadeIn 0.9s ease-in-out;
        max-width: 650px;
        margin: auto;
    }

    /* ⚽ Bola girando */
    .ball-animation i {
        font-size: 80px;
        color: #0ea5e9;
        animation: spinBall 2.2s infinite linear;
    }

    @keyframes spinBall {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* ✨ Título */
    .title-manutencao {
        font-size: 2.2rem;
        font-weight: bold;
        margin-top: 20px;
        animation: pulse 2s infinite ease-in-out;
    }

    @keyframes pulse {
        0% { opacity: 0.8; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.05); }
        100% { opacity: 0.8; transform: scale(1); }
    }

    /* 💬 Descrição */
    .desc-manutencao {
        margin-top: 15px;
        font-size: 1.1rem;
        color: #aab4c4;
        max-width: 520px;
        margin-left: auto;
        margin-right: auto;
        animation: fadeUp 1s ease-in-out;
        line-height: 1.6rem;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0px); }
    }

    /* 🌙 Rodapé */
    .footer-manutencao {
        margin-top: 50px;
        font-size: 0.9rem;
        color: #6b7280;
        letter-spacing: 0.5px;
    }

    /* 🔄 Fundo animado */
 body {
    background: radial-gradient(circle at center, #162032, #0d121a);
    background-size: 150% 150%;
    animation: bgMove 8s infinite alternate ease-in-out;
    overflow-x: hidden;

    /* CENTRALIZAÇÃO PERFEITA */
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}


    @keyframes bgMove {
        0% { background-position: 50% 0%; }
        100% { background-position: 50% 100%; }
    }

    /* 📱 MOBILE RESPONSIVO */
    @media (max-width: 600px) {

        .ball-animation i {
            font-size: 60px;
        }

        .title-manutencao {
            font-size: 1.7rem;
            margin-top: 15px;
        }

        .desc-manutencao {
            font-size: 1rem;
            padding: 0 10px;
        }

        .footer-manutencao {
            margin-top: 35px;
            font-size: 0.8rem;
        }
    }

    /* Extra pequeno (iPhone SE / Moto E / telas ≤ 380px) */
    @media (max-width: 380px) {
        .ball-animation i {
            font-size: 50px;
        }

        .title-manutencao {
            font-size: 1.5rem;
        }

        .desc-manutencao {
            font-size: 0.95rem;
        }
    }
</style>


</body>
</html>
