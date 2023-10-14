<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h3 class="m-0">Ventas</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ventas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('venta.create') }}" class="btn btn-warning btn-sm">Nueva Venta</a>
                    <h3 class="card-title"></h3>
                    <div class="card-tools">
                        <form>
                            <div class="input-group-prepend">
                                <input style="border-radius: 20px " type="text" class="form-control" name="searchText"
                                    placeholder="Buscar..." wire:model='searchText'>
                                <button style="border: none; background: none ; position: relative; right: 17%;"
                                    disabled class="btn btn-info btn-sm" type="button"><i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="style-warning">
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Monto Total</th>
                                    <th>Cliente</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ventas as $venta)
                                    <tr>
                                        <td>{{ $venta->id }}</td>
                                        <td>{{ $venta->fecha }}</td>
                                        <td>{{ $venta->montoTotal }}</td>
                                        <td>{{ $venta->nombre }} - {{ $venta->apellidos }}</td>
                                        <td>
                                            <a href="{{ route('pdf.ventas', ['id' => $venta->id]) }}"
                                                class="btn btn-sm btn-circle btn-danger"><i class="fas fa-file"></i></a>

                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#detalle-venta-modal{{ $venta->id }}">
                                                {{-- <i class="fas fa-eye"></i> --}}
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <!-- Modal repuestos -->
                                            <div wire:ignore.self class="modal fade" class="modal fade"
                                                id="detalle-venta-modal{{ $venta->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header style-warning">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detalle Venta
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <section class="content">
                                                                <div class="container-fluid">



                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title"></h3>
                                                                                <h6>Cliente:
                                                                                    {{ @buscarCliente(notaVenta($venta->id)->idCliente)->nombre }}
                                                                                    {{ @buscarCliente(notaVenta($venta->id)->idCliente)->apellidos }}
                                                                                </h6>
                                                                                <h6>Fecha:
                                                                                    {{ @notaVenta($venta->id)->fecha }}
                                                                                </h6>

                                                                        </div>

                                                                        <div class="card-body">
                                                                            <table class="table table-striped">
                                                                                <thead class="style-warning">
                                                                                    <tr>
                                                                                        <th>ID</th>
                                                                                        <th>Nombre</th>
                                                                                        <th>Precio</th>
                                                                                        <th>Cantidad</th>
                                                                                        <th>SubTotal</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach (@detalleVenta($venta->id) as $repuesto)
                                                                                        <tr>
                                                                                            <td>{{ @repuesto(@repuestoAlmacen($repuesto->idRepuestoAlmacen)->idRepuesto)->id }}
                                                                                            </td>
                                                                                            <td>{{ @repuesto(@repuestoAlmacen($repuesto->idRepuestoAlmacen)->idRepuesto)->descripcion }}
                                                                                            </td>
                                                                                            <td>{{ @repuesto(@repuestoAlmacen($repuesto->idRepuestoAlmacen)->idRepuesto)->precioVenta }}
                                                                                            </td>
                                                                                            <td>{{ $repuesto->cantidad }}
                                                                                            </td>
                                                                                            <td>{{ $repuesto->subTotal }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                                <tfoot>
                                                                                    <tr>
                                                                                        <td> TOTAL:</td>
                                                                                        <td> </td>
                                                                                        <td> </td>
                                                                                        <td> </td>
                                                                                        <td> {{ @notaVenta($venta->id)->montoTotal }}
                                                                                        </td>

                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                            <div style="color: red" role="alert">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                        {{-- 75020895 --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            {{-- {{ $repuestoAlmacenes->links()}} --}}
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
</div>
