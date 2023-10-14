<!DOCTYPE html>
<html lang="en">
@include('components.head')
@livewireStyles

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('navegacion.nav')

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="{{ asset('imagenes/autorepuesto.jpg') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ empresa('nombre') }}</span>
            </a>
            @role('cliente')
            @include('navegacion.sidebarCliente')
            @endrole

            @role('admin')
            @include('navegacion.sidebar')
            @endrole

            @role('repartidor')
            @include('navegacion.sidebarRepartidor')
            @endrole
        </aside>

        <div class="content-wrapper">
            @yield('contenido')
        </div>

        @include('components.footer')

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    @include('components.script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>

    <script>
        window.onload = function() {
            Livewire.on('message', ($message) => {

                if ($message[0] == "info") {
                    iziToast.show({
                        title: 'Exito',
                        message: $message[1],
                        theme: 'dark',
                        position: 'topRight',
                    });
                }
                if ($message[0] == "danger") {
                    iziToast.error({
                        title: 'Exito',
                        message: $message[1],
                        position: 'bottomRight',
                        backgroundColor: '#f17d7e',
                        // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
                    });
                }
                if ($message[0] == "success") {
                    iziToast.success({
                        title: 'Exito',
                        message: $message[1],
                        position: 'bottomLeft'
                    });
                }
                if ($message[0] == "warning") {
                    iziToast.warning({
                        title: 'Exito',
                        message: $message[1],
                        position : 'topLeft'
                    });
                }
                if ($message[0] == "swalDanger") {

                    Swal.fire({
                        title: 'Error!',
                        text: $message[1],
                        icon: 'error',
                        confirmButtonText: 'Cool'
                    });
                }
                if ($message[0] == 'swalSuccess') {
                    Swal.fire({
                        title: 'Exito',
                        text: $message[1],
                        icon: 'success',
                        confirmButtonText: 'Cool'
                    });
                }
                if ($message[0] == 'swalInfo') {
                    Swal.fire({
                        title: 'Informacion',
                        text: $message[1],
                        icon: 'info',
                        confirmButtonText: 'Cool'
                    });
                }
                if ($message[0] == 'swalWarning') {
                    Swal.fire({
                        title: 'Informacion',
                        text: $message[1],
                        icon: 'warning',
                        confirmButtonText: 'Cool'
                    });
                }
            });
            Livewire.on('cerrarmodalrepartidor',(id)=>{
            $("#"+id).modal("hide")
            // console.log("mensaje de prueba en console log" + id)
            })
        }
    </script>
    @livewireScripts
</body>

</html>
