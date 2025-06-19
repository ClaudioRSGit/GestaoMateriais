<nav class="navbar navbar-expand-md navbar-dark custom-navbar">
  <div class="container d-flex align-items-center">
    <a class="navbar-brand d-flex align-items-center" href="/">
      <img src="/logo.png" alt="Sustentabilidade e Reciclagem" class="logo-img mr-2" />
      MaiaXChange
    </a>

    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav">
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
        @else
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('user.profile') }}">Perfil</a>

              @if(Auth::user()->role === 'admin')
                <a class="dropdown-item" href="{{ route('home') }}">Administrador</a>
              @endif

              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
