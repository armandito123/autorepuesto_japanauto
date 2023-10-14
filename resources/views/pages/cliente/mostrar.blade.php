@extends('index')
@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h3 class="m-0">Registrar Clientes</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Cliente</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    @include('pages.cliente.insertar')
                    <h3 class="card-title"></h3>
                    <div class="card-tools">
                        @include('pages.cliente.buscar')
                    </div>
                </div>
                @if (Session::has('success'))
                    <div class="alert style-info alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>
                            {{ Session::get('success') }}
                        </strong>
                    </div>
                @endif
                @if (Session::has('danger'))
                    <div class="alert style-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>
                            {{ Session::get('danger') }}
                        </strong>
                    </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="style-warning">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td>{{ $cliente->id }}</td>
                                        <td>{{ $cliente->nombre }}</td>
                                        <td>{{ $cliente->apellidos }}</td>
                                        <td>{{ $cliente->telefono }}</td>
                                        <td>{{ $cliente->correo }}</td>
                                        <td style="width:200px">
                                            @include('pages.cliente.actualizar')
                                            @include('pages.cliente.eliminar')
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            {{ $clientes->links() }}
        </div>
    </section>
@endsection
