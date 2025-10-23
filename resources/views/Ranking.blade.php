@extends('Layout/App')


@section('title', 'BolaPlay Bet')

@section('content')

 @include('Slide.SlidePadrao')




<div class="container py-5">
<div style="color: white; background-color: #0f172a; font-size: 18px; padding: 15px; border-radius: 10px; margin-bottom: 0px; font-family: 'Roboto', sans-serif; font-weight: bolder; box-shadow: 0 0 10px 2px #00000052; display: flex; justify-content: space-between; align-items: center;">
  <div>
   <i style="color: #fffb00ff;" class="fa-solid fa-trophy"></i> BOLÃO HOJE - 23/10/2025 <br> <label style="color:#00ffa9; font-weight: 200;">Premiação: R$ 2.000,00</label>
  </div>

  <div style="display: flex; align-items: center; gap: 10px;">
    <button style="border:1px solid #cececeff; border-radius:10px; background-color:#334155; color:white; padding: 5px 15px; font-weight: bold;">
      <i class="fa-solid fa-arrows-rotate"></i> Atualizar
    </button>
    <i class="fa-solid fa-circle-question" style="font-size: 20px; cursor: pointer;"></i>
  </div>
</div>

<div style="color:#ffe200; font-weight: bold; background: #34495e; padding:10px; text-align: center;">


