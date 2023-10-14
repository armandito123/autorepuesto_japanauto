<a href="#" type="button" class="btn btn-sm btn-success" data-toggle="modal"
    data-target="#update-repartidor{{ $repartidor->id }}">
    <i class="fas fa-eye"></i>
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
                        <label for="nombre">Repartidor</label>
                        <input type="text" class="form-control" name="nombre" value="{{ $repartidor->nombre }}">
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos" value="{{ $repartidor->apellidos }}">
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="text" class="form-control" name="correo" value="{{ $repartidor->correo }}">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control" name="telefono" value="{{ $repartidor->telefono }}">
                    </div>
                    <div class="form-group">
                        <label for="numeroLicencia">Numero de Licencia</label>
                        <input type="text" class="form-control" name="numeroLicencia"
                            value="{{ $repartidor->numeroLicencia }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
