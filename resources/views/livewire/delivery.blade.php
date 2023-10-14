<div>
    <div>
          <div class="content-header">
            <div class="container-fluid">
              <div class="mb-2 row">

                <div class="col-sm-6">
                  @if ($opcion)
                    <h3 class="m-0">
                      Atender Pedido
                    </h3>
                  @else
                    <h3 class="m-0">
                      Pedido
                    </h3>
                  @endif

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

          @if ($opcion)
            <section class="content">
              <div class="container-fluid">
                <div class="card">
                  <div class="card-header">
                      @if ($opcionAlmacen)
                          {{-- <button wire:click='verListaPedido' class="btn btn-info btn-sm" type="button">Ver Repuestos</button> --}}
                          <button wire:click='verRepuestosSolicitados' class="btn btn-primary style-primary btn-sm" type="button">Ver Repuestos</button>
                      @else
                        <button wire:click='verListaPedido' class="btn btn-warning btn-sm" type="button">Ver Pedidos</button>
                      @endif
                    <div class="card-tools">
                        <button style="border-radius: 20px" class="btn btn-sm btn-secondary">
                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                        </button>
                        <button style="border-radius: 20px" class="btn btn-sm btn-info" data-toggle="modal" data-target="#idCliente">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </button>


                        <!-- Modal -->
                        <div class="modal fade" id="idCliente" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header style-info">
                                        <h5 class="modal-title">Cliente</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="center">
                                            Nombre Completo : {{cliente($idCliente)->nombre}} {{cliente($idCliente)->apellidos}}

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                  </div>
                  <div class="card-body ">

                    <div class="row">
                        @if ($opcionAlmacen)
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hovver">
                                        <thead class="style-primary">
                                            <tr>
                                                <th>Id</th>
                                                <th>Almacen</th>
                                                <th>Stock Disponible</th>
                                                <th>Opcion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($repuestoalmacen as $item)
                                                <tr>
                                                    <td>{{$item->id}}</td>
                                                    <td>{{almacen($item->idAlmacen)->sigla}}</td>
                                                    <td>{{$item->stock}}</td>
                                                    <td>
                                                        <button
                                                            wire:click='obtenerRepuestoDelAlmacen({{$item->idRepuesto}},{{$item->idAlmacen}},{{$item->stock}})'
                                                            class="btn btn-sm btn-secondary">
                                                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered hover">
                                        <thead class="style-warning">
                                            <tr>
                                                <th>Repuesto</th>
                                                <th>Categoria</th>
                                                <th>Imagen</th>
                                                <th>Medida</th>
                                                <th>SubMedida</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>SubTotal</th>
                                                <th>Estado</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tbody>
                                                @foreach ($carritoDetalleSeleccionado as $carritoDetal)
                                                    <tr>

                                                        <td>{{$carritoDetal->descripcion}}</td>
                                                        <td>{{categoria($carritoDetal->idCategoria)->nombre}}</td>
                                                        <td>
                                                            <img width="80" height="80" src="{{asset($carritoDetal->imagen) }}" alt="">
                                                        </td>
                                                        <td>{{$carritoDetal->medida}}</td>
                                                        <td>{{$carritoDetal->submedida}}</td>

                                                        <td>{{$carritoDetal->cantidad}}</td>
                                                        <td>{{$carritoDetal->precioVenta}}</td>
                                                        <td>{{operaciones($carritoDetal->cantidad,$carritoDetal->precioVenta,'*')}}</td>
                                                        <td>


                                                            @if ($carritoDetal->estadoDetalle == 0)
                                                                <span class="badge badge-info">agregado</span>
                                                            @endif
                                                            @if ($carritoDetal->estadoDetalle == 1)
                                                                <span class="badge badge-success">solicitado</span>
                                                            @endif
                                                            @if ($carritoDetal->estadoDetalle == 2)
                                                                <span class="badge badge-success">seleecionado</span>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            @if ($carritoDetal->estadoDetalle == 1)
                                                                <button type="button" class="btn btn-sm btn-info" wire:click='atenderRepuestoAlmacen({{$carritoDetal->idRepuesto}},{{$carritoDetal->cantidad}},{{$carritoDetal->idDetalleCarrito}},{{$carritoDetal->refPedido}})'>
                                                                    <i class="fa fa-archive" aria-hidden="true"></i>
                                                                </button>
                                                            @endif

                                                            @if ($carritoDetal->estadoDetalle == 0)
                                                                <button disabled type="button" class="btn btn-sm btn-info" wire:click='atenderRepuestoAlmacen({{$carritoDetal->idRepuesto}},{{$carritoDetal->cantidad}},{{$carritoDetal->idDetalleCarrito}},{{$carritoDetal->refPedido}})'>
                                                                    <i class="fa fa-archive" aria-hidden="true"></i>
                                                                </button>
                                                            @endif

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif




                    </div>
                  </div>
                </div>
              </div>
            </section>
          @else
            <section class="content">
              <div class="container-fluid">
                <!-- Info boxes -->
                <div class="card">
                    <div class="card-header">
                      <div class="card-tools">
                        <form>
                          <div class="input-group-prepend">
                              <input  type="text" class="form-control" name="searchText" placeholder="Buscar..." wire:model='searchText'>
                              <button disabled  class="btn btn-info btn-sm" type="button"><i class="fas fa-search"></i></button>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
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
                                        <td>{{ $pedido->hora}}</td>
                                        <td>{{ $pedido->horaentrega}}</td>
                                        {{-- <td>{{ $pedido->tiempoentrega}}</td> --}}
                                        <td>
                                            @if ( $pedido->estado == 0)
                                                <span class="badge badge-info">Solicitado</span>
                                            @endif
                                            @if ($pedido->estado == 1)
                                                <span class="badge badge-info">Atendido</span>
                                            @endif
                                            @if ($pedido->estado == 2)
                                                <span class="badge badge-success">Entregado</span>
                                            @endif
                                            @if ($pedido->estado == 3)
                                                <span class="badge badge-success">Cancelado</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($pedido->estado == 3)
                                                <button type="button"  class="btn btn-info btn-sm btn-block">No disponible</button>
                                            @else
                                                <a href="{{ route('pdf.pedidos', ['id'=> $pedido->id]) }}" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-file"></i>
                                                </a>
                                                <a target="_blank" href="{{@ubicacion($pedido->id)->url}}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-location-arrow"></i>
                                                </a>

                                                <button wire:click='atenderPedido({{$pedido->id}},{{$pedido->idCliente}})' type="button" class="btn btn-secondary btn-sm">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </button>

                                                @if (is_null($pedido->idRepartidor))
                                                    <button type="button" class="btn style-warning btn-warning btn-sm" data-toggle="modal" data-target="#modal-seleccionar-repartidor{{ $pedido->id }}">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <div wire:ignore.self class="modal fade" class="modal fade" id="modal-seleccionar-repartidor{{ $pedido->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header style-warning">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Repartidores</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <section class="content">
                                                                        <div class="container-fluid">
                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                    <h3 class="card-title"></h3>
                                                                                        <h3 style="font-size: 16px; font-weight: 400">Seleccione un repartidor</h3>

                                                                                </div>

                                                                                <div class="card-body">
                                                                                    <div class="table-responsive">
                                                                                    <table class="table table-striped">
                                                                                        <thead class="style-warning">
                                                                                            <tr>
                                                                                                <th>ID</th>
                                                                                                <th>Nombre</th>
                                                                                                <th>Apellidos</th>
                                                                                                <th>Opcion</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @foreach ($repartidores as $repartidor)
                                                                                                <tr>
                                                                                                    <td>{{ $repartidor->id }}</td>
                                                                                                    <td>{{ $repartidor->nombre }}</td>
                                                                                                    <td>{{ $repartidor->apellidos }}</td>
                                                                                                    <td>
                                                                                                        <button wire:click='seleccionarRepartidor({{$pedido->id}},{{$repartidor->id}})' type="button" class="btn btn-warning btn-sm" data-dismiss="modal">
                                                                                                            <i class="fas fa-check"></i>
                                                                                                        </button>
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
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn style-warning btn-warning btn-sm" data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                @else
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#modelId">
                                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header style-warning">
                                                                    <h5 class="modal-title">Repartidor</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Nombre : {{repartidor($pedido->idRepartidor)->nombre}}<br>
                                                                    Apellidos : {{repartidor($pedido->idRepartidor)->apellidos}}<br>
                                                                    Licencia : {{repartidor($pedido->idRepartidor)->numeroLicencia}}<br>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#detalle-pedido-modal{{ $pedido->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                                <div wire:ignore.self class="modal fade" class="modal fade" id="detalle-pedido-modal{{ $pedido->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header style-warning">
                                                                <h5 class="modal-title" id="exampleModalLabel">Detalle pedido</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h3 class="card-title"></h3>
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <h6><span style="font-weight: 900; padding-right: 5px ">Cliente:</span>   {{ @cliente(@pedido($pedido->id)->idCliente)->nombre }} {{ @cliente(@pedido($pedido->id)->idCliente)->apellidos }}</h6>
                                                                            </div>
                                                                            <div class="text-right col-6">
                                                                                <h6><span style="font-weight: 900; padding-right: 5px ">Fecha:</span>    {{@pedido($pedido->id)->fecha}} </h6>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="card-body">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped">
                                                                                <thead class="style-warning">
                                                                                    <tr>
                                                                                        <th>Repuesto</th>
                                                                                        <th>Precio</th>
                                                                                        <th>Medida</th>
                                                                                        <th>Cantidad</th>
                                                                                        <th>SubTotal</th>
                                                                                        <th>Estado</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach (@detalleCarrito($pedido->id) as $p)
                                                                                        <tr>
                                                                                        {{-- <td>{{ $p->id }}</td> --}}
                                                                                        <td>{{ $p->descripcion}}</td>
                                                                                        <td>{{ $p->precioVenta}}</td>
                                                                                        <td>{{ $p->medida }}</td>
                                                                                        
                                                                                        <td>{{ $p->cantidad }}</td>
                                                                                        <td>{{ operaciones($p->precioVenta,$p->cantidad,'*')}} </td>
                                                                                        <td>
                                                                                            @if ($p->estado==1)
                                                                                                <span class="badge badge-info">Solicitado</span>
                                                                                            @endif
                                                                                            @if ($p->estado==2)
                                                                                                    <span class="badge badge-info">Seleccionado</span>
                                                                                            @endif
                                                                                        </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                                <tfoot>
                                                                                <tr>
                                                                                    <td colspan="5"> TOTAL : </td>
                                                                                    <td> Bs / {{@pedido($pedido->id)->montototal}}  </td>
                                                                                </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                            <div style="color: red" role="alert">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cerrar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- {{ $repuestoAlmacenes->links()}} --}}
                <!-- /.row -->
              </div><!--/. container-fluid -->
            </section>
          @endif
    </div>
</div>
