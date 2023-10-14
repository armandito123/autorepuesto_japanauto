
@role('cliente')
@livewire('web-detalle-carrito',[
    "idCliente" => Auth::user()->id
])
@endrole
