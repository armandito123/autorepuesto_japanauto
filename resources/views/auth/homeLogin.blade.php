<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Autorepuestos JAPANAUTO | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plantilla/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('plantilla/dist/css/adminlte.min.css')}}">
</head>
<body style="background-image: url('../imagenes/autoslider1.jpg')" class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a style="color: white;" href=""><b>{{empresa('nombre')}}</b></a>
  </div>
  @yield('content')
</div>

<script src="{{asset('plantilla/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('plantilla/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
