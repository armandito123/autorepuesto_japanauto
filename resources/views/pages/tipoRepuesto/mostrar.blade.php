@extends('index')
@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h3 class="m-0">Registrar SubCategoria</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">SubCategoria</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    @include('pages.tipoRepuesto.insertar')
                    <h3 class="card-title"></h3>
                    <div class="card-tools">
                        @include('pages.tipoRepuesto.buscar')
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="style-warning">
                                <tr>
                                    <th>ID</th>
                                    <th>SubCategoria</th>
                                    <th>Imagen</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tipoRepuestos as $tipoRepuesto)
                                    <tr>
                                        <td>{{ $tipoRepuesto->id }}</td>
                                        <td>{{ $tipoRepuesto->tipo }}</td>
                                        @if ($tipoRepuesto->logo)
                                            <td><img src="{{ asset($tipoRepuesto->logo) }}" width="100" height="100"
                                                    alt="">
                                            </td>
                                        @else
                                            <td>
                                                <div class="spinner-border text-info" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </td>
                                        @endif
                                        <td>
                                            @include('pages.tipoRepuesto.actualizar')
                                            @include('pages.tipoRepuesto.eliminar')
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $tipoRepuestos->links() }}
        </div>
    </section>
@endsection
