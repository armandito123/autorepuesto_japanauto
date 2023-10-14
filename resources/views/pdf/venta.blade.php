
<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif;
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }
        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
        }
        #imagen{
        width: 100px;
        }
        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }
        #encabezado{
        text-align: left;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 15px;
        }
        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        }
        section{
        clear: left;
        }
        #cliente{
        text-align: left;
        }
        #facliente{
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;

        }
        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
        }
        #facliente thead{
        padding: 20px;
        /* background: #2183E3; */
        text-align: left;
        border-bottom: 1px solid #FFFFFF;
        }
        /* #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
        #facvendedor thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
        } */
        #facarticulo{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        border:left;
        text-align: center;
        }
        #facarticulo thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
        }
        #gracias{
        text-align: center;
        }
    </style>
    <body>
        <header>
            <div id="logo">
                {{@empresa('nombre')}}
                 {{-- <img src="img/logo1.png" alt="incanatoIT" id="imagen">  --}}
            </div>
            <div id="datos">
                <p id="encabezado">
                    <b></b>
                    <br>{{empresa('direccion')}}</b>
                    <br>Celular: {{empresa('telefono')}}</b>
                    <br>Correo: {{empresa('email')}} </b>
                </p>
            </div>
            <div id="fact">
            <br>
            <br>
            <h6><b>Nro. Venta: 000{{$notaCompra->id}}</b></h6>

            </div>
        </header>
        <br>
        <section>
            <div>
                <table id="facliente">
                    <thead>
                        <tr>
                            <th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <br>
                        <br>
                        <br>
                            <th><p id="cliente">Sr(a). {{ $proveedor->nombre }} {{ $proveedor->apellidos }}<br>
                            Teléfono: {{ $proveedor->telefono }}<br>
                            Correo: {{ $proveedor->email }}<br>
                            Fecha: {{$notaCompra->fecha}}
                            </p></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <section>
            <div>
                <table id="facarticulo" style="border: solid 1px rgb(206, 190, 190)">
                    <thead>
                        <tr id="fa">
                            <th>CANTIDAD</th>
                            <th>DESCRIPCION</th>
                            <th>PRECIO UNITARIO</th>
                            <th>SUB TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($detalle as $det)
                        <tr>
                            <td>{{$det->cantidad}}</td>
                            <td>{{ @repuesto(repuestoAlmacen($det->idRepuestoAlmacen)->idRepuesto)->descripcion }} {{ @repuesto(repuestoAlmacen($det->idRepuestoAlmacen)->idRepuesto)->marca }} {{ @repuesto(repuestoAlmacen($det->idRepuestoAlmacen)->idRepuesto)->modelo }}</td>
                            <td>{{ @repuesto(repuestoAlmacen($det->idRepuestoAlmacen)->idRepuesto)->precioVenta }}</td>
                            <td>{{$det->subTotal}} .Bs</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th style:='padding:30px'>TOTAL</th>
                            <th>{{$notaCompra->montoTotal}} .Bs</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </section>
        <br>
        <br>
        <footer>
            <div id="gracias">
                <p><b>Gracias por su Compra</b></p>
            </div>
        </footer>
    </body>
</html>
