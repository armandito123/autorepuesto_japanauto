<!DOCTYPE html>
<html lang="en">
  @include('components.head')
  @livewireStyles
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      @include('navegacion.nav')
      <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="index3.html" class="brand-link">
          <img src="{{ asset('imagenes/00.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">JapanAuto</span>
        </a>



      </aside>
      <div class="content-wrapper">
        @yield('contenido')
      </div>
      @include('components.footer')

      <aside class="control-sidebar control-sidebar-dark">
      </aside>
    </div>

    @include('components.script')
    @livewireScripts
  </body>
</html>
