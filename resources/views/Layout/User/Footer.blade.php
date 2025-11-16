<footer class="mt-auto">
    <div class="container text-center text-md-start">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                <h5 class="fw-bold text-uppercase mb-3">⚽ BolaPlay <span class="text-info">Bet</span></h5>
                <p class="text-secondary">Participe dos melhores bolões de futebol, teste seus palpites e dispute prêmios incríveis.</p>
            </div>
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="fw-bold text-uppercase mb-3">Links úteis</h6>
                <p><a href="#" class="text-secondary text-decoration-none">Início</a></p>
           
             @auth    <p><a href="{{ route('bilhete.index') }}" class="text-secondary text-decoration-none">Meus Bilhetes   </a></p> @endauth
                <p><a href="{{ route('ranking.index') }}" class="text-secondary text-decoration-none">Resultados</a></p>
                <p><a href="#" class="text-secondary text-decoration-none">Contato</a></p>
            </div>
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <h6 class="fw-bold text-uppercase mb-3">Contato</h6>
              
                <p><i class="bi bi-envelope-fill "></i> {{ config('app.email_suporte') }}</p>
                <p><i class="bi bi-whatsapp "></i> {{ config('app.telefone_suporte') }}</p>
            </div>
        </div>
        <hr class="mb-4 text-secondary" />
        <div class="text-center">
            <p class="mb-0 text-secondary">© 2025 <span class="fw-bold text-info">BolaPlay Bet</span> — Todos os direitos reservados.</p>
        </div>
    </div>
</footer>