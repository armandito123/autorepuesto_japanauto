<div>
    @if ($final)
    <div class="col-auto bg-light align-items-center justify-content-center">
        <div class="text-center card">
            <div class="card-header style-success">
                Agregado Correctamente!
            </div>
            <div class="card-body">
              {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                <a href="{{ route('venta.index') }}" class="btn btn-sm btn-warning">Ver Lista de Ventas</a>
                <a href="{{ route('venta.create') }}" class="btn btn-sm btn-success">Realizar Nuevo Registro</a>
            </div>
            <div class="card-footer text-muted">
            </div>
        </div>
    </div>
    @else

        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h3 class="m-0">Ventas</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Ventas</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header style-warning">
                        <h3 class="card-title">
                            Modulo de Ventas
                        </h3>
                        <div class="card-tools"></div>
                    </div>
                    <div class="card-body">

                        {{-- CLIENTE --}}
                        <div class="m-4 row">
                            <label> Cliente: </label>
                            <div class="input-group">

                                <button type="button" class="btn btn-dark btn-sm" data-toggle="modal"
                                    data-target="#clientes-modal">
                                    <i class="far fa-user"></i>
                                </button>


                                @if (!$idCliente)
                                    <button type="button" class="btn btn-danger btn-sm">
                                        <i class="fas fa-check"></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i>
                                    </button>
                                @endif
                                <!-- MODAL CLIENTE-->
                                <div wire:ignore.self class="modal fade" class="modal fade" id="clientes-modal"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header style-warning">
                                                <h5 class="modal-title" id="exampleModalLabel">Seleccionar Cliente</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                {{-- MODAL CLIENTE --}}
                                                <section class="content">
                                                    <div class="container-fluid">
                                                        <div class="card">
                                                            <div class="card-header style-warning">
                                                                <h3 class="card-title"></h3>
                                                                <div class="card-tools">
                                                                    <form>
                                                                        <div class="input-group-prepend">
                                                                            <input style="border-radius: 20px "
                                                                                type="text" class="form-control"
                                                                                name="searchText"
                                                                                placeholder="Buscar..."
                                                                                wire:model='searchTextCliente'>
                                                                            <button
                                                                                style="border: none; background: none ; position: relative; right: 17%;"
                                                                                disabled class="btn btn-info btn-sm"
                                                                                type="button"><i
                                                                                    class="fas fa-search"></i>
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table/responsive">
                                                                    <table class="table table-striped table-bordered">
                                                                        <thead class="style-warning">
                                                                            <tr>
                                                                                <th>ID</th>
                                                                                <th>Nombre</th>
                                                                                <th>Apellidos</th>
                                                                                <th>Opciones</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($clientes as $cliente)
                                                                                <tr>
                                                                                    <td>{{ $cliente->id }}</td>
                                                                                    <td>{{ $cliente->nombre }}</td>
                                                                                    <td>{{ $cliente->apellidos }}</td>
                                                                                    <td>
                                                                                        <button data-dismiss="modal"
                                                                                            wire:click='agregarCliente({{ $cliente->id }})'
                                                                                            href="#" type="button"
                                                                                            class="btn btn-sm btn-circle btn-success style-success">
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
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <select class="form-control" wire:model='idCliente'>
                                    @if (!$idCliente)
                                        <option value="0">Seleccione un Cliente </option>
                                    @endif
                                    @foreach (@clientes() as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}
                                            {{ $cliente->apellidos }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- ALMACEN --}}
                        <div class="m-4 row">
                            <label>Almacen: </label>
                            <div class="input-group">
                                <button type="button" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-check"></i>
                                </button>

                                <select class="form-control" wire:model='idAlmacen' name="idRepuesto">
                                    @if (!$idAlmacen)
                                        <option value="0">Seleccione un Almacen</option>
                                    @endif
                                    @foreach (@almacenes() as $cal)
                                        <option value="{{ $cal->id }}">Almacen {{ $cal->sigla }}</option>
                                    @endforeach
                                </select>

                                @if ($idAlmacen)
                                    <button class="btn btn-secondary disabled col-2"><i
                                        class="nav-icon fas fa-warehouse"></i>
                                        {{ @almacen($idAlmacen)->sigla }}
                                    </button>
                                @else
                                    <input class="col-3" wire:model='mensajeAlmacen' type="text" disabled
                                        class="form-control" placeholder="Almacen">
                                @endif
                            </div>
                        </div>
                        @if ($idAlmacen)
                            {{-- REPUESTO --}}
                            <div class="m-4 row">
                                <label>Repuesto:</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-dark btn-sm" data-toggle="modal"
                                        data-target="#repuestos-modal">
                                        <i class="fas fa-list"></i>
                                    </button>

                                    <button type="button" wire:click='seleccionarRepuesto()'
                                        class="btn btn-info btn-sm">
                                        <i class="fas fa-check"></i>
                                    </button>

                                    {{-- DETALLE REPUESTO --}}

                                    <div wire:ignore.self class="modal fade" class="modal fade"
                                        id="detalle-repuesto-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header style-warning">
                                                    <h5 class="modal-title" id="exampleModalLabel">Seleccionar Repuesto
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
                                                                <div class="card-body">
                                                                    <img src="{{ asset(@repuesto($idRepuesto)->imagen) }}"
                                                                        width="100" height="400" class="card-img-top"
                                                                        alt="Card image cap">
                                                                    <h5 class="card-title"></h5>
                                                                    <p class="card-text"></p>
                                                                    <div class="p-0 card-body table-responsive">
                                                                        <table class="table table-hover text-nowrap">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>DETALLE DEL REPUESTO</th>
                                                                                    <th></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <dl class="row">
                                                                                    <tr>
                                                                                        <td>
                                                                                            <dt class="col-sm-4">SubMedida:
                                                                                            </dt>
                                                                                        <td>
                                                                                            <dd class="col-sm-8">
                                                                                                {{ @repuesto($idRepuesto)->submedida }}
                                                                                            </dd>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <dt class="col-sm-4">Medida:
                                                                                            </dt>
                                                                                        </td>
                                                                                        <td>
                                                                                            <dd class="col-sm-8">
                                                                                                {{ @repuesto($idRepuesto)->medida }}
                                                                                            </dd>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <dt class="col-sm-4">
                                                                                                Categoria:</dt>
                                                                                        </td>
                                                                                        <td>
                                                                                            <dd class="col-sm-8">
                                                                                                {{ @repuesto($idRepuesto)->nombre }}
                                                                                            </dd>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <dt class="col-sm-4">
                                                                                                Repuesto:</dt>
                                                                                        </td>
                                                                                        <td>
                                                                                            <dd class="col-sm-8">
                                                                                                {{ @repuesto($idRepuesto)->descripcion }}
                                                                                            </dd>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <dt class="col-sm-4">SubCategoria:
                                                                                            </dt>
                                                                                        </td>
                                                                                        <td>
                                                                                            <dd class="col-sm-8">
                                                                                                {{ @repuesto($idRepuesto)->tipo }}
                                                                                            </dd>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <dt class="col-sm-4">Marca:
                                                                                            </dt>
                                                                                        </td>
                                                                                        <td>
                                                                                            <dd class="col-sm-8">
                                                                                                {{ @repuesto($idRepuesto)->marca }}
                                                                                            </dd>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <dt class="col-sm-4">Modelo:
                                                                                            </dt>
                                                                                        </td>
                                                                                        <td>
                                                                                            <dd class="col-sm-8">
                                                                                                {{ @repuesto($idRepuesto)->modelo }}
                                                                                            </dd>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <dt class="col-sm-4">Precio
                                                                                                Venta:</dt>
                                                                                        </td>
                                                                                        <td>
                                                                                            <dd class="col-sm-8">
                                                                                                {{ @repuesto($idRepuesto)->precioVenta }}
                                                                                            </dd>
                                                                                    </tr>
                                                                                </dl>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    @if ($message)
                                                                        <div style="color: red" role="alert">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/. container-fluid -->
                                                    </section>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#repuestos-modal">Cerrar</button>
                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                    {{-- <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#repuestos-modal">
                                                                <i class="fas fa-list"></i>
                                                            </button> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- MODAL REPUESTO-->
                                    <div wire:ignore.self class="modal fade" class="modal fade" id="repuestos-modal"
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header style-warning">
                                                    <h5 class="modal-title" id="exampleModalLabel">Seleccionar Repuestos
                                                    </h5>
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
                                                                        <img class="card-img-top"
                                                                            src="{{ asset(repuesto($idRepuesto)->imagen) }}"
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
                                                                                    {{ repuesto($idRepuesto)->marca }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-5">Modelo</div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->modelo }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-5">Descripcion</div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->marca }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-5">SubMedida</div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->submedida }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-5">Medida</div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->medida }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-5">Precio Venta </div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->precioVenta }}
                                                                                </div>
                                                                            </div>
                                                                            {{-- <div class="row">
                                                                                <div class="col-5">Precio Compra</div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->precioVenta }}
                                                                                </div>
                                                                            </div> --}}
                                                                            <div class="row">
                                                                                <div class="col-5">Categoria</div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->categoria }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-5">SubCategoria</div>
                                                                                <div class="col-2">:</div>
                                                                                <div class="col-5">
                                                                                    {{ repuesto($idRepuesto)->tipo }}
                                                                                </div>
                                                                            </div>
                                                                            {{-- </div> --}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h3 class="card-title"></h3>
                                                                        <div class="card-tools">

                                                                            <div class="input-group-prepend">
                                                                                <select class="form-control"
                                                                                    wire:model='criterioModal' name="">
                                                                                    @if ($criterioModal == '')
                                                                                        <option value="">Buscar por...
                                                                                    @endif
                                                                                    </option>
                                                                                    {{-- <option value="repuestos">Repuestos --}}
                                                                                    </option>
                                                                                    <option value="categorias">Categoria
                                                                                    </option>
                                                                                    <option value="tipo_repuestos">SubCategoria
                                                                                    </option>
                                                                                    <option value="marcas">Marca
                                                                                    </option>
                                                                                </select>
                                                                                @if ($criterioModal == 'repuestos')
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="searchText"
                                                                                        placeholder="Buscar..."
                                                                                        wire:model='searchTextRepuestoModal'>
                                                                                @endif
                                                                                @if ($criterioModal == 'categorias')

                                                                                    <select name=""
                                                                                        class="form-control select2"
                                                                                        wire:model="searchTextRepuestoModal">
                                                                                        @if ($searchTextRepuestoModal == '')
                                                                                            <option value="">Seleccione
                                                                                            </option>
                                                                                        @endif
                                                                                        @foreach (categorias() as $item)

                                                                                            <option
                                                                                                value="{{ $item->nombre }}">
                                                                                                {{ $item->nombre }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                @endif
                                                                                @if ($criterioModal == 'tipo_repuestos')

                                                                                    <select name=""
                                                                                        class="form-control select2"
                                                                                        wire:model="searchTextRepuestoModal">
                                                                                        @if ($searchTextRepuestoModal == '')
                                                                                            <option value="">Seleccione
                                                                                            </option>
                                                                                        @endif
                                                                                        @foreach (tipos() as $item)
                                                                                            <option
                                                                                                value="{{ $item->tipo }}">
                                                                                                {{ $item->tipo }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                @endif
                                                                                @if ($criterioModal == 'marcas')

                                                                                    <select name=""
                                                                                        class="form-control select2"
                                                                                        wire:model="searchTextRepuestoModal">
                                                                                        @foreach (marcas() as $item)
                                                                                            <option
                                                                                                value="{{ $item->nombre }}">
                                                                                                {{ $item->nombre }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                @endif
                                                                                <button disabled
                                                                                    class="btn btn-info btn-sm"
                                                                                    type="button"><i
                                                                                        class="fas fa-search"></i></button>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <!-- /.card-header repuesto -->
                                                                    <div class="card-body">
                                                                        <div class="input-group-prepend">
                                                                            @if ($estadoCantidadPrecioModal)
                                                                                <input wire:model='cantidadModal'
                                                                                    type="number" class="form-control "
                                                                                    placeholder="Cantidad">
                                                                                <input wire:model='precioModal'
                                                                                    type="number" class="form-control"
                                                                                    placeholder="Precio">
                                                                                <button wire:click='agrgadoRepuestoLista'
                                                                                    class="btn btn-secondary btn-sm">
                                                                                    <i class="fas fa-check"></i>
                                                                                </button>
                                                                            @endif
                                                                        </div>
                                                                        <br>
                                                                        @if ($criterioModal != '')
                                                                        <table id="example2"
                                                                        class="table table-bordered table-hover">
                                                                        <thead>
                                                                            <tr class="style-warning">
                                                                                <th>ID</th>
                                                                                <th>Descripcion</th>
                                                                                <th>Codigo</th>
                                                                                <th>Stock</th>
                                                                                <th>Imagen</th>
                                                                                <th>Opciones</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($repuestos as $repuesto)
                                                                                <tr>
                                                                                    <td>{{ $repuesto->idRepuesto }}
                                                                                    </td>
                                                                                    <td>{{ $repuesto->descripcion }}
                                                                                    </td>
                                                                                    <td>{{ $repuesto->codigo }}
                                                                                    </td>
                                                                                    <td>{{ $repuesto->stock }}
                                                                                    </td>
                                                                                    <td>
                                                                                        <img width="50"
                                                                                            height="50"
                                                                                            src="{{ asset($repuesto->imagen) }}"
                                                                                            alt="">
                                                                                    </td>
                                                                                    <td>
                                                                                        <button
                                                                                            wire:click='agregarRepuesto({{ $repuesto->idRepuesto }})'
                                                                                            href="#"
                                                                                            type="button"
                                                                                            class="btn btn-sm btn-circle style-success btn-success">
                                                                                            <i
                                                                                                class="fas fa-check"></i>
                                                                                        </button>
                                                                                        <button
                                                                                            wire:click='verProducto({{ $repuesto->idRepuesto }})'
                                                                                            href="#"
                                                                                            type="button"
                                                                                            class="btn btn-sm btn-circle  btn-warning">
                                                                                            <i
                                                                                                class="fas fa-eye"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                        @else
                                                                            <h5>Seleccione un filtro de busqueda</h5>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            @endif
                                                            {{ $repuestos->links() }}
                                                        </div>
                                                    </section>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-dismiss="modal">Cerrar</button>
                                                    @if ($vP)
                                                        <button wire:click='verTablaProducto()' href="#" type="button"
                                                            class="btn btn-sm btn-secondary">
                                                            Volver
                                                        </button>
                                                    @endif
                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                     <input wire:model='searchCodigo' type="text" class="form-control"
                                        placeholder="Buscar por Codigo">
                                    @if (count($repuestoSearch))
                                        <button href="#" type="button" class="btn btn-primary btn-sm"
                                            data-toggle="modal" data-target="#detalle-pieza">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    @else
                                        <button href="#" type="button" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    @endif


                                    <div wire:ignore.self class="modal fade" class="modal fade" id="detalle-pieza"
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header style-info">
                                                    <h5 class="modal-title" id="exampleModalLabel">DETALLE DEL REPUESTO
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
                                                                                        {{ repuesto($pieza->idRepuesto)->precioVenta }}
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
                                                    <button type="button" class="btn btn-info btn-sm"
                                                        data-dismiss="modal">Cerrar</button>
                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input wire:model='cantidadSelect' type="number" class="form-control"
                                        placeholder="Cantidad">
                                    <input wire:model='precioSelect' type="number" class="form-control"
                                        placeholder="Precio">
                                </div>


                            </div>
                        @else
                            <div class="text-center">
                                <h6>
                                    Ningun Almacen ha sido seleccionado...! <i class="fas fa-dolly-empty"></i>
                                </h6>
                            </div>
                        @endif

                        {{-- TABLA --}}
                        <section class="content">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header style-warning">
                                        <h5 class="title">

                                            @if ($idCliente)

                                            <div class="container">
                                                <div class="row align-items-start">
                                                    <div style="font-size: 16px" class="col">
                                                        <h6>
                                                            Cliente:
                                                            {{ @cliente($idCliente)->nombre }}{{ @cliente($idCliente)->apellidos }}
                                                        </h6>
                                                    </div>
                                                    <div class="col"></div>
                                                    <div class="col"></div>
                                                    <h6> Fecha: {{ @fechaHoy() }}</h6>
                                                </div>
                                            </div>

                                            @else
                                                <h6>No se ha seleccionado un cliente</h6>
                                            @endif

                                        </h5>
                                        <div class="card-tools"></div>
                                    </div>
                                    <div class="p-0 m-3 card-body">
                                        @if (count($arrayRepuestos))
                                            <table id="example2" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Repuesto</th>
                                                        <th>Almacen</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio</th>
                                                        <th>Sub Total</th>
                                        
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $length = count($arrayRepuestos); //cantidad
                                                    @endphp
                                                    @for ($i = 0; $i < $length; $i++)
                                                        <tr>
                                                            <td>{{ @repuesto($arrayRepuestos[$i]['idRepuestos'])->id }}
                                                            </td>
                                                            <td>{{ @repuesto($arrayRepuestos[$i]['idRepuestos'])->descripcion }}
                                                            </td>
                                                            {{-- <td>{{ $arrayRepuestos[$i]['descripcion'] }} - {{ @repuestoCategoria( $arrayRepuestos[$i]['idRepuestos'])->categoria  }} </td> --}}
                                                            <td>{{ @almacen($arrayRepuestos[$i]['idAlmacen'])->sigla }}
                                                            </td>
                                                            <td>{{ $arrayRepuestos[$i]['cantidad'] }}</td>

                                                            <td>{{ $arrayRepuestos[$i]['precioVenta'] }}</td>

                                                            <td>{{ $arrayRepuestos[$i]['subTotal'] }}</td>

                                                            
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-sm"
                                                                    data-toggle="modal"
                                                                    data-target="#modificarModal{{ $i }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>

                                                                <div class="modal fade" wire:ignore.self
                                                                    id="modificarModal{{ $i }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="exampleModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header style-success">

                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">Modificar
                                                                                    {{ $arrayRepuestos[$i]['descripcion'] }}
                                                                                    -
                                                                                    {{ @repuestoCategoria($arrayRepuestos[$i]['idRepuestos'])->categoria }}
                                                                                </h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="cantidad">Cantidad</label>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        wire:model='cantidad'
                                                                                        placeholder="{{ $arrayRepuestos[$i]['cantidad'] }}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="precioVenta">Precio
                                                                                        Venta</label>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        wire:model='precio'
                                                                                        placeholder="{{ $arrayRepuestos[$i]['precioVenta'] }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    wire:click="actualizarPrecioStock({{ $i }})"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close"
                                                                                    class="btn btn-success style-success btn-sm">Actualizar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Button eliminar-->
                                                                <button type="button"
                                                                    wire:click='eliminarRepuesto({{ $i }})'
                                                                    class="btn btn-danger btn-sm" data-dismiss="modal"
                                                                    aria-label="Close"><i
                                                                        class="fas fa-times"></i></button>




                                                        </tr>
                                                    @endfor
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>TOTAL :</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th> </th>
                                                        <th>Bs/ {{ $total }}</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            {{-- {{var_dump($arrayRepuestos)}} --}}
                                        @else

                                            <div class="text-center">
                                                <h6>
                                                    No hay Repuestos agregados en este almacen!
                                                </h6>
                                            </div>

                                        @endif

                                    </div>

                                    <!-- /.tabla repuesto. -->
                                </div>
                            </div>
                        </section>
                        @if (count($arrayRepuestos))
                            <button class="btn btn-success btn-sm"
                                wire:click='guardarDetalle({{ auth()->user()->id }})'>Guardar</button>
                        @endif
                    </div>
                </div>
            </div>
        </section>



    @endif

</div>
