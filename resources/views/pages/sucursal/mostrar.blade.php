@extends('index')
@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h3 class="m-0">Registrar Sucursal</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">sucursal</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    @include('pages.sucursal.insertar')
                    <h3 class="card-title"></h3>
                    <div class="card-tools">
                        @include('pages.sucursal.buscar')
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="style-warning">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Ubicacion</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (@sucursales() as $sucursal)
                                    <tr>
                                        <td>{{ $sucursal->id }}</td>
                                        <td>{{ $sucursal->nombre }}</td>
                                        <td>{{ $sucursal->ubicacion }}</td>
                                        <td>
                                            @include('pages.sucursal.actualizar')
                                            @include('pages.sucursal.eliminar')
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $sucursales->links() }}
        </div>
    </section>
@endsection
