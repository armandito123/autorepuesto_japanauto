<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar-{{ $marca->id }}">
    <i class="fas fa-trash"></i>
</button>
<div id="eliminar-{{ $marca->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header style-danger">
                <h5 class="modal-title" id="my-modal-title">Eliminar Modelo</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('marca.delete', ['id' => $marca->id]) }}" method="post">
                @csrf
                <div class="modal-body">
                    <p>Seguro que desea eliminar el registro {{ $marca->nombre }} ?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-danger">Aceptar</button>
                    <button type="text" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
