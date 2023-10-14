<a href="#" type="button" class="btn btn-sm btn-success style-success" data-toggle="modal"
    data-target="#update-modelo{{ $modelo->id }}">
    <i class="fas fa-edit"></i>
</a>
<div id="update-modelo{{ $modelo->id }}" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-warning">
                <h5 class="modal-title" id="my-modal-title">Modificar Modelo</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('modelo.update', ['id' => $modelo->id]) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" required class="form-control form-control-sm" name="nombre"
                            value="{{ $modelo->nombre }}">
                        <small id="helpId" class="text-muted">Escribir Nombre del Modelo (campo obligatorio)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm style-success btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
