<!DOCTYPE html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>@yield('title')</title>
    <link href="{{url('dist/css/bootstrap.css?version=')}}<?= rand(0, 10000); ?>" rel="stylesheet">
    <link href="{{url('dist/css/sa-frontend.css?version=')}}<?= rand(0, 10000); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@100;200;300;400;500;600&family=Red+Hat+Text:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body class="d-flex flex-column h-100 bg-light" cz-shortcut-listen="true">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
        <div class="navbar-header d-flex col">
          <a class="navbar-brand" href="{{url('/')}}"><i class="fa fa-cube"></i>Prakerja<b>.id</b></a>     
          <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
          <span class="navbar-toggler-icon"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
        </div>
        <!-- navbar -->
        <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
          <form class="navbar-form form-inline">
            <div class="input-group search-box">                
              <input type="text" id="search" class="form-control form-control-sm" placeholder="Cari">
              <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
            </div>
          </form>
          <ul class="nav navbar-nav ml-auto" style="margin-right: 10px;">
            <li class="nav-item"><a href="{{url('pekerjaan')}}" class="nav-link">Cari Perkerjaan</a></li>
            <li class="nav-item"><a href="{{url('/')}}" class="nav-link">Media Sosial</a></li>
            <li class="nav-item dropdown">
              <a data-toggle="dropdown" class="nav-link dropdown-toggle" href="#">Wawasan <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#" class="dropdown-item">Wirausaha</a></li>
                <li><a href="#" class="dropdown-item">Pendidikan</a></li>
              </ul>
            </li>
          </ul>
          <?php if ($user = Sentinel::check()) { ?>
          <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
              <a href="#" class="nav-link notifications">
                <i class="fa fa-bell-o"></i>
                <!--<span class="badge">1</span>-->
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link messages">
                <i class="fa fa-envelope-o"></i>
                <!--<span class="badge">10</span>-->
              </a>
            </li>
            <li class="nav-item dropdown">
              <a href="#" style="margin-right: -0.5rem;" data-toggle="dropdown" class="nav-link dropdown-toggle user-action">
                <img src="{{$user->avatar_sm}}" class="avatar" alt="Avatar">
                 {{$user->name}} 
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="#" class="dropdown-item"><i class="fa fa-user-o"></i> Profil</a></li>
                <li><a href="#" class="dropdown-item"><i class="fa fa-sliders"></i> Pengaturan</a></li>
                <li class="divider dropdown-divider"></li>
                <li><a href="{{url('logout')}}" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Keluar</a></li>
              </ul>
            </li>
          </ul>
          <?php } else { ?>
          <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
              <a href="{{url('register')}}" class="nav-link">
              Daftar
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('login')}}" class="nav-link c-outline">
              Masuk
              </a>
            </li>
          </ul>
          <?php } ?>
        </div>
    </nav>
    <main role="main" style="margin-top: 55px;">
      <!-- Content Header (Page header) -->
      @yield('content')
      <!-- /.content -->
    </main>
    <footer class="footer py-3" style="background-color: #fff; margin-top: 30px; border-top: 1px #eee solid;">
      <div class="container text-center">
        <span class="text-muted"><a href="">Prakerja.id</a> 2019 Allright Reserved.</span>
      </div>
    </footer>
    <!-- Bootstrap core JavaScript
      ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="{{url('dist/js/bootstrap.min.js')}}"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script src="{{url('dist/js/textarea.js')}}"></script>
  </body>
</html>