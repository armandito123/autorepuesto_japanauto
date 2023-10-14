<a href="#" type="button" class="btn style-success btn-sm btn-success" data-toggle="modal"
    data-target="#update-tipoRepuesto{{ $tipoRepuesto->id }}">
    <i class="fas fa-edit"></i>
</a>
<div id="update-tipoRepuesto{{ $tipoRepuesto->id }}" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-warning">
                <h5 class="modal-title" id="my-modal-title">Modificar SubCategoria</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tipoRepuesto.update', ['id' => $tipoRepuesto->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="tipo" value="{{ $tipoRepuesto->tipo }}">
                        <small id="helpId" class="text-muted">Escribir SubCategoria(Campo Obligatorio)</small>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file" name="imagen" value="" class="form-control form-control-sm">
                            <small id="helpId" class="text-muted">Seleccione una imagen(Campo Obligatorio)</small>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm style-success btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
