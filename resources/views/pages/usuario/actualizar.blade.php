<a href="#" type="button" class="btn btn-sm btn-success style-success" data-toggle="modal"
    data-target="#update-usuario{{ $usuario->id }}">
    <i class="fas fa-edit"></i>
</a>
<div id="update-usuario{{ $usuario->id }}" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-warning">
                <h5 class="modal-title" id="my-modal-title">Modificar usuario</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('usuario.update', ['id' => $usuario->id]) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">usuario</label>
                        <input type="text" class="form-control" name="name" value="{{ $usuario->name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="text" class="form-control" name="email" value="{{ $usuario->email }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="text" class="form-control" name="password" value="{{ $usuario->password }}">
                    </div>
                    <input type="hidden" class="form-control" name="rol" value="{{ $usuario->rol }}">

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{ $usuario->nombre }}">
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos" value="{{ $usuario->apellidos }}">
                    </div>

                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control" name="telefono" value="{{ $usuario->telefono }}">
                    </div>

                    @if ($usuario->rol)
                        <div class="form-group">
                            <label for="numeroLicencia">Numero de Licencia</label>
                            <input type="text" class="form-control" name="numeroLicencia"
                                value="{{ $usuario->numeroLicencia }}">
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
