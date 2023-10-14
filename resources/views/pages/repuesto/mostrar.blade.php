@extends('index')
@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h3 class="m-0">Repuestos<h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Repeusto</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-warning btn-sm" href="{{ route('repuesto.crear') }}">Agregar Repuesto</a>
                    <h3 class="card-title"></h3>
                    <div class="card-tools">
                        @include('pages.repuesto.buscar')
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive style-scroll">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="style-warning">
                                <tr>
                                    <th>ID</th>
                                    <th style="min-width:150px">Codigo</th>
                                    <th style="min-width:150px">Imagen</th>
                                    <th style="min-width:150px">Descripcion</th>
                                    <th style="min-width:150px">Medida</th>
                                    <th style="min-width:150px">SubMedida</th>
                                    <th style="min-width:150px">Precio Venta</th>
                                    {{-- <th style="min-width:150px">Precio Compra</th> --}}
                                    <th style="min-width:150px">Marca</th>
                                    <th style="min-width:150px">Modelo</th>
                                    <th style="min-width:150px">SubCategoria</th>
                                    <th style="min-width:150px">Categoria</th>
                                    <th style="min-width:150px">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($repuestos as $repuesto)
                                    <tr>
                                        <td>{{ $repuesto->id }}</td>
                                        <td>{{ $repuesto->codigo }}</td>
                                        <td>
                                            <img src="{{ asset($repuesto->imagen) }}" alt="Girl in a jacket" width="80" height="80">
                                        </td>
                                        <td>{{ $repuesto->descripcion }}</td>
                                        <td>{{ $repuesto->medida }}</td>
                                        <td>{{ $repuesto->submedida }}</td>
                                        <td>{{ $repuesto->precioVenta }}</td>
                                        {{-- <td>{{ $repuesto->precioCompra }}</td> --}}
                                        <td>{{ @nombreMarca($repuesto->idMarcaModelo) }}</td>
                                        <td>{{ @nombreModelo($repuesto->idMarcaModelo) }}</td>
                                        <td>{{ $repuesto->tipo }}</td>
                                        <td>{{ $repuesto->categoria }} </td>
                                        <td>
                                            <a href="{{ route('repuesto.edit', ['idRepuesto' => $repuesto->id]) }}"
                                                type="button" class="btn btn-sm btn-success">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @include('pages.repuesto.eliminar')
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $repuestos->links() }}
        </div>
    </section>
@endsection
