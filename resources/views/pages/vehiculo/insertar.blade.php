<button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#create-vehiculo">
    <i class="fa fas-plus"></i> Nuevo Vehiculo</button>
<div id="create-vehiculo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-warning">
                <h5 class="modal-title" id="my-modal-title">Agregar vehiculo</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('vehiculo.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" required
                            placeholder="Escribir Tipo de Vehiculo" name="tipo">
                        <small class="text-muted">Campo Obligatorio</small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" required
                            placeholder="Escribir Placa del Vehiculo" name="placa">
                        <small class="text-muted">Campo Obligatorio</small>
                    </div>
                    <div class="col-md-13">
                        <div class="form-group">
                            <select class="form-control form-control-sm select2" required name="idRepartidor"
                                style="width: 100%;">
                                @foreach (@repartidores() as $rep)
                                    <option value="{{ $rep->id }}">{{ $rep->nombre }} {{ $rep->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Seleccione un Repartidor</small>

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
