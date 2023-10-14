<!DOCTYPE html>
<html lang="en">
    @include('layouts.components.head')
<body>
  @auth
    @include('layouts.components.topbar')
  @endauth
  <!-- ======= Header ======= -->
  <header id="header">
    @include('layouts.navegacion.navbar')
  </header><!-- End Header -->
  @livewireStyles
    @yield('contenido')

  @include('layouts.components.footer')

  @livewireScripts

  <script>
    
    window.onload = function () {
      Livewire.on('message',($message)=>{
        iziToast.show({
            title: 'Exito',
            message: $message
        });
        
      });
      
    }
    
  </script>
  <script>
    window.onload =  function () {
      Livewire.on('alertarProveedorSeleccionado',()=>{
        iziToast.show({
            title: 'Exito',
            message: $message
        });
      })
    }
  </script>
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
