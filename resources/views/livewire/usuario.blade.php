<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h3 class="m-0">Registrar Usuarios</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="card-tools">
                        <button class="btn btn-warning btn-sm" type="button" data-toggle="modal"
                            data-target="#create-usuario">Nuevo Usuario</button>
                        <div wire:ignore.self class="modal fade" id="create-usuario" class="modal fade" tabindex="-1"
                            role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header style-warning">
                                        <h5 class="modal-title" id="my-modal-title">Agregar Usuario</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Escribiri Usuario" required wire:model="name">
                                            <small class="text-muted">Campo Obligatorio</small>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-sm"
                                                placeholder="Escribir Correo" required wire:model="email">
                                            <small class="text-muted">Campo Obligatorio</small>

                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-sm"
                                                placeholder="Escribiri Password" required wire:model="password">
                                            <small class="text-muted">Campo Obligatorio</small>

                                        </div>
                                        <div class="form-group col-12">
                                            <select class="form-control form-control-sm" required wire:model="rol"
                                                style="width: 100%;">
                                                <option value="cliente">Cliente</option>
                                                <option value="repartidor">Repartidor</option>
                                            </select>
                                            <small class="text-muted">Seleccione un Rol</small>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Escribiri Nombre" required wire:model="nombre">
                                            <small class="text-muted">Campo Obligatorio</small>

                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Escribiri Apellidos" required wire:model="apellidos">
                                            <small class="text-muted">Campo Obligatorio</small>

                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Escribiri Telefono" required wire:model="telefono">
                                            <small class="text-muted">Campo Obligatorio</small>

                                        </div>
                                        @if ($rol == 'repartidor')
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Escribiri Nombre" required wire:model="numeroLicencia">
                                                <small class="text-muted">Campo Obligatorio</small>

                                            </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success btn-sm"
                                            wire:click='guardarUsuario'>Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="style-warning">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Rol</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->id }}</td>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>{{ $usuario->rol }}</td>


                                        <td>
                                            <button class="btn btn-success style-success btn-sm" data-toggle="modal"
                                                data-target="#update-{{ $usuario->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <div id="update-{{ $usuario->id }}" wire:ignore.self class="modal fade"
                                                tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-header style-warning">
                                                            <h5 class="modal-title" id="my-modal-title">Modificar
                                                                Usuario</h5>
                                                            <button class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">

                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-sm"
                                                                    required wire:model="name"
                                                                    placeholder=" {{ $usuario->name }}">
                                                                <small class="text-muted">Escribiri Nombre (Campo Obligatorio)</small>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="email" class="form-control form-control-sm"
                                                                    placeholder="{{ usuario($usuario->id)->email }}" required
                                                                    wire:model="email">
                                                                <small class="text-muted">Escribir Correo (Campo Obligatorio)</small>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="password"
                                                                    class="form-control form-control-sm"
                                                                    placeholder="**************************" required
                                                                    wire:model="password">
                                                                <small class="text-muted">Escribir Password (Campo Obligatorio)</small>
                                                            </div>

                                                            @if ($usuario->rol != 'admin')
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm"
                                                                        @if ($usuario->rol == 'repartidor')
                                                                        placeholder="{{ repartidor($usuario->id)->nombre }}"
                                                                        @endif
                                                                        @if ($usuario->rol == 'cliente')
                                                                        placeholder="Cliente"
                                                                        @endif
                                                                        required
                                                                        wire:model="nombre">
                                                                    <small class="text-muted">Escribir Nombre(Campo Obligatorio)</small>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm"
                                                                        @if ($usuario->rol == 'repartidor')
                                                                        placeholder="{{ repartidor($usuario->id)->apellidos }}"
                                                                        @endif
                                                                        @if ($usuario->rol == 'cliente')
                                                                        placeholder="{{ cliente($usuario->id)->apellidos }}"
                                                                        @endif
                                                                        required
                                                                        wire:model="apellidos">
                                                                    <small class="text-muted">Escribir Apellidos (Campo Obligatorio)</small>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm"
                                                                        @if ($usuario->rol == 'repartidor')
                                                                        placeholder="{{ repartidor($usuario->id)->telefono }}"
                                                                        @endif
                                                                        @if ($usuario->rol == 'cliente')
                                                                        placeholder="{{ cliente($usuario->id)->telefono }}"
                                                                        @endif
                                                                        required
                                                                        wire:model="telefono">
                                                                    <small class="text-muted">Escribir Telefono (Campo Obligatorio)</small>
                                                                </div>

                                                                @if ($usuario->rol == 'repartidor')
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                            class="form-control form-control-sm"
                                                                            placeholder="{{ repartidor($usuario->id)->numeroLicencia }}"
                                                                            placeholder="" required
                                                                            wire:model="numeroLicencia">
                                                                        <small class="text-muted">Escribir Numero Licencia (Campo Obligatorio)</small>
                                                                    </div>
                                                                @endif
                                                            @endif

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                wire:click='updateUsuario({{$usuario->id}})'
                                                                class="btn btn-success style-success">
                                                                Actualizar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <button class="btn btn-danger btn-sm-carrito" data-toggle="modal"
                                                data-target="#eliminar-{{ $usuario->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                            <div wire:ignore.self id="eliminar-{{ $usuario->id }}" class="modal fade"
                                                tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header style-danger">
                                                            <h5 class="modal-title" id="my-modal-title">Eliminar
                                                                Categoria</h5>
                                                            <button class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="{{ route('usuario.delete', ['id' => $usuario->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <p>¿Desea eliminar el registro
                                                                    {{ usuario($usuario->id)->name }}
                                                                    ?

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-success">Aceptar</button>
                                                                <button type="text" class="btn btn-danger"
                                                                    data-dismiss="modal">Cancelar</button>
                                                            </div>
                                                        </form>
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
            {{ $usuarios->links() }}
        </div>
    </section>
</div>
