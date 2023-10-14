<a href="#" type="button" class="btn btn-sm style-success btn-success" data-toggle="modal"
    data-target="#update-marca{{ $marca->id }}">
    <i class="fas fa-edit"></i>
</a>
<div id="update-marca{{ $marca->id }}" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-warning">
                <h5 class="modal-title" id="my-modal-title">Modificar Marca</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('marca.update', ['id' => $marca->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input required type="text" class="form-control form-control-sm" name="nombre" value="{{ $marca->nombre }}">
                        <small id="helpId" class="text-muted">Escribir Nombre (campo obligatorio)</small>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input required type="file" name="imagen" class="form-control form-control-sm">
                            <small id="helpId" class="text-muted">Seleccione una imagen (Campo obligatorio)</small>
                        </div>
                    </div>
                    <img src="{{ asset($marca->logo) }}" width="100" height="100" alt="">
                    <small id="helpId" class="text-muted">imagen actual (Al guardar se actualizara la imagen)</small>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success style-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
