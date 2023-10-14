<a href="#" type="button" class="btn btn-sm btn-success style-success" data-toggle="modal"
    data-target="#update-repartidor{{ $repartidor->id }}">
    <i class="fas fa-edit"></i>
</a>
<div id="update-repartidor{{ $repartidor->id }}" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-warning">
                <h5 class="modal-title" id="my-modal-title">Modificar Repartidor</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('repartidor.update', ['id' => $repartidor->id]) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">

                        <input type="text" required class="form-control form-control-sm" name="nombre" value="{{ $repartidor->nombre }}">
                        <small id="helpId" class="text-muted">Escribir Nombre (Campo Obligatorio)</small>
                    </div>
                    <div class="form-group">
                        <input type="text" required class="form-control form-control-sm" name="apellidos" value="{{ $repartidor->apellidos }}">
                        <small id="helpId" class="text-muted">Escribir Apellidos (Campo Obligatorio)</small>

                    </div>
                    <div class="form-group">
                        <input type="text" required class="form-control form-control-sm" name="correo" value="{{ $repartidor->correo }}">
                        <small id="helpId" class="text-muted"> Escribir Correp(Campo Obligatorio)</small>

                    </div>
                    <div class="form-group">
                        <input type="text" required class="form-control form-control-sm" name="telefono" value="{{ $repartidor->telefono }}">
                        <small id="helpId" class="text-muted">Digitar telefono (Campo Obligatorio)</small>

                    </div>
                    <div class="form-group">
                        <input type="text" required class="form-control form-control-sm" name="numeroLicencia"
                            value="{{ $repartidor->numeroLicencia }}">
                        <small id="helpId" class="text-muted">Digitar Numero de Licencia (Campo Obligatorio)</small>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
