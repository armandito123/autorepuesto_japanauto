<div>
    <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#create-usuario">Agregar Usuario</button>
    <div wire:ignore.self class="modal fade" id="create-usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header alert-default-info">
                    <h5 class="modal-title" id="my-modal-title">Agregar Usuario</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Usuario</label>
                        <input type="text" class="form-control" wire:model="name" >
                    </div>
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="text" class="form-control" wire:model="email" >
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="text" class="form-control" wire:model="password" >
                    </div>
                    <div class="form-group col-12">
                        <label>Rol</label>
                        <select class="form-control" wire:model="rol" style="width: 100%;">
                                <option value="cliente">Cliente</option>
                                <option value="repartidor">Repartidor</option>
                        </select>
                    </div>
                    {{-- --- --}}

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" wire:model="nombre" >
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" wire:model="apellidos" >
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control" wire:model="telefono" >
                    </div>
                    @if ($rol=='repartidor')
                        <div class="form-group">
                            <label for="numeroLicencia">Numero de Licencia</label>
                            <input type="text" class="form-control" wire:model="numeroLicencia" >
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-sm" wire:click='guardarUsuario'>Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
