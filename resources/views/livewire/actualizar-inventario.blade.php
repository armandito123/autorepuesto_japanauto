<div>
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modificarModal">
        <i class="fas fa-edit"></i>
    </button>

    <div class="modal fade"  wire:ignore.self  id="modificarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modificar </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control"  placeholder="{{$arrayRepuestos['cantidad']}}">
                    </div>

                    <div class="form-group">
                        <label for="precioVenta">Precio Venta</label>
                        <input type="number" class="form-control" placeholder="{{$arrayRepuestos['precioVenta']}}">
                    </div>

                    {{-- <div class="form-group">
                        <label for="precioCompra">Precio Compra</label>
                        <input type="number" class="form-control" placeholder="{{$arrayRepuestos['precioCompra']}}">
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success">Actualizar</button>
                </div>
            </div>
        </div>
    </div> 
</div>
