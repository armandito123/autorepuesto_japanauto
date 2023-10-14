<button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#create-modelo">
    <i class="fa fas-plus"></i> Nuevo Modelo
</button>
<div id="create-modelo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-warning">
                <h5 class="modal-title" id="my-modal-title">Agregar Modelo</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('modelo.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" required class="form-control form-control-sm" name="nombre">
                        <small id="helpId" class="text-muted">Escribir Nombre del Modelo (campo obligatorio)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
