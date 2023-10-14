<button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#create-marcaModelo">
    <i class="fa fas-plus"></i> Nueva Marca Modelo</button>
<div id="create-marcaModelo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-warning">
                <h5 class="modal-title" id="my-modal-title">Agregar Marca Modelo</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">

                <form action="{{ route('marcaModelo.store') }}" method="post">
                    @csrf
                    <div class="col-md-12"> <!--Medida-->
                        <div class="form-group">
                            <input type="text" required placeholder="Escribir Medida" class="form-control form-control-sm"
                                name="medida">
                            <small class="text-muted">(Campo Obligatorio)</small>
                        </div>
                    </div>

                    <div class="col-md-12"> <!--subMedida-->
                        <div class="form-group">
                            <input type="text" required placeholder="Escribir SubMedida" class="form-control form-control-sm"
                                name="submedida">
                            <small class="text-muted">(Campo Obligatorio)</small>
                        </div>
                    </div>

                    <div class="form-group col-12"><!--Marcas-->
                        <select class="form-control-sm form-control select2" required name="idMarca" style="width: 100%;">
                            @foreach (@marcas() as $marc)
                                <option value="{{ $marc->id }}">{{ $marc->nombre }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Seleccione una Marca(Campo Obligatorio)</small>

                    </div>

                    <div class="form-group col-12"><!--Modelos-->
                        <select class="form-control form-control-sm select2" name="idModelo" style="width: 100%;">
                            @foreach (@modelos() as $mode)
                                <option value="{{ $mode->id }}">{{ $mode->nombre }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Seleccione un Modelo(Campo Obligatorio)</small>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
