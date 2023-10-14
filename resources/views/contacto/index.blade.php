<!DOCTYPE html>
<html>
<head>
    <title>Contacto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

@include('layouts.components.head')
</head>
<body>

    @auth
    @include('layouts.components.topbar')
  @endauth
  <!-- ======= Header ======= -->
  <header id="header">
    @include('layouts.navegacion.navbar')
  </header><!-- End Header -->

  @livewireStyles
    



    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <div class="container-contactanos">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <div class="titulo-contacto">
                    <i class="fas fa-envelope"></i>
                    <h1>ENVIAR UN CORREO</h1>
                </div>

            <!--FORMULARIO PARA ENVIO DE CORREOS-->
                <form action="{{ route('contacto.store') }}" method="POST" class="px-8 py-8 form-contacto">
                    @csrf  <!--TOKEN-->
                    <div class="mb-3"><!--ASUNTO-->
                      <label for="asunto" class="form-label">Asunto:</label>
                      <input type="text" class="form-control" name="asunto" id="asunto"  placeholder="Ingrese el Asunto">
                      @error('asunto')<!--mensaje de validacion del campo asunto-->
                        <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                
                    <div class="mb-3"><!--NOMBRE-->
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre"  placeholder="Ingrese su nombre">
                        @error('nombre')<!--mensaje de validacion del campo nombre-->
                            <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                
                    <div class="mb-3"><!--CORREO REMITENTE-->
                        <label for="correo_remitente" class="form-label">Correo Remitente:</label>
                        <input type="text" class="form-control" name="correo_remitente" id="correo_remitente"  placeholder="Ingrese su correo">
                        @error('correo_remitente')<!--mensaje de validacion del correo remitente-->
                            <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                
                    <div class="mb-3"><!--CORREO DESTINATARIO-->
                        <label for="correo_destino" class="form-label">Correo Destinatario:</label>
                        <select class="form-control form-control" id="correo_destino" name="correo_destino" style="width: 100%;">
                                <option value="">-Seleccionar Correo-</option>
                                <option style="color: rgb(6, 169, 74)" value="reclamos@correo.autorepuesto.com">REALIZAR UN RECLAMO: reclamos@correo.autorepuesto.com</option>
                                <option style="color: rgb(6, 169, 74)" value="soporte@correo.autorepuesto.com">SOLICITAR SOPORTE TECNICO: soporte@correo.autorepuesto.com</option>
                                
                               
                        </select>
                        {{-- <input type="text" class="form-control" name="correo_destino" id="correo_destino"  placeholder="Ingrese correo destinatario"> --}}
                        @error('correo_destino')<!--mensaje de validacion del correo destinatario-->
                            <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                
                    <div class="mb-3"><!--MENSAJE DEL CORREO-->
                        <label for="mensaje" class="form-label">Mensaje:</label>
                        <textarea class="form-control" name="mensaje" id="mensaje" rows="5"  placeholder="Ingresa tu mensaje aqui"></textarea>
                        @error('mensaje')<!--mensaje de validacion del: mensaje del correo-->
                            <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                    <center>
                    <button type="submit" class="btn btn-primary">Enviar Correo</button>
                    </center>
                  </form>

                  <!--MENSAJE ALERTA DE VERIFICACION DE ENVIO DEL CORREO-->
                <center>
                    @if (Session::has('info'))
                        <div>
                           
                            <strong style="color: rgb(1, 120, 1);"><i style="font-size: 100px;" class="fas fa-check-circle"></i> {{Session::get('info')}} </strong>
                        </div>
                    @endif
                </center>
                
            </div>
            <div class="col-md-2"></div>
        </div>
  </div>


@include('layouts.components.footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>

  <!-- Vendor JS Files -->
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  {{-- <script src="sweetalert2.min.js"></script> --}}
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="stylesheet" href="{{ asset('plantilla/plugins/fontawesome-free/css/all.min.css')}}">
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkcVNAyzDyv41_ThaRWd2pJXop0GTOXgs&callback=initMap&libraries=geometry">
  </script>


  @include('layouts.components.scripts')
  @include('layouts.components.mapa')
  @include('layouts.components.estilo')
  @include('layouts.components.repuestos')
  @yield('mapa')

</body>
</html>
