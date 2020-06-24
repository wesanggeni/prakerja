<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">
    <title>Prakerja</title>
    <link href="{{url('dist/css/bootstrap.css?version=')}}<?= rand(0, 10000); ?>" rel="stylesheet">
    <link href="{{url('dist/css/sa-login.css?version=')}}<?= rand(0, 10000); ?>" rel="stylesheet">
  </head>

  <body cz-shortcut-listen="true">
    <form action="{{url('amadeus/login-process')}}" method="post" class="form-signin">
      @csrf
      <div class="text-center mb-4">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Prakerja</h1>
        <p>Build form controls with floating labels via the <code>:placeholder-shown</code> pseudo-element. <a href="#">Works in latest Chrome, Safari, and Firefox.</a></p>
      </div>

      <div class="form-label-group">
        <input name="email" type="email" class="form-control" placeholder="Email address" required="required">
      </div>

      <div class="form-label-group">
        <input name="password" type="password" class="form-control" placeholder="Password" required="required">
      </div>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-md btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted text-center">© 2019-2020</p>
    </form>
  

</body></html>