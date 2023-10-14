<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h3 class="m-0">Pedidos Asignados</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pedidos</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    {{-- @include('pages.vehiculo.insertar') --}}
                    <div class="card-tools">
                        {{-- @include('pages.vehiculo.buscar') --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="style-warning">
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Fecha Entrega</th>
                                    <th>Monto Total</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedidos as $pedido)
                                    <tr>
                                        <td>{{ $pedido->id }}</td>
                                        <td>{{ $pedido->fecha }}</td>
                                        <td>{{ $pedido->fechaentrega }}</td>
                                        <td>{{ $pedido->montoTotal }}</td>
                                        <td>
                                            @if ($pedido->estado == 0)
                                                <span class="badge badge-warning">Solicitado</span>
                                            @endif
                                            @if ($pedido->estado == 1)
                                                <span class="badge badge-warning">En Espera</span>
                                            @endif
                                            @if ($pedido->estado == 2)
                                                <span class="badge badge-success">Entregado</span>
                                            @endif
                                            @if ($pedido->estado == 3)
                                                <span class="badge badge-danger">Cancelado</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($pedido->estado == 1 || $pedido->estado == 0)

                                                <button class="btn btn-secondary btn-sm" wire:click='entregarPedido({{$pedido->id}})'>
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </button>
                                            @endif

                                            <a target="_blank" href="{{@ubicacion($pedido->id)->url}}" class="btn btn-sm btn-success">
                                                <i class="fas fa-location-arrow"></i>
                                            </a>

                                            <button type="button" class="btn btn-info btn-sm"
                                                data-toggle="modal" data-target="#modelId{{ $pedido->id }}">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                <i class="fas fa-clock"></i>
                                            </button>

                                            <div class="modal fade" id="modelId{{ $pedido->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content modal-sm">
                                                        <div class="modal-header style-warning">
                                                            <h5 class="modal-title">Datos de tiempo del Pedido</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span style="font-weight: 900;">
                                                                Hora :
                                                            </span>
                                                            {{$pedido->hora}} <br>
                                                            <span style="font-weight: 900;">
                                                                Hora entrega :
                                                            </span>
                                                            {{$pedido->horaentrega}}<br>
                                                            <span style="font-weight: 900;">
                                                                Tiempo entrega :
                                                            </span>
                                                            {{$pedido->tiempoentrega}}<br>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#cliente-{{$pedido->id}}">
                                              <i class="fa fa-user-circle" aria-hidden="true"></i>
                                            </button>

                                            <div class="modal fade" id="cliente-{{$pedido->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                            <div class="modal-header style-warning">
                                                                    <h5 class="modal-title">Datos del Cliente</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                Cliente  : {{cliente($pedido->idCliente)->nombre}} {{cliente($pedido->idCliente)->apellidos}} <br>
                                                                Telefono : {{cliente($pedido->idCliente)->telefono}}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#detalle{{$pedido->id}}">
                                              <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                            </button>

                                            <div class="modal fade" id="detalle{{$pedido->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header style-warning">
                                                            <h5 class="modal-title">Detalle del Pedido</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                                            {{-- <th>Medida</th>
                                                                            <th>SubMedida</th> --}}
                                                                            <th>Precio</th>
                                                                            <th>Cantidad</th>
                                                                            <th>SubTotal</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach (detallePedidoRepartidor($pedido->id) as $item)
                                                                        <tr>
                                                                            <td>{{$item->descripcion}}</td>
                                                                            <td>
                                                                                <img width="80" height="80" src="{{ asset($item->imagen) }}" alt="">
                                                                            </td>
                                                                            {{-- <td>{{$item->medida}}</td>
                                                                            <td>{{$item->submedida}}</td> --}}
                                                                            <td>{{$item->precioVenta}}</td>
                                                                            <td>{{$item->cantidad}}</td>
                                                                            <td>{{$item->subTotal}}</td>

                                                                        </tr>
                                                                        @endforeach

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
