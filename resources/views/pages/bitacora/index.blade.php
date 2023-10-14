@extends('index')
@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h3 class="m-0">Registrar Bitacora</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Bitacora</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="card-tools">
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
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Tabla</th>
                                    <th>Transaccion</th>
                                    <th>Codigo Tabla</th>
                                    <th>Usuario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bitacoras as $bitacora)
                                    <tr>
                                        <td>{{ $bitacora->id }}</td>
                                        <td>{{ $bitacora->fecha }}</td>
                                        <td>{{ $bitacora->hora }}</td>
                                        <td>{{ $bitacora->tabla }}</td>
                                        <td>{{ $bitacora->transaccion }}</td>
                                        <td>{{ $bitacora->codigoTabla }}</td>
                                        <td>{{ $bitacora->idUser }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $bitacoras->links() }}
        </div>
    </section>
@endsection
