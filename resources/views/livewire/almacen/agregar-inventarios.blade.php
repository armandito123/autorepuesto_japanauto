<div>
    @if ($final)
    <div class="border row vh-100 justify-content-center align-items-center">

        <div class="col-auto bg-light align-items-center justify-content-center">
            <div class="text-center card">
                <div class="card-header style-warning">
                    Agregado Correctamente!
                </div>
                <div class="card-body">
                  {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                    <a href="{{ route('repuestoAlmacen.index') }}" class="btn btn-sm btn-warning">Ver Inventario</a>
                    <a href="{{ route('repuestoAlmacen.create') }}" class="btn btn-sm btn-success">Realizar Nuevo Registro</a>
                </div>
                <div class="card-footer text-muted">
                </div>
            </div>
        </div>
    </div>
    @else

        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h3 class="m-0">Inventario</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Inventario</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="card">
                    <div class="card-header style-warning">
                        <h3 class="card-title">Modulo de Almacenes</h3>
                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label for="idAlmacen">Almacen</label>
                            <div class="input-group">
                                @if ($idAlmacen)
                                    <button type="button" class="btn btn-success btn-sm col-1 disable">
                                        <i class="nav-icon fas fa-warehouse"></i> {{almacen($idAlmacen)->sigla}}
                                    </button>
                                @else
                                    <button type="button" class="btn btn-dark btn-sm col-1 disabled">
                                        <i class="nav-icon fas fa-warehouse"></i>
                                    </button>
                                @endif
                                <select name="idAlmacen" id="idAlmacen" class="form-control" wire:model='idAlmacen'>
                                    @if ($idAlmacen=='')
                                        <option value="">Seleccione un almacen</option>
                                    @endif
                                    @foreach (almacenes() as $almacen)
                                        <option value="{{$almacen->id}}">Almacen - {{$almacen->sigla}}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-sm btn-success col-2" data-toggle="modal" data-target="#nuevo-almacen">
                                    <i class="fas fa-plus"></i> <i class="nav-icon fas fa-warehouse"></i>
                                </button>

                                <div wire:ignore.self class="modal fade" id="nuevo-almacen" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header style-warning">
                                                <h5 class="modal-title">Nuevo Modal</h5>
                                            </div>
                                            <form >
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="sigla">Almacen</label>
                                                    <input type="text" class="form-control" required wire:model="sigla">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success style-success btn-sm" wire:click='crearAlmacen'>Crear Nuevo</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        @if ($idAlmacen)
                            <div class="m-4 row">
                                <label>Repuesto:</label>
                                <div class="input-group">

                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#repuestos-modal">
                                        <i class="fas fa-list"></i>
                                    </button>
                                    <button type="button" wire:click='seleccionarRepuesto()' class="btn btn-danger btn-sm">
                                        <i class="fas fa-check"></i>
                                    </button>

                                    <div wire:ignore.self class="modal fade" class="modal fade" id="repuestos-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header style-warning">
                                                    <h5 class="modal-title" id="exampleModalLabel">Seleccionar Repuestos</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <section class="content">
                                                        <div class="container-fluid">
                                                            @if ($vP)
                                                                <div class="card-group">
                                                                    <div class="card">
                                                                        <img src="{{asset(repuesto($idRepuesto)->imagen)}}" class="card-img-top" alt="">
                                                                        <div class="card-body">
                                                                            <p class="card-text">
                                                                                <span
                                                                                    style="font-size: 20px; font-weight: 700; font-style: italic;">J</span>apanAuto
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-4">Marca</div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->marca }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-4">Modelo</div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->modelo }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-4">Descripcion</div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->descripcion }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-4">SubMedida</div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->submedida }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-4">Medida</div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->medida }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-4">Precio Venta </div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->precioVenta }}
                                                                                </div>
                                                                            </div>
                                                                            {{-- <div class="row">
                                                                                <div class="col-5">Precio Compra</div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->precioCompra }}
                                                                                </div>
                                                                            </div> --}}
                                                                            <div class="row">
                                                                                <div class="col-4">Categoria</div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->categoria }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-4">SubCategoria</div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->tipo }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            @else
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <div class="card-tools">
                                                                            <div class="input-group-prepend">
                                                                                <select class="form-control"
                                                                                    wire:model='criterioModal' name="">
                                                                                    @if ($criterioModal == '')
                                                                                        <option value="">Buscar por...</option>
                                                                                    @endif
                                                                                    <option value="categorias">Categoria</option>
                                                                                    <option value="tipo_repuestos">SubCategoria</option>
                                                                                    <option value="marcas">Marca</option>
                                                                                </select>
                                                                                @if ($criterioModal=='categorias')
                                                                                    <select name="categorias-select" id="categorias-select" class="form-control" wire:model='searchTextRepuestoModal'>
                                                                                        @if ($searchTextRepuestoModal=='')
                                                                                            <option value="">Seleccione Categoria</option>
                                                                                        @endif
                                                                                        @foreach (categorias() as $categoria)
                                                                                            <option value="{{$categoria->nombre}}">{{$categoria->nombre}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                @endif
                                                                                @if ($criterioModal=='tipo_repuestos')
                                                                                    <select name="tipo_repuestos" id="tipo_repuestos" class="form-control" wire:model='searchTextRepuestoModal'>
                                                                                        @if ($searchTextRepuestoModal=='')
                                                                                            <option value="">Seleccione una SubCategoria</option>
                                                                                        @endif
                                                                                        @foreach (tipos() as $tipo)
                                                                                            <option value="{{$tipo->tipo}}">{{$tipo->tipo}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                @endif
                                                                                @if ($criterioModal=='marcas')
                                                                                    <select name="marcas" id="marcas" wire:model='searchTextRepuestoModal' class="form-control">
                                                                                        @if ($searchTextRepuestoModal=='')
                                                                                            <option value="">Seleccione una marca</option>
                                                                                        @endif
                                                                                        @foreach (marcas() as $marca)
                                                                                            <option value="{{$marca->nombre}}">{{$marca->nombre}}</option>
                                                                                        @endforeach
                                                                                    </select>

                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="input-group-prepend">
                                                                            @if ($estadoCantidadPrecioModal)
                                                                                <input type="number" class="form-control" wire:model='cantidadModal'     placeholder="cantidad">
                                                                                {{-- <input type="number" class="form-control" wire:model='precioCompraModal' placeholder="Precio Compra"> --}}
                                                                                <input type="number" class="form-control" wire:model='precioVentaModal'  placeholder="Precio Venta">
                                                                                <button type="button" wire:click='agrgadoRepuestoLista' class="btn btn-sm btn-warning"><i class="fas fa-check" aria-hidden="true"></i></button>
                                                                            @endif
                                                                        </div>
                                                                        <br>
                                                                        @if ($criterioModal != '')
                                                                            <div class="table-responsive">
                                                                                <table class="table table-bordered table-hover">
                                                                                    <thead class="style-warning">
                                                                                        <tr>
                                                                                            <th>ID</th>
                                                                                            <th>Descripcion</th>
                                                                                            <th>Codigo</th>
                                                                                            <th>Imagen</th>
                                                                                            <th>Opciones</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($repuestos as $repuesto)
                                                                                            <tr>
                                                                                                <td>{{$repuesto->idRepuesto}}</td>
                                                                                                <td>{{$repuesto->descripcion}}</td>
                                                                                                <td>{{$repuesto->codigo}}</td>
                                                                                                <td><img src="{{asset($repuesto->imagen)}}" alt="Foto" width="50" height="50"></td>
                                                                                                <td>
                                                                                                    <button type="button" wire:click='agregarRepuesto({{$repuesto->idRepuesto}})' class="btn btn-sm btn-success style-success"><i class="fas fa-check" aria-hidden="true"></i></button>
                                                                                                    <button type="button" wire:click='verProducto({{$repuesto->idRepuesto}})' class="btn btn-sm btn-warning"><i class="fa fa-eye" aria-hidden="true"></i> </button>
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        @else
                                                                            <div class="p-2 border">
                                                                                Seleccione un filtro de busqueda
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </section>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cerrar</button>
                                                    @if ($vP)
                                                        <button type="button" class="btn btn-sm btn-secondary" wire:click='verTablaProducto'>Ver Tabla</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="text" wire:model='searchCodigo' class="form-control">
                                    @if (count($repuestoSearch))
                                        <button type="button" class="btn btn-primary style-primary btn-sm" data-toggle="modal" data-target="#detalle-pieza"><i class="fas fa-eye" aria-hidden="true"></i></button>

                                        <div wire:ignore.self class="modal fade" id="detalle-pieza" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header style-primary">
                                                        <h5 class="modal-title">Detalle Repuesto</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <section class="content">
                                                            <div class="container-fluid">
                                                                <div class="card">
                                                                    @foreach ($repuestoSearch as $pieza)
                                                                        <div class="card-group">
                                                                            <div class="card">
                                                                                <img class="card-img-top"
                                                                                    src="{{ asset(repuesto($pieza->idRepuesto)->imagen) }}"
                                                                                    alt="Card image cap">
                                                                                <div class="card-body">
                                                                                    <p class="card-text"><span
                                                                                            style="font-size: 20px; font-weight: 700; font-style: italic;">J</span>apanAuto
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card">
                                                                                <div class="card-body">

                                                                                    {{-- <div class="border" style="padding: 5px"> --}}
                                                                                    <div class="row">
                                                                                        <div class="col-5">Marca</div>
                                                                                        <div class="col-2">:</div>
                                                                                        <div class="col-5">
                                                                                            {{ repuesto($pieza->idRepuesto)->marca }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-5">Modelo</div>
                                                                                        <div class="col-2">:</div>
                                                                                        <div class="col-5">
                                                                                            {{ repuesto($pieza->idRepuesto)->modelo }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-5">Descripcion</div>
                                                                                        <div class="col-2">:</div>
                                                                                        <div class="col-5">
                                                                                            {{ repuesto($pieza->idRepuesto)->marca }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-5">SubMedida</div>
                                                                                        <div class="col-2">:</div>
                                                                                        <div class="col-5">
                                                                                            {{ repuesto($pieza->idRepuesto)->submedida }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-5">Medida</div>
                                                                                        <div class="col-2">:</div>
                                                                                        <div class="col-5">
                                                                                            {{ repuesto($pieza->idRepuesto)->medida }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-5">Precio Venta
                                                                                        </div>
                                                                                        <div class="col-2">:</div>
                                                                                        <div class="col-5">
                                                                                            {{ repuesto($pieza->idRepuesto)->precioVenta }}
                                                                                        </div>
                                                                                    </div>
                                                                                    {{-- <div class="row">
                                                                                        <div class="col-5">Precio Compra
                                                                                        </div>
                                                                                        <div class="col-2">:</div>
                                                                                        <div class="col-5">
                                                                                            {{ repuesto($pieza->idRepuesto)->precioCompra }}
                                                                                        </div>
                                                                                    </div> --}}
                                                                                    <div class="row">
                                                                                        <div class="col-5">Categoria</div>
                                                                                        <div class="col-2">:</div>
                                                                                        <div class="col-5">
                                                                                            {{ repuesto($pieza->idRepuesto)->categoria }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-5">SubCategoria</div>
                                                                                        <div class="col-2">:</div>
                                                                                        <div class="col-5">
                                                                                            {{ repuesto($pieza->idRepuesto)->tipo }}
                                                                                        </div>
                                                                                    </div>
                                                                                    {{-- </div> --}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <!--/. container-fluid -->
                                                        </section>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-eye-slash "></i></button>
                                    @endif

                                    <input wire:model='cantidadSelect' type="number" class="form-control " placeholder="Stock">
                                    <input wire:model='precioVentaSelect' type="number" class="form-control" placeholder="Precio Venta">
                                    {{-- <input wire:model='precioCompraSelect' type="number" class="form-control" placeholder="Precio Compra"> --}}
                                </div>
                            </div>
                        @else
                            <div class="p-3 border">
                                Seleccione un Almacen
                            </div>
                        @endif

                        <section class="content">
                            <div class="container-fluid">
                                <!-- Info boxes -->
                                <div class="card">
                                    <div class="card-header style-warning">
                                        <h6 class="title">Tabla Repuestos</h6>
                                    </div>
                                    <div class="card-body">
                                        @if (count($arrayRepuestos))
                                            {{-- TABLA --}}
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover">
                                                    <thead class="style-warning">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Almacen</th>
                                                            <th>Repuesto</th>
                                                            <th>Stock</th>
                                                            <th>Precio Venta</th>
                                                            {{-- <th>Precio Compra</th> --}}
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    @php
                                                        $length = count($arrayRepuestos);
                                                    @endphp
                                                    <tbody>
                                                        @for ($i = 0; $i < $length; $i++)
                                                           <tr>
                                                                <td>{{ $arrayRepuestos[$i]['idRepuestos'] }}</td>
                                                                <td>{{ almacen($arrayRepuestos[$i]['idAlmacen'])->sigla}}</td>
                                                                <td>{{ $arrayRepuestos[$i]['nombre']}}</td>
                                                                <td>{{ $arrayRepuestos[$i]['cantidad']}}</td>
                                                                <td>{{ $arrayRepuestos[$i]['precioVenta']}}</td>
                                                                {{-- <td>{{ $arrayRepuestos[$i]['precioCompra']}}</td> --}}
                                                                <td>
                                                                    <button type="button" class="btn btn-success btn-circle btn-sm style-success" data-toggle="modal" data-target="#modificar-modal"><i class="fas fa-edit" aria-hidden="true"></i></button>
                                                                    <div wire:ignore.self class="modal fade" id="modificar-modal" tabindex="-1" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header style-primary">
                                                                                    <h5 class="modal-title">Modificar</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="form-group">
                                                                                        <label for="stock">Stock</label>
                                                                                        <input type="number" class="form-control" wire:model='cantidad' placeholder="{{ $arrayRepuestos[$i]['cantidad'] }}">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <label for="precioVenta">Precio Venta</label>
                                                                                        <input type="number" class="form-control" wire:model='precioVenta' placeholder="{{ $arrayRepuestos[$i]['precioVenta'] }}">
                                                                                    </div>
                                                                                    {{-- <div class="form-group">
                                                                                        <label for="precioCompra">Precio Compra</label>
                                                                                        <input type="number" class="form-control" wire:model='precioCompra' placeholder="{{ $arrayRepuestos[$i]['precioCompra'] }}">
                                                                                    </div> --}}
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" wire:click="actualizarPrecioStock({{ $i }})"data-dismiss="modal"aria-label="Close"class="btn btn-primary style-primary btn-sm">Actualizar</button>

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <button type="button"
                                                                    wire:click="eliminarRepuesto({{ $i }})"
                                                                    data-dismiss="modal" aria-label="Close"
                                                                    class="btn btn-danger btn-sm"><i
                                                                        class="fas fa-times"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <div class="p-2 text-center border">
                                                No hay Repuestos seleccionados
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if (count($arrayRepuestos))
                            <button class="btn btn-success btn-sm" wire:click='guardarInventario'>Guardar</button>
                        @endif
                    </div>
                </div>

            </div>
        </section>

    @endif
</div>
