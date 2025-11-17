<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Em Manutenção — BolaPlay FC</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/afcee4f894.js" crossorigin="anonymous" defer></script>

  <style>
    :root{
      --bg:#0b0f19;
      --card:#131a27;
      --accent:#ffcc00;
      --muted:#a4b1c4;
    }

    body{
      background:var(--bg);
      color:#fff;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto;
      min-height:100vh;
      display:flex;align-items:center;justify-content:center;
      padding:2rem;
    }

    .box{
      background:var(--card);
      padding:40px;
      border-radius:14px;
      width:100%;
      max-width:520px;
      text-align:center;
      box-shadow:0 0 40px rgba(0,0,0,0.4);
    }

    .icon{
      width:80px;height:80px;
      background:var(--accent);
      border-radius:50%;
      display:flex;align-items:center;justify-content:center;
      margin:auto;
      margin-bottom:20px;
      color:#0b0f19;
      font-size:32px;
      box-shadow:0 8px 20px rgba(255,204,0,0.2);
    }

    .count{display:flex;gap:10px;justify-content:center;margin-top:25px}
    .count div{background:#0f1520;padding:14px 20px;border-radius:10px;min-width:70px}
    .count .num{font-size:1.4rem;font-weight:700;color:#fff}
    .count .label{font-size:.75rem;color:var(--muted)}

    a.btn-main{
      background:var(--accent);
      color:#000;
      font-weight:600;
      border:0;
    }

    footer{color:var(--muted);font-size:.8rem;margin-top:25px}

  </style>
</head>
<body>

<div class="box">

  <div class="icon"><i class="fa-solid fa-futbol"></i></div>

  <h2 class="fw-bold">Voltamos em breve</h2>
  <p class="mt-2" style="color:var(--muted)">Estamos realizando melhorias para trazer uma experiência ainda melhor aos torcedores.</p>

  <!-- Contagem regressiva -->
  <div class="count" id="countdown">
    <div><div class="num" id="d">00</div><div class="label">Dias</div></div>
    <div><div class="num" id="h">00</div><div class="label">Horas</div></div>
    <div><div class="num" id="m">00</div><div class="label">Minutos</div></div>
    <div><div class="num" id="s">00</div><div class="label">Seg.</div></div>
  </div>

  <a href="#" class="btn btn-main btn-lg w-100 mt-4"><i class="fa-solid fa-bell me-2"></i>Ser avisado</a>

  <footer>© BolaPlay FC — Todos os direitos reservados.</footer>
</div>

<script>
  const target = new Date('2025-11-18T16:00:00Z');

  function update(){
    const now = new Date();
    let diff = Math.max(0, Math.floor((target - now) / 1000));
    const d = Math.floor(diff / 86400); diff %= 86400;
    const h = Math.floor(diff / 3600); diff %= 3600;
    const m = Math.floor(diff / 60); const s = diff % 60;
    document.getElementById('d').textContent = String(d).padStart(2,'0');
    document.getElementById('h').textContent = String(h).padStart(2,'0');
    document.getElementById('m').textContent = String(m).padStart(2,'0');
    document.getElementById('s').textContent = String(s).padStart(2,'0');
  }
  update(); setInterval(update,1000);
</script>

</body>
</html>
