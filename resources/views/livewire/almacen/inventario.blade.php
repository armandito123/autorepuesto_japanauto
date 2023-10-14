<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h3 class="m-0">Inventario</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Inventario</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @if ($transferir)
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card">
                        <div class="card-header style-warning">
                            <h5 class="card-title">
                                Transferir Repuesto
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="card-group">

                                {{-- origen --}}
                                <div class="card">
                                    <div class="card-header style-warning">
                                        <h5 class="card-title">{{$siglaOrigen}}</h5>
                                        <div class="card-tools">

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="input-group">
                                            <select name="idAlmacenOrigen" id="idAlmacenOrigen" class="form-control form-control-sm" wire:model='idAlmacenOrigen'>
                                                @if ($estadoOrigen)
                                                @else
                                                    <option value="">Seleccione Almacen</option>
                                                @endif
                                                @foreach (almacenes() as $almacen)
                                                    @if ($idAlmacenDestino != $almacen->id)
                                                        <option value="{{$almacen->id}}">{{$almacen->sigla}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="pt-4 table-responsive">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Stock</th>
                                                        <th>Imagen</th>
                                                        <th>Descripcion</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (buscarRepuestoAlmacenStock($idAlmacenOrigen) as $repuestoAlmacen)
                                                        <tr>
                                                            <td>{{$repuestoAlmacen->id}}</td>
                                                            <td>{{$repuestoAlmacen->stock}}</td>
                                                            <td><img src="{{ asset($repuestoAlmacen->imagen) }}" width="60" height="60" alt=""></td>
                                                            <td>{{$repuestoAlmacen->descripcion}}</td>
                                                            <td>
                                                                @if ($idAlmacenDestino)
                                                                    <button type="button" data-toggle="modal" data-target="#añadir-repuesto{{$repuestoAlmacen->id}}" class="btn btn-sm btn-success style-success btn-circle" >
                                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                                    </button>
                                                                    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="añadir-repuesto{{$repuestoAlmacen->id}}">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header style-success">
                                                                                    <h5 class="card-title">Transferir Repuesto</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="card-group">
                                                                                        <div class="card">
                                                                                            <div class="card-body">
                                                                                                <img src="{{asset($repuestoAlmacen->imagen)}}" alt="" width="100" height="100">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card">
                                                                                            <div class="card-body">
                                                                                                <div class="border row justify-content-center align-items-center">
                                                                                                    Almacen de destino
                                                                                                </div>
                                                                                                <div class="border row justify-content-center align-items-center">
                                                                                                    <div class="m-5 align-items-center justify-content-center">
                                                                                                        <span style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 39px; font-weight: 900 ">
                                                                                                            {{$siglaDestino}}
                                                                                                        </span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    @if ($estadoInput)
                                                                                        <div class="input-group">
                                                                                            @if ($estadoDisponible)
                                                                                                <button class="btn btn-sm btn-info">Disponible : {{$repuestoAlmacen->stock}}</button>
                                                                                            @else
                                                                                                <button class="btn btn-sm btn-danger">Disponible : {{$repuestoAlmacen->stock}}</button>
                                                                                            @endif

                                                                                            <input type="number" wire:model='cantidad' class="form-control form-control-sm" placeholder="Digitar Cantidad">
                                                                                            <button class="btn btn-sm btn-success style-success" data-dismiss="modal" aria-label="Close" wire:click='transferirRepuesto'><i class="fa fa-check"></i></button>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" aria-label="Close">
                                                                                        Cerrar
                                                                                    </button>
                                                                                    <button type="button" wire:click="mostrarInput({{$repuestoAlmacen->id}},)" class="btn btn-sm btn-success style-success">Transferir</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <button type="button"  class="btn btn-sm btn-secondary btn-circle" >
                                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                                    </button>
                                                                @endif

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                {{-- Destino --}}
                                <div class="card">
                                    <div class="card-header style-info">
                                        <h5 class="card-title">{{$siglaDestino}}</h5>


                                    </div>
                                    <div class="card-body">
                                        <div class="input-group">

                                            <select name="idAlmacenDestino" id="idAlmacenDestino" class="form-control form-control-sm" wire:model='idAlmacenDestino'>
                                                @if ($estadoDestino)
                                                @else
                                                    <option value="">Seleccione Almacen</option>
                                                @endif
                                                @foreach (almacenes() as $almacen)
                                                    @if ($idAlmacenOrigen != $almacen->id)
                                                        <option value="{{$almacen->id}}">{{$almacen->sigla}}</option>
                                                    @endif
                                                @endforeach

                                            </select>

                                            {{$idAlmacenDestino}}
                                        </div>

                                        <div class="pt-4 table-responsive">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Stock</th>
                                                        <th>Imagen</th>
                                                        <th>Descripcion</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (buscarRepuestoAlmacenStock($idAlmacenDestino) as $repuestoAlmacen)
                                                        <tr>
                                                            <td>{{$repuestoAlmacen->id}}</td>
                                                            <td>{{$repuestoAlmacen->stock}}</td>
                                                            <td><img src="{{asset($repuestoAlmacen->imagen)}}" width="60" height="60" alt=""></td>
                                                            <td>{{$repuestoAlmacen->descripcion}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('repuestoAlmacen.create') }}" class="btn btn-warning btn-sm">Agregar Repuesto</a>
                        <button type="button" class="btn btn-sm btn-secondary" wire:click='verTransferencia'>Transferir
                            Repuesto</button>
                        <h3 class="card-title"></h3>
                        <div class="card-tools">
                            <form>
                                <div class="input-group-prepend">
                                    <select name="" id="" wire:model='searchText' class="form-control form-control-sm">
                                        @if ($searchText == '')
                                            <option value="">Seleccione un almacen</option>
                                        @endif
                                        @foreach (almacenes() as $item)
                                            <option value="{{ $item->sigla }}">Almacen {{ $item->sigla }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input  type="text" class="form-control" name="searchText" placeholder="Buscar..." > --}}

                                    <button disabled class="btn btn-info btn-sm" type="button"><i
                                            class="fas fa-search"></i></button>
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
                                        <th>Repuesto</th>
                                        <th>Categoria</th>
                                        <th>Marca Modelo</th>
                                        <th>SubCategoria</th>
                                        <th>Almacen</th>
                                        <th>stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($repuestoAlmacenes as $repuestoAlmacen)
                                        <tr>
                                            <td>{{ $repuestoAlmacen->id }}</td>
                                            <td>{{ $repuestoAlmacen->repuesto }}</td>
                                            <td>{{ $repuestoAlmacen->categoria }}</td>
                                            <td>{{ $repuestoAlmacen->marca }} - {{ $repuestoAlmacen->modelo }}</td>
                                            <td>{{ $repuestoAlmacen->tipo }}</td>
                                            <td>{{ $repuestoAlmacen->almacen }}</td>
                                            <td>{{ $repuestoAlmacen->stock }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $repuestoAlmacenes->render() }}
            </div>
            <!--/. container-fluid -->
        </section>
    @endif

</div>
