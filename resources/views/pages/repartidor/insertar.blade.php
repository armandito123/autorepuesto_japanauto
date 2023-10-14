<button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#create-cliente">
    <i class="fa fas-plus"></i> Nuevo Repartidor
</button>
<div id="create-cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-warning">
                <h5 class="modal-title" id="my-modal-title">Agregar Repartidor</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('repartidor.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" required placeholder="Escribir Nombre" class="form-control form-control-sm"
                            name="nombre">
                        <small id="helpId" class="text-muted">(Campo Obligatorio)</small>

                    </div>
                    <div class="form-group">
                        <input type="text" required placeholder="Escribir Apellidos"
                            class="form-control form-control-sm" name="apellidos">
                        <small id="helpId" class="text-muted">(Campo Obligatorio)</small>

                    </div>
                    <div class="form-group">
                        <input type="email" required placeholder="Escribir Correo" class="form-control form-control-sm"
                            name="correo">
                        <small id="helpId" class="text-muted">(Campo Obligatorio)</small>

                    </div>
                    <div class="form-group">
                        <input type="text" required placeholder="Digitar Telefono" class="form-control form-control-sm"
                            name="telefono">
                        <small id="helpId" class="text-muted">(Campo Obligatorio)</small>

                    </div>
                    <div class="form-group">
                        <input type="text" required placeholder="Digitar Numero de Licencia" class="form-control form-control-sm"
                            name="numeroLicencia">
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
