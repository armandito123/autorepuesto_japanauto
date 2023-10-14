<a href="#" type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#update-almacen{{ $almacen->id }}">
    <i class="fas fa-edit"></i>
</a>
<div id="update-almacen{{ $almacen->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert-default-success">
                <h5 class="modal-title" id="my-modal-title">Modificar Almacen</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('almacen.update',['id'=>$almacen->id]) }}" method="post">
                @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="sigla">almacen</label>
                    <input type="text" class="form-control" name="sigla" value="{{ $almacen->sigla }}" >
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success">Actualizar</button>
            </div>
            </form>
        </div>
    </div>
</div>