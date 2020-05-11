    <!-- START nav -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand ml-3" href="{{ url('/') }}">La Carreta</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a href="{{ url('/') }}" class="nav-link">Inicio</a></li>
            <li class="nav-item"><a href="#section-about" class="nav-link">Acerca de</a></li>
            <li class="nav-item"><a href="#section-offer" class="nav-link">Catering</a></li>
            <li class="nav-item"><a href="#section-menu" class="nav-link">Menu</a></li>
            <li class="nav-item"><a href="#section-news" class="nav-link">Novedades</a></li>
            <li class="nav-item"><a href="#section-gallery" class="nav-link">Fotos</a></li>
            <li class="nav-item"><a href="#section-contact" class="nav-link">Contacto</a></li>
            @if (Auth::check())
              <li class="nav-item dropdown ">
                <a href="#" id="navbarDropdownMenuLink" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administrador</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a href="{{ url('/admin/users') }}" class="dropdown-item" title="Proyectos"><i class="fa fa-user"></i>&nbsp;Usuarios</a>
                  <a href="{{ url('/admin/categories') }}" class="dropdown-item" title="Productos"><i class="fa fa-book"></i>&nbsp;Menu</a>
                  <a href="{{ url('/admin/catering') }}" class="dropdown-item" title="Productos"><i class="fas fa-concierge-bell"></i>&nbsp;Catering</a>                  
                  <a href="{{ route('logout') }}" class="dropdown-item" title="Log Out"><i class="fas fa-sign-out-alt"></i>&nbsp;Cerrar Cesión</a>
                </div>
              </li>
            @else
              <li class="nav-item">
                <a href="{{ url('login') }}" class="nav-link" title="Log-In"><i class="fas fa-sign-in-alt"></i>&nbsp;Ingresar</a>
              </li>
            @endif            
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->