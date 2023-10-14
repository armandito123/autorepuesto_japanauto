<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#create-cliente">
    <i class="fas fa-plus"></i>
    Nuevo Proveedor
</button>
<div id="create-cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-info">
                <h5 class="modal-title" id="my-modal-title">Agregar Proveedor</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('proveedor.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" placeholder="Escribir Nombre" class="form-control form-control-sm"
                            required name="nombre">
                        <small id="helpId" class="text-muted">Campo Obligatorio</small>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Escribir Apellidos" class="form-control form-control-sm"
                            required name="apellidos">
                        <small id="helpId" class="text-muted">Campo Obligatorio</small>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Escribir Correo" class="form-control form-control-sm"
                            required name="correo">
                        <small id="helpId" class="text-muted">Campo Obligatorio</small>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Digite Telefono" class="form-control form-control-sm"
                            required name="telefono">
                        <small id="helpId" class="text-muted">Campo Obligatorio</small>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Escribir direccion" class="form-control form-control-sm"
                            required name="direccion">
                        <small id="helpId" class="text-muted">Campo Obligatorio</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
