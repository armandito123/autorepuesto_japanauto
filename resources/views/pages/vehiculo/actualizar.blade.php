<a href="#" type="button" class="btn style-success btn-sm btn-success" data-toggle="modal"
    data-target="#update-vehiculo{{ $vehiculo->id }}">
    <i class="fas fa-edit"></i>
</a>
<div id="update-vehiculo{{ $vehiculo->id }}" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-warning">
                <h5 class="modal-title" id="my-modal-title">Modificar vehiculo</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('vehiculo.update', ['id' => $vehiculo->id]) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" value="{{$vehiculo->tipo}}" required name="tipo">
                        <small class="text-muted">Escribir Tipo de Vehiculo</small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" value="{{$vehiculo->placa}}" required name="placa">
                        <small class="text-muted">Escribir Placa de Vehiculo</small>
                    </div>
                    <div class="form-group">
                        <select class="select2 form-control-sm" required style="width: 100%">
                            @foreach (@repartidores() as $rep)
                                <option value="{{ $rep->id }}">{{ $rep->nombre }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Seleccionar Repartidor</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn style-success btn-sm btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