<div class="container my-4 position-relative">



  <!-- inicio do sli -->
  <button id="scrollLeft" class="btn btn-dark position-absolute top-50 start-0 translate-middle-y shadow" style="z-index: 10; border-radius: 50%; width: 45px; height: 45px;">
    <i class="fa-solid fa-chevron-left"></i>
  </button>
  <button id="scrollRight" class="btn btn-dark position-absolute top-50 end-0 translate-middle-y shadow" style="z-index: 10; border-radius: 50%; width: 45px; height: 45px;">
    <i class="fa-solid fa-chevron-right"></i>
  </button>

  <!-- Carrossel -->
  <div id="cardsContainer" class="d-flex overflow-auto pb-3" style="scroll-behavior: smooth; gap: 1rem;">

    <!-- CARD -->
    <div class="card flex-shrink-0 shadow-sm" style="width: 320px; border: 2px solid #198754; border-radius: 12px;">
      <div class="card-body p-3" style="background-color: #f8fafc; border-radius: 12px;">

        <!-- Cabeçalho -->
        <div class="d-flex justify-content-between align-items-center mb-3">
          <span class="badge bg-success px-3 py-2">ENCERRADO</span>
          <small class="fw-bold text-muted text-end">EUROPA: Campeões</small>
        </div>

        <!-- Times e placar -->
        <div class="d-flex align-items-center justify-content-between">
          <div class="text-center" style="width: 80px;">
            <img src="https://upload.wikimedia.org/wikipedia/en/5/53/Arsenal_FC.svg" width="40" height="40">
            <div class="fw-semibold small mt-1 text-truncate">ARSENAL</div>
          </div>

          <div class="flex-fill text-center">
            <span class="fw-bold fs-4 text-success">4</span>
            <span class="fw-bold fs-5 text-dark mx-1">X</span>
            <span class="fw-bold fs-4 text-danger">0</span>
          </div>

          <div class="text-center" style="width: 80px;">
            <img src="https://upload.wikimedia.org/wikipedia/en/f/f4/Atletico_Madrid_2017_logo.svg" width="40" height="40">
            <div class="fw-semibold small mt-1 text-truncate">ATL. MADRID</div>
          </div>
        </div>

        <!-- Estatísticas -->
        <div class="text-muted small text-center mt-3">
          C: 6934 (74.5%) • E: 1356 (14.6%) • V: 1012 (10.9%)
        </div>
      </div>
    </div>

    <!-- CARD 2 -->
    <div class="card flex-shrink-0 shadow-sm" style="width: 320px; border: 2px solid #198754; border-radius: 12px;">
      <div class="card-body p-3" style="background-color: #f8fafc; border-radius: 12px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <span class="badge bg-success px-3 py-2">ENCERRADO</span>
          <small class="fw-bold text-muted text-end">EUROPA: Campeões</small>
        </div>

        <div class="d-flex align-items-center justify-content-between">
          <div class="text-center" style="width: 80px;">
            <img src="https://upload.wikimedia.org/wikipedia/en/5/59/Bayer_04_Leverkusen_logo.svg" width="40" height="40">
            <div class="fw-semibold small mt-1 text-truncate">LEVERKUSEN</div>
          </div>

          <div class="flex-fill text-center">
            <span class="fw-bold fs-4 text-success">4</span>
            <span class="fw-bold fs-5 text-dark mx-1">X</span>
            <span class="fw-bold fs-4 text-danger">0</span>
          </div>

          <div class="text-center" style="width: 80px;">
            <img src="https://upload.wikimedia.org/wikipedia/en/a/a7/Paris_Saint-Germain_F.C..svg" width="40" height="40">
            <div class="fw-semibold small mt-1 text-truncate">PSG</div>
          </div>
        </div>

        <div class="text-muted small text-center mt-3">
          C: 1193 (12.8%) • E: 1188 (12.8%) • V: 6921 (74.4%)
        </div>
      </div>
    </div>

      <!-- CARD 2 -->
    <div class="card flex-shrink-0 shadow-sm" style="width: 320px; border: 2px solid #198754; border-radius: 12px;">
      <div class="card-body p-3" style="background-color: #f8fafc; border-radius: 12px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <span class="badge bg-success px-3 py-2">ENCERRADO</span>
          <small class="fw-bold text-muted text-end">EUROPA: Campeões</small>
        </div>

        <div class="d-flex align-items-center justify-content-between">
          <div class="text-center" style="width: 80px;">
            <img src="https://upload.wikimedia.org/wikipedia/en/5/59/Bayer_04_Leverkusen_logo.svg" width="40" height="40">
            <div class="fw-semibold small mt-1 text-truncate">LEVERKUSEN</div>
          </div>

          <div class="flex-fill text-center">
            <span class="fw-bold fs-4 text-success">4</span>
            <span class="fw-bold fs-5 text-dark mx-1">X</span>
            <span class="fw-bold fs-4 text-danger">0</span>
          </div>

          <div class="text-center" style="width: 80px;">
            <img src="https://upload.wikimedia.org/wikipedia/en/a/a7/Paris_Saint-Germain_F.C..svg" width="40" height="40">
            <div class="fw-semibold small mt-1 text-truncate">PSG</div>
          </div>
        </div>

        <div class="text-muted small text-center mt-3">
          C: 1193 (12.8%) • E: 1188 (12.8%) • V: 6921 (74.4%)
        </div>
      </div>
    </div>
      <!-- CARD 2 -->
    <div class="card flex-shrink-0 shadow-sm" style="width: 320px; border: 2px solid #198754; border-radius: 12px;">
      <div class="card-body p-3" style="background-color: #f8fafc; border-radius: 12px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <span class="badge bg-success px-3 py-2">ENCERRADO</span>
          <small class="fw-bold text-muted text-end">EUROPA: Campeões</small>
        </div>

        <div class="d-flex align-items-center justify-content-between">
          <div class="text-center" style="width: 80px;">
            <img src="https://upload.wikimedia.org/wikipedia/en/5/59/Bayer_04_Leverkusen_logo.svg" width="40" height="40">
            <div class="fw-semibold small mt-1 text-truncate">LEVERKUSEN</div>
          </div>

          <div class="flex-fill text-center">
            <span class="fw-bold fs-4 text-success">4</span>
            <span class="fw-bold fs-5 text-dark mx-1">X</span>
            <span class="fw-bold fs-4 text-danger">0</span>
          </div>

          <div class="text-center" style="width: 80px;">
            <img src="https://upload.wikimedia.org/wikipedia/en/a/a7/Paris_Saint-Germain_F.C..svg" width="40" height="40">
            <div class="fw-semibold small mt-1 text-truncate">PSG</div>
          </div>
        </div>

        <div class="text-muted small text-center mt-3">
          C: 1193 (12.8%) • E: 1188 (12.8%) • V: 6921 (74.4%)
        </div>
      </div>
    </div>

    <!-- CARD 3 -->
    <div class="card flex-shrink-0 shadow-sm" style="width: 320px; border: 2px solid #ffc107; border-radius: 12px;">
      <div class="card-body p-3" style="background-color: #fffef6; border-radius: 12px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <span class="badge bg-warning text-dark px-3 py-2">AO VIVO</span>
          <small class="fw-bold text-muted text-end">LIBERTADORES</small>
        </div>

        <div class="d-flex align-items-center justify-content-between">
          <div class="text-center" style="width: 80px;">
            <img src="https://upload.wikimedia.org/wikipedia/en/1/10/Palmeiras_logo.svg" width="40" height="40">
            <div class="fw-semibold small mt-1 text-truncate">PALMEIRAS</div>
          </div>

          <div class="flex-fill text-center">
            <span class="fw-bold fs-4 text-success">2</span>
            <span class="fw-bold fs-5 text-dark mx-1">X</span>
            <span class="fw-bold fs-4 text-danger">1</span>
          </div>

          <div class="text-center" style="width: 80px;">
            <img src="https://upload.wikimedia.org/wikipedia/en/f/f2/LDU_Logo.svg" width="40" height="40">
            <div class="fw-semibold small mt-1 text-truncate">LDU</div>
          </div>
        </div>

        <div class="text-muted small text-center mt-3">
          C: 4235 (68%) • E: 903 (14.5%) • V: 1098 (17.5%)
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Script de rolagem -->
<script>
  const container = document.getElementById("cardsContainer");
  document.getElementById("scrollLeft").onclick = () => container.scrollBy({ left: -320, behavior: 'smooth' });
  document.getElementById("scrollRight").onclick = () => container.scrollBy({ left: 320, behavior: 'smooth' });
