<!-- 💬 Botão flutuante do WhatsApp -->
<a href="https://wa.me/5599999999999" target="_blank"
   class="btn-whatsapp position-fixed d-flex align-items-center justify-content-center
   {{ Auth::check() ? 'com-bilhete' : 'sem-bilhete' }}"
   title="Fale conosco no WhatsApp">
  <i class="fa-brands fa-whatsapp fa-lg"></i>
</a>

@auth
<!-- 🎫 Botão flutuante de Bilhete -->
<a href="{{ route('bilhete.index') }}"
   class="btn-bilhete position-fixed d-flex align-items-center justify-content-center"
   title="Ver meu carrinho">
  <i class="fa-solid fa-ticket fa-lg"></i>
  <span class="contador-bilhetes">{{ $bilhetesCount }}</span>
</a>
@endauth



<style>
  /* ======================================================
     💬 BOTÃO DO WHATSAPP
  ====================================================== */
  .btn-whatsapp {
    position: fixed;
    right: 25px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #25d366, #128c7e);
    color: #fff;
    border-radius: 50%;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
    transition: all 0.3s ease;
    z-index: 1;
    text-decoration: none;
    opacity: 0;
    transform: translateY(15px);
    animation: aparecerBotao 0.6s ease forwards;
    animation-delay: 0.3s;
  }

  /* 🔸 quando o usuário estiver logado → fica acima do bilhete */
  .btn-whatsapp.com-bilhete {
    bottom: 100px;
  }

  /* 🔸 quando o usuário NÃO estiver logado → fica na base (posição do bilhete) */
  .btn-whatsapp.sem-bilhete {
    bottom: 25px;
  }

  .btn-whatsapp:hover {
    transform: scale(1.08);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.35);
    color: #fff;
  }

  .btn-whatsapp i {
    font-size: 1.6rem;
  }

  /* ======================================================
     🎫 BOTÃO DO BILHETE
  ====================================================== */
  .btn-bilhete {
    position: fixed;
    bottom: 25px;
    right: 25px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #0d6efd, #6610f2);
    color: #fff;
    border-radius: 50%;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
    transition: all 0.3s ease;
    z-index: 1;
    text-decoration: none;
    opacity: 0;
    transform: translateY(15px);
    animation: aparecerBotao 0.6s ease forwards;
    animation-delay: 0.6s;
  }

  .btn-bilhete:hover {
    transform: scale(1.08);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.35);
    color: #fff;
  }

  .btn-bilhete i {
    font-size: 1.4rem;
  }

  /* 🔸 contador do bilhete */
  .btn-bilhete .contador-bilhetes {
    position: absolute;
    top: 8px;
    right: 8px;
    background: #dc3545;
    color: #fff;
    font-size: 0.75rem;
    font-weight: 600;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 6px rgba(0, 0, 0, 0.3);
  }

  /* ======================================================
     ✨ ANIMAÇÃO DE ENTRADA
  ====================================================== */
  @keyframes aparecerBotao {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>
