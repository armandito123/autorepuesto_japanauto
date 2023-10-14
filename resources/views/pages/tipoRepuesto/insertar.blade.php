<button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#create-tipoRepuesto">
    <i class="fa fas-plus"></i> Nueva SubCategoria</button>
<div id="create-tipoRepuesto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-warning">
                <h5 class="modal-title" id="my-modal-title">Agregar SubCategoria</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tipoRepuesto.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" required placeholder="Escribir SubCategoria" class="form-control" name="tipo">
                        <small id="helpId" class="text-muted">(Campo Obligatorio)</small>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file" required placeholder="" name="imagen" value=""
                                class="form-control form-control-sm">
                        <small id="helpId" class="text-muted">Seleccione una imagen(Campo Obligatorio)</small>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
