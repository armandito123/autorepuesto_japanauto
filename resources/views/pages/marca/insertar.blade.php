<button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#create-marca">
    <i class="fa fas-plus"></i> Agregar Marca
</button>
<div id="create-marca" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-warning">
                <h5 class="modal-title" id="my-modal-title">Agregar Marca</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('marca.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" placeholder="Escribir Nombre" required class="form-control form-control-sm" name="nombre">
                        <small id="helpId" class="text-muted">Escribir Nombre (campo obligatorio)</small>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file" required name="imagen" value="" class="form-control form-control-sm">
                            <small id="helpId" class="text-muted">Seleccione una imagen (Campo obligatorio)</small>

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
