    <div>
        <div>
            <div class="content-header">
                <div class="container-fluid">
                    <div class="mb-2 row">
                        <div class="col-sm-6">
                            <h3 class="m-0">Mis Pedidos</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Pedido</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <form>
                                    <div class="input-group-prepend">
                                        <input type="text" class="form-control" name="searchText"
                                            placeholder="Buscar..." wire:model='searchText'>
                                        <button disabled class="btn btn-info btn-sm" type="button"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="example2">
                                    <thead class="style-warning">
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Fecha de Entrega</th>
                                            <th>Hora</th>
                                            <th>Hora de entrega</th>
                                            {{-- <th>Tiempo de Entrega</th> --}}
                                            <th>Estado</th>
                                            <th>Opcion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pedidos as $pedido)
                                            <tr>
                                                <td>{{ $pedido->id }}</td>
                                                <td>{{ $pedido->fecha }}</td>
                                                <td>{{ $pedido->fechaentrega }}</td>
                                                <td>{{ $pedido->hora }}</td>
                                                <td>{{ $pedido->horaentrega }}</td>
                                                {{-- <td>{{ $pedido->tiempoentrega }}</td> --}}
                                                <td>
                                                    @if ($pedido->estado == 0)
                                                        <span class="badge badge-primary">solicitado</span>
                                                    @endif
                                                    @if ($pedido->estado == 1)
                                                        <span class="badge badge-info">enviado</span>
                                                    @endif
                                                    @if ($pedido->estado == 2)
                                                        <span class="badge badge-success">Finalizado</span>
                                                    @endif
                                                    @if ($pedido->estado == 3)
                                                        <span class="badge badge-danger">Cancelado</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($pedido->estado == 0)
                                                        <button wire:click='cancelarPedido({{$pedido->id}})' class="btn btn-sm btn-danger"><i class="fa fa-window-close"aria-hidden="true"></i></button>

                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal" data-target="#detalle{{ $pedido->id }}">
                                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                        </button>

                                                        <div class="modal fade" id="detalle{{ $pedido->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header style-warning">
                                                                        <h5 class="modal-title">Detalle del Pedido</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="table-responsive">
                                                                                <table class="table table-bordered table-hover">
                                                                                    <thead class="style-warning">
                                                                                        <tr>
                                                                                            <th>Repuesto</th>
                                                                                            <th>Imagen</th>
                                                                                            <th>Precio</th>
                                                                                            <th>Cantidad</th>
                                                                                            <th>SubTotal</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>

                                                                                        @foreach (detallePedidoCarritoCliente($pedido->idCliente) as $item)
                                                                                            <tr>
                                                                                                <td>{{ $item->descripcion }}
                                                                                                </td>
                                                                                                <td>
                                                                                                    <img width="80" height="80"
                                                                                                        src="{{ asset($item->imagen) }}"
                                                                                                        alt="">
                                                                                                </td>
                                                                                                <td>{{ $item->precioVenta }}
                                                                                                </td>
                                                                                                <td>{{ $item->cantidad }}
                                                                                                </td>
                                                                                                <td>{{ operaciones($item->precioVenta,$item->cantidad,"*") }}
                                                                                                </td>

                                                                                            </tr>
                                                                                        @endforeach

                                                                                    </tbody>
                                                                                </table>


                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary btn-sm"
                                                                            data-dismiss="modal">Cerrar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($pedido->estado == 1)
                                                        <button wire:click='cancelarPedido({{$pedido->id}})' class="btn btn-sm btn-danger"><i class="fa fa-window-close"aria-hidden="true"></i></button>

                                                        <button type="button" class="btn btn-info style-info btn-sm"
                                                            data-toggle="modal" data-target="#detalle{{ $pedido->id }}">
                                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                        </button>

                                                        <div class="modal fade" id="detalle{{ $pedido->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header style-warning">
                                                                        <h5 class="modal-title">Detalle del Pedido</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="table-responsive">
                                                                                <table class="table table-bordered table-hover">
                                                                                    <thead class="style-warning">
                                                                                        <tr>
                                                                                            <th>Repuesto</th>
                                                                                            <th>Imagen</th>
                                                                                            <th>Precio</th>
                                                                                            <th>Cantidad</th>
                                                                                            <th>SubTotal</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>

                                                                                        @foreach (detallePedidoCarritoCliente($pedido->idCliente) as $item)
                                                                                            <tr>
                                                                                                <td>{{ $item->descripcion }}
                                                                                                </td>
                                                                                                <td>
                                                                                                    <img width="80" height="80"
                                                                                                        src="{{ asset($item->imagen) }}"
                                                                                                        alt="">
                                                                                                </td>
                                                                                                <td>{{ $item->precioVenta }}
                                                                                                </td>
                                                                                                <td>{{ $item->cantidad }}
                                                                                                </td>
                                                                                                <td>{{ operaciones($item->precioVenta,$item->cantidad,"*") }}
                                                                                                </td>

                                                                                            </tr>
                                                                                        @endforeach

                                                                                    </tbody>
                                                                                </table>


                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary btn-sm"
                                                                            data-dismiss="modal">Cerrar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($pedido->estado == 2)

                                                        <a href="{{ route('pdf.pedidos', ['id'=> $pedido->id]) }}" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-file"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal" data-target="#detalle{{ $pedido->id }}">
                                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                        </button>

                                                        <div class="modal fade" id="detalle{{ $pedido->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header style-warning">
                                                                        <h5 class="modal-title">Detalle del Pedido</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="table-responsive">
                                                                                <table class="table table-bordered table-hover">
                                                                                    <thead class="style-warning">
                                                                                        <tr>
                                                                                            <th>Repuesto</th>
                                                                                            <th>Imagen</th>
                                                                                            <th>Precio</th>
                                                                                            <th>Cantidad</th>
                                                                                            <th>SubTotal</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>

                                                                                        @foreach (detallePedidoCarritoCliente($pedido->idCliente) as $item)
                                                                                            <tr>
                                                                                                <td>{{ $item->descripcion }}
                                                                                                </td>
                                                                                                <td>
                                                                                                    <img width="80" height="80"
                                                                                                        src="{{ asset($item->imagen) }}"
                                                                                                        alt="">
                                                                                                </td>
                                                                                                <td>{{ $item->precioVenta }}
                                                                                                </td>
                                                                                                <td>{{ $item->cantidad }}
                                                                                                </td>
                                                                                                <td>{{ operaciones($item->precioVenta,$item->cantidad,"*") }}
                                                                                                </td>

                                                                                            </tr>
                                                                                        @endforeach

                                                                                    </tbody>
                                                                                </table>


                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary btn-sm"
                                                                            data-dismiss="modal">Cerrar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($pedido->estado == 3)
                                                        <span class="badge badge-danger">Cancelado</span>
                                                    @endif




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
        </div>

    </div>