</script>
  <!-- FIM SLID -->


<div style="position: relative; width: 100%; ">
  <i class="fa-solid fa-magnifying-glass" style="position: absolute; top: 50%; left: 12px; transform: translateY(-50%); color: #fff;"></i>
  <input type="text" class="form-control w-100" placeholder="Buscar bilhete ou nome..." style="
    font-size: 20px;
    padding-left: 40px;
    border-radius: 12px;
    border: 2px solid #334155;
    background-color: #0f172a;
    color: #fff;
    height: 55px;
    font-weight: 500;
    transition: all 0.3s ease;
  " 
  onfocus="this.style.borderColor='#ffe200'; this.style.boxShadow='0 0 10px #ffe200';" 
  onblur="this.style.borderColor='#334155'; this.style.boxShadow='none';">
</div>



  
    <div class="table-responsive" style="margin-top: 20px;">
  <table class="table table-dark table-striped table-hover text-center align-middle" style="border-radius: 10px; overflow: hidden;">
    <thead style="background-color: #0f172a; color: #ffe200;">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Bilhete</th>
        <th scope="col">Comprador</th>
        <th scope="col">Acertos</th>
        <th scope="col">01</th>
        <th scope="col">02</th>
        <th scope="col">03</th>
        <th scope="col">04</th>
        <th scope="col">05</th>
        <th scope="col">06</th>
        <th scope="col">07</th>
        <th scope="col">08</th>
      </tr>
    </thead>
    <tbody style="background-color: #1e293b; color: #fff;">
      <tr>
        <th scope="row"><i style="color: #fffb00ff;" class="fa-solid fa-trophy"></i> 1º</th>
        <td><i class="fa-solid fa-ticket"></i> BLT-001</td>
        <td><i class="fa-solid fa-user"></i> João Silva</td>
        <td>4</td>
        <td><i style="color:red; font-size: 23px;" class="fa-solid fa-circle-xmark"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
      </tr>
      <tr>
        <th scope="row"><i style="color:#dfdfdf;" class="fa-solid fa-medal"></i> 2º</th>
        <td><i class="fa-solid fa-ticket"></i> BLT-002</td>
        <td><i class="fa-solid fa-user"></i> Maria Santos</td>
        <td>3</td>
         <td><i style="color:red; font-size: 23px;" class="fa-solid fa-circle-xmark"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
      </tr>
      <tr>
        <th scope="row"><i style="color:#e98e00;" class="fa-solid fa-medal"></i> 3º</th>
        <td><i class="fa-solid fa-ticket"></i> BLT-003</td>
        <td><i class="fa-solid fa-user"></i> Pedro Costa</td>
        <td>1</td>
         <td><i style="color:red; font-size: 23px;" class="fa-solid fa-circle-xmark"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
      </tr>
      <tr>
        <th scope="row"><i  class="fa-solid fa-circle-xmark"></i> 4º</th>
        <td><i class="fa-solid fa-ticket"></i> BLT-004</td>
        <td><i class="fa-solid fa-user"></i> Ana Oliveira</td>
        <td>1</td>
       <td><i style="color:red; font-size: 23px;" class="fa-solid fa-circle-xmark"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
        <td><i style="color: rgb(16 185 129); font-size: 23px;" class="fa-solid fa-circle-check"></i></td>
      </tr>
    </tbody>
  </table>
</div>

  </div>

 <div class="container mt-4">
  <div class="row text-center g-3">

    <!-- Card 1 -->
    <div class="col-12 col-md-4">
      <div class="card shadow-sm border-0" style="background: linear-gradient(135deg, #ffe000, #ffc107); color:#202242;">
        <div class="card-body">
          <h6 class="fw-bold">Premiação</h6>
          <h2 class="fw-bold mb-0">R$ 2.000,00</h2>
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="col-12 col-md-4">
      <div class="card shadow-sm border-0" style="background: linear-gradient(135deg, #2196F3, #00BCD4); color: #fff;">
        <div class="card-body">
          <h6 class="fw-bold">Bilhetes</h6>
          <h2 class="fw-bold mb-0">200</h2>
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="col-12 col-md-4">
      <div class="card shadow-sm border-0" style="background: linear-gradient(135deg, #4CAF50, #2E7D32); color: #fff;">
        <div class="card-body">
          <h6 class="fw-bold">Ganhadores</h6>
          <h2 class="fw-bold mb-0">1</h2>
        </div>
      </div>
    </div>

  </div>
</div>





</div>



@include('Modal.ModalLoginRegistro')
@endsection
