<a href="#" type="button" class="btn btn-sm style-success btn-success" data-toggle="modal"
    data-target="#update-almacen{{ $almacen->id }}">
    <i class="fas fa-edit"></i>
</a>
<div id="update-almacen{{ $almacen->id }}" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-warning">
                <h5 class="modal-title" id="my-modal-title">Modificar Almacen</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('almacen.update', ['id' => $almacen->id]) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" required class="form-control form-control-sm" name="sigla"
                            value="{{ $almacen->sigla }}">
                        <small id="helpId" class="text-muted">Escriba Sigla - Almacen</small>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn style-success btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
