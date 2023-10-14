@extends('index')
@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h3 class="m-0">Registrar repartidores</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">repartidor</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    @include('pages.repartidor.insertar')
                    <h3 class="card-title"></h3>
                    <div class="card-tools">
                        @include('pages.repartidor.buscar')
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="style-warning">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Numero de Licencia</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($repartidores as $repartidor)
                                    <tr>
                                        <td>{{ $repartidor->id }}</td>
                                        <td>{{ $repartidor->nombre }}</td>
                                        <td>{{ $repartidor->apellidos }}</td>
                                        <td>{{ $repartidor->correo }}</td>
                                        <td>{{ $repartidor->telefono }}</td>
                                        <td>{{ $repartidor->numeroLicencia }}</td>
                                        <td>
                                            @include('pages.repartidor.actualizar')
                                            @include('pages.repartidor.eliminar')
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $repartidores->links() }}
        </div>
    </section>
@endsection
