@extends('index')
@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h3 class="m-0">Registrar Categorias</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Categoria</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    @include('pages.categoria.insertar')
                    <h3 class="card-title"></h3>
                    <div class="card-tools">
                        @include('pages.categoria.buscar')
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class=style-warning>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Logo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorias as $categoria)
                                    <tr>
                                        <td>{{ $categoria->id }}</td>
                                        <td>{{ $categoria->nombre }}</td>
                                        @if (!$categoria->logo)
                                            <td>
                                                <div class="spinner-border text-info" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </td>
                                        @else
                                            <td><img src="{{ asset($categoria->logo) }}" width="100" height="100" alt="">
                                            </td>
                                        @endif
                                        <td>
                                            @include('pages.categoria.actualizar')
                                            @include('pages.categoria.eliminar')
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $categorias->links() }}
        </div>
    </section>
@endsection
