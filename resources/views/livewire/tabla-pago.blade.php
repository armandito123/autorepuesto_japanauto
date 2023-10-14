<div class="container-pago">
    <h1 class="text-center">MI PEDIDO</h1>
    <table id="detalle" class="table table-hover table-bordered">
        <thead class="" >
            <tr style="color:rgb(219, 166, 19)">
                <th>REPUESTO</th>
                <th>MEDIDA</th>
                <th>SUBMEDIDA</th>
                <th>MARCA</th>
                <th>MODELO</th>
                <th>CANTIDAD</th>
                <th>PRECIO </th>
                <th>SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carrito as $car)
                <tr style="background-color:white">
                    <td>{{@repuesto($car->idRepuesto)->descripcion}}</td>
                    <td>{{$car->medida}}</td>
                    <td>{{$car->submedida}}</td>
                    <td>{{@repuesto($car->idRepuesto)->marca}}</td>
                    <td>{{@repuesto($car->idRepuesto)->modelo}}</td>
                    <td>{{$car->cantidad}}</td>
                    <td>{{@repuesto($car->idRepuesto)->precioVenta}}</td>
                    <td>{{@repuesto($car->idRepuesto)->precioVenta * $car->cantidad }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="color:rgb(219, 166, 19)">
                <th colspan="6">TOTAL</th>
                <th colspan="2">
                    <h1 id="total"> Bs/. {{$total}}</h1>
                </th>
            </tr>
        </tfoot>
    </table>
</div>
