<div>
    @auth
        @role('cliente')
        <section id="topbar" class="d-none d-lg-block">

            <div class="container clearfix">
                <div class="float-left contact-info">
                </div>
                <div class="float-right social-links">

                    @if (!@boolRuta('pagos'))
                        <a href="#" data-toggle="modal" data-target="#carrito-modal" class="linkedin carrito">
                            <i class="fas fa-shopping-cart fa-2x"></i>
                            <span class="badge badge-success">{{ @contarCarrito($idCliente) }} </span>
                        </a>
                    @endif

                    <i class="fas fa-user fa-2x"></i><a style="color: white; text-transform: uppercase" href="mailto:contact@example.com">{{ Auth::user()->name }}</a>

                    <div wire:ignore.self class="modal fade" id="carrito-modal" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #d5bb0f;  ">
                                    <h5 class="modal-title" id="exampleModalLabel" style="color: #fff ; font-weight: 700">TU CARRITO DE COMPRA</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="tabla" style="display: block">
                                        <div class="row">
                                            <div class="col-12 table-responsive">
                                                <table id="detalle" class="table table-hover table-bordered">
                                                    <thead class="">
                                                        <th>REPUESTO</th>
                                                        <th>MEDIDA</th>
                                                        <th>SUBMEDIDA</th>
                                                        <th>MARCA</th>
                                                        <th>MODELO</th>
                                                        <th>CANTIDAD</th>
                                                        <th>PRECIO </th>
                                                        <th>SUBTOTAL</th>
                                                        <th>OPCIONES</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($carrito as $car)
                                                            <tr><!--Descripcion Unida-->
                                                                <td>{{ @repuesto($car->idRepuesto)->descripcion }}
                                                                    {{-- Med:{{ @repuesto($car->idRepuesto)->submedida }}|
                                                                    SubM:{{ @repuesto($car->idRepuesto)->medida }}|<br> --}}

                                                                    {{-- Marca:{{ @repuesto($car->idRepuesto)->marca }}
                                                                    Mdlo:{{ @repuesto($car->idRepuesto)->modelo }} --}}
                                                                </td>
                                                                
                                                                <td>{{ $car->medida }}</td>
                                                                <td>{{ $car->submedida }}</td>
                                                                <td>{{ @repuesto($car->idRepuesto)->marca }}</td>
                                                                <td>{{ @repuesto($car->idRepuesto)->modelo }}</td>
                                                                <td>{{ $car->cantidad }}</td>
                                                                <td>{{ @repuesto($car->idRepuesto)->precioVenta }}</td>
                                                                <td>{{ @repuesto($car->idRepuesto)->precioVenta * $car->cantidad }}
                                                                </td>
                                                                <td><button class="btn btn-sm btn-danger"
                                                                        wire:click='eliminar({{ $car->id }})'><i
                                                                            class="fas fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <th colspan="8">TOTAL</th>
                                                        <th>
                                                            <h6 id="total"> Bs/. {{ $total }}</h6>
                                                        </th>
                                                    </tfoot>
                                                </table>
                                                @if (!$estadoCarrito)
                                                    <a href="{{ route('web.pago', ['id' => $idCliente]) }}"
                                                        style=" padding: 15px;  border-radius: 20px; color: #fff; background-color: #c0a20c" >Realizar Pedido
                                                    </a>
                                                @else
                                                    <span style="color : rgb(130, 121, 121)"> Usted tiene un pedido pendiente</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endrole
    @endauth
</div>


{{-- @section('mapa')
@include('layouts.components.jsMapa')
@include('layouts.components.repuestos') --}}
