<a href="#" type="button" class="btn btn-sm btn-success style-success" data-toggle="modal"
    data-target="#update-proveedor{{ $proveedor->id }}">
    <i class="fas fa-edit"></i>
</a>
<div id="update-proveedor{{ $proveedor->id }}" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-success">
                <h5 class="modal-title" id="my-modal-title">Modificar Proveedor</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('proveedor.update', ['id' => $proveedor->id]) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" required name="nombre" value="{{ $proveedor->nombre }}">
                        <small id="helpId" class="text-muted">Escribir Nombre</small>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" required name="apellidos" value="{{ $proveedor->apellidos }}">
                        <small id="helpId" class="text-muted">Escribir Apellidos</small>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" required name="correo" value="{{ $proveedor->correo }}">
                        <small id="helpId" class="text-muted">Escribir Correo</small>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" required name="telefono" value="{{ $proveedor->telefono }}">
                        <small id="helpId" class="text-muted">Digite Telefono </small>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" required name="direccion" value="{{ $proveedor->direccion }}">
                        <small id="helpId" class="text-muted">Escribir Direccion</small>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
