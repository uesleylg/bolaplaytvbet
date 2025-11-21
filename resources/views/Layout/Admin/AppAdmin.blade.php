<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Dashboard')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/afcee4f894.js" crossorigin="anonymous" defer></script>
  @if(!empty($configs['favicon']))
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $configs['favicon']) }}">
    <link rel="shortcut icon" href="{{ asset('storage/' . $configs['favicon']) }}">
@endif

</head>

<body class="bg-dark">

@include('Layout.Admin.Header')

      <section>
         @yield('content')
      </section>
@include('Layout.Admin.Footer')
      


  <!-- Bootstrap JS (Popper included) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Optionally add a tiny script to manage active nav links -->
  <script>
    
    document.querySelectorAll('.sidebar-nav .nav-link, .offcanvas-body .nav-link').forEach(function(link){
      link.addEventListener('click', function(e){
        document.querySelectorAll('.sidebar-nav .nav-link').forEach(n=>n.classList.remove('active'));
        document.querySelectorAll('.offcanvas-body .nav-link').forEach(n=>n.classList.remove('active'));
        // mark clicked as active (matches by text)
        var txt = this.textContent.trim();
        document.querySelectorAll('.sidebar-nav .nav-link').forEach(function(n){ if(n.textContent.trim()===txt) n.classList.add('active'); });
        document.querySelectorAll('.offcanvas-body .nav-link').forEach(function(n){ if(n.textContent.trim()===txt) n.classList.add('active'); });

        // if mobile, hide offcanvas after click
        var off = document.querySelector('#offcanvasSidebar');
        if(off && off.classList.contains('show')){
          var bsOff = bootstrap.Offcanvas.getInstance(off);
          if(bsOff) bsOff.hide();
        }
      });
    });
  </script>

</body>
</html>
