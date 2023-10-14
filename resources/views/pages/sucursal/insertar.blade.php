<button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#create-sucursal">
    <i class="fa fas-plus"></i> Nueva Sucursal
</button>
<div id="create-sucursal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-warning">
                <h5 class="modal-title" id="my-modal-title">Agregar Sucursal</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('sucursal.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" required placeholder="Escribir Nombre" class="form-control form-control-sm"
                            name="nombre">
                        <small id="helpId" class="text-muted">(Campo Obligatorio)</small>

                    </div>
                    <div class="form-group">
                        <input type="text" required placeholder="Escribir Ubicacion"
                            class="form-control form-control-sm" name="ubicacion">
                        <small id="helpId" class="text-muted">(Campo Obligatorio)</small>

                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
