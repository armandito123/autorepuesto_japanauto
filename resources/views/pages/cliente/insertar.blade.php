<button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#create-cliente">
    <i class="fas fa-plus"></i> Nuevo Cliente
</button>
<div id="create-cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-warning">
                <h5 class="modal-title" id="my-modal-title">Agregar Cliente</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('cliente.store') }}" method="post">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" placeholder="Escribir Nombre" class="form-control form-control-sm"
                            name="nombre">
                        <small id="helpId" class="text-muted">Campo Obligatorio</small>
                    </div>

                    <div class="form-group">
                        <input type="text" placeholder="Escribir Apellidos " class="form-control form-control-sm"
                            name="apellidos">
                        <small id="helpId" class="text-muted">Campo Obligatorio</small>
                    </div>

                    <div class="form-group">
                        <input type="email" placeholder="Escriba el correo" class="form-control form-control-sm"
                            name="correo">
                        <small id="helpId" class="text-muted">Campo Obligatorio</small>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="digite el telefono" class="form-control form-control-sm"
                            name="telefono">
                        <small id="helpId" class="text-muted">Campo Obligatorio</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
