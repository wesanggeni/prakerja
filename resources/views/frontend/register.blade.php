<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Prakerja</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{url('dist/css/bootstrap.css?version=')}}<?= rand(0, 10000); ?>">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <style type="text/css">
      .login, .image {
      min-height: 100vh;
      }
      .bg-image {
      background-image: url('{{url('dist/img/splash.jpeg')}}');
      background-size: cover;
      margin-left: -5px;
      }
    </style>
  </head>
  <body>
    @if ($errors->any())
    <div class="c-alert alert alert-warning alert-dismissible fade show" style="position: absolute;" role="alert">
      @foreach ($errors->all() as $error)
      {{ $error }}
      @endforeach
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    <div class="container-fluid">
      <div class="row no-gutter">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
        <div class="col-md-8 col-lg-6">
          <div class="login d-flex align-items-center py-5">
            <div class="container">
              <div class="row">
                <div class="col-md-9 col-lg-8 mx-auto">
                  <h3 class="login-heading mb-4">Selamat Datang!</h3>
                  <form action="{{url('get-register')}}" method="post">
                    @csrf
                    <div class="form-label-group mb-3">
                      <input name="firstname" type="text" class="form-control" placeholder="Nama Depan" required="">
                    </div>
                    <div class="form-label-group mb-3">
                      <input name="lastname" type="text" class="form-control" placeholder="Nama Belakang" required="">
                    </div>
                    <div class="form-label-group mb-3">
                      <input name="email" type="email" class="form-control" placeholder="Alamat Email" required="">
                    </div>
                    <div class="form-label-group mb-3">
                      <input name="password" type="password" class="form-control" placeholder="Kata Sandi" required="">
                    </div>
                    <div class="custom-control custom-checkbox mb-3">
                      <input type="checkbox" class="custom-control-input" id="customCheck1" required="">
                      <label class="custom-control-label" for="customCheck1">Saya telah membaca dan menyetujui dan tunduk pada peraturan prakerja.id</label>
                    </div>
                    <button class="btn btn-md btn-primary btn-block btn-login mb-2" type="submit">Daftar Sekarang!</button>
                    <div class="text-center">
                      <a class="small" href="{{url('login')}}">Masuk</a> |
                      <a class="small" href="#">Lupa Sandi</a> 
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>