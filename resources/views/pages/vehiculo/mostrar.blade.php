@extends('index')
@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h3 class="m-0">Registrar Vehiculos</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Vehiculo</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    @include('pages.vehiculo.insertar')
                    <div class="card-tools">
                        @include('pages.vehiculo.buscar')
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="style-warning">
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo</th>
                                    <th>Placa</th>
                                    <th>Repartidor</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehiculos as $vehiculo)
                                    <tr>
                                        <td>{{ $vehiculo->id }}</td>
                                        <td>{{ $vehiculo->tipo }}</td>
                                        <td>{{ $vehiculo->placa }}</td>
                                        <td>{{ $vehiculo->nombre }} {{ $vehiculo->apellidos }}</td>
                                        <td>
                                            @include('pages.vehiculo.actualizar')
                                            @include('pages.vehiculo.eliminar')
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
