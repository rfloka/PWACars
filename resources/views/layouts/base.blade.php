<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Silabelenco @yield('title')</title>
  <!-- CSS -->
  <meta charset="utf-8">
  <meta name="description" content="Venda automóveis, motociclos e prestação de serviços">
  <meta name="keywords" content="carro,mota,financiamento,legalização,consultoria,automóvel">
  <meta name="author" content="Rafael Cruz">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">
  <link rel="manifest" href="/manifest.json">
  <link rel="apple-touch-icon" href="{{ asset('img/icons/ios/ios-appicon-76-76.png') }}" >
  <meta name="apple-mobile-web-app-status-bar" content="#1C1C1C">
  <meta name="theme-color" content="#1C1C1C">
  <!-- Bootstrap CSS -->
  @yield('links')
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/estilo.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mobile.css') }}">
  <!-- CSS -->
</head>

<body id="content">
  <!-- Navbar -->
  @if(Request::url() === url('/password/reset') )
  @else
    @if (session('status'))
      @if (session('status') =='Your password has been reset!')
      <div class="alert alert-success" role="alert" style="position:absolute;top:2%;left:10%;z-index:4;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <i class="fas fa-exclamation-triangle"></i> {{ session('status') }}
        </div>
      @else
      <div class="alert alert-danger" role="alert" style="position:absolute;top:2%;left:10%;z-index:4;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <i class="fas fa-exclamation-triangle"></i> {{ session('status') }}
      </div>
      @endif
      @endif
  @endif
  <nav class="navbar navbar-expand-lg  navbar-dark" style="background-color: #060606;">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ URL::asset('img/logo.png') }}" height="60" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav flex-fill text-center justify-content-center ulnav">
        @if(Request::url() === url('/') )
        <li class="nav-item active">
          <a class="nav-link" href="#viaturas">Viaturas<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#servicos">Serviços</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#mycar">MyCar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contactos">Contactos</a>
        </li>
        @else
        <li class="nav-item active">
          <a class="nav-link" href="/viaturas">Viaturas<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/servicos">Serviços</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/mycar">MyCar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contactos">Contactos</a>
        </li>
        @endif
      </ul>
      <ul class="text-center navbar-nav">
        <!-- Authentication Links -->
        @guest
        <li class="nav-item">
          <button type="button" class="btn btncontact" data-toggle="modal" data-target="#login"><i
              class="fas fa-user"></i> Login</button>
          <button type="button" class="btn btncontact" data-toggle="modal" data-target="#register"><i
              class="fas fa-sign-in-alt"></i> Register</button>
        </li>
        @else
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            <img src="/storage/upload/profilepics/{{Auth::user()->avatar}}"
              style="width:32px;height:32px;border-radius:50%;"> {{ Auth::user()->name }} <span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            @if (Auth::user()->role == "1")
            <a class="dropdown-item" href="/admin"><i style="color:#B90FB9;" class="fas fa-tachometer-alt"></i>
              Dashboard</a>
            @endif
            <a class="dropdown-item" href="/perfil">
              <i style="color:#B90FB9;" class="fas fa-address-card"></i> Perfil
            </a>
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i style="color:#B90FB9;" class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        @endguest
      </ul>
    </div>
  </nav>
  <!--modal-->
  <!--login-->
  @include('auth.login')
  <!--login-->
  <!--register-->
  @include('auth.register')
  <!--register-->
  <!--modal-->
  <!--Navbar-->
  @yield('content')
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <p>Desenvolvido por <span><a href="">Rafael Cruz</a></span></p>
          <p><i class="fas fa-envelope" style="color:#B90FB9;"></i> rafael.vieira.cruz.24@gmail.com</p>
          <p><a href="https://www.linkedin.com/in/rafael-c-802334141/"><i class="fab fa-linkedin" style="color:#B90FB9;"></i></a> <a href="https://www.facebook.com/rafael.dinis.7"><i class="fab fa-facebook-square" style="color:#B90FB9;"></i></a></p>
        </div>

      </div>
      <div class="text-center">
        <i class="far fa-copyright"></i> 2019 Rafael Cruz
      </div>
    </div>
  </footer>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  @yield('scripts')
</body>

</html>
