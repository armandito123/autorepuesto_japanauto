<a href="#" type="button" class="btn btn-sm btn-success style-success" data-toggle="modal"
    data-target="#update-cliente{{ $cliente->id }}">
    <i class="fas fa-edit"></i>
</a>
<div id="update-cliente{{ $cliente->id }}" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-warning">
                <h5 class="modal-title" id="my-modal-title">Modificar Cliente</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('cliente.update', ['id' => $cliente->id]) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" required class="form-control form-control-sm" name="nombre" value="{{ $cliente->nombre }}">
                        <small id="helpId" class="text-muted">Escribir Nombre</small>
                    </div>
                    <div class="form-group">
                        <input type="text" required class="form-control form-control-sm" name="apellidos" value="{{ $cliente->apellidos }}">
                        <small id="helpId" class="text-muted">Escribir Apellidos</small>
                    </div>
                    <div class="form-group">
                        <input type="text" required class="form-control form-control-sm" name="telefono" value="{{ $cliente->telefono }}">
                        <small id="helpId" class="text-muted">Digite Telefono</small>

                    </div>
                    <div class="form-group">
                        <input type="email" required class="form-control form-control-sm" name="correo" value="{{ $cliente->correo }}">
                        <small id="helpId" class="text-muted">Escribir Correo</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success style-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
