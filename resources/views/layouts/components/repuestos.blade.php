<script>
    var arrayRepuestos = [];
    var arrayCantidad = [];
    var arraySubTotal = [];
    var arrayMedida = [];
    var cantidad = 0;
    var medida = 0;
    var c = 0;
    var total = 0;

    function marcaDato(marca){

        document.getElementById('repuestos').innerHTML ='';
        var repuesto ;
        var fila = ``;
        url = '/web/marca?id=' + marca ;
        axios.get(url).then(function(response){
            console.log(response.data.marca[1].id);
            data = response.data.marca;
            marca =response.data.marca[0];
            console.log()
            for (let index = 0; index < response.data.marca.length; index++) {
                fila = `
                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap">
                        <img src="${data[index].imagen}" with="200" height="200" class="img-fluid" alt="">
                            <div class="portfolio-info">

                                <h4>Medida</h4>
                                <p>${data[index].imagen}</p>
                                <h4>SubMedida</h4>
                                <p></p>
                                <h4>Categoria</h4>
                                <p></p>
                                <h4>Repuesto</h4>
                                <p></p>
                                <h4>Precio</h4>
                                <p></p>
                                <div class="portfolio-links">
                                    <!-- Button trigger modal -->

                                    <a data-toggle="modal" data-target="#exampleModal" href="" onclick="seleccionarRepuesto(${data[index].id})"  data-gall="portfolioGallery" class="venobox" title="App 3"><i class="icofont-eye"></i></a>
                                    <a  href="portfolio-details.html" title="More Details"><i class="icofont-external-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $("#repuestos").append(fila);
            }
        });
    }

    function seleccionarRepuesto(id){
        url = '/web/buscarRepuesto?id=' + id ;
        axios.get(url).then((response) => {
            console.log(response);
            console.log(response.data);
            console.log(response.data.repuesto);
            console.log(response.data.repuesto[0]);
            repuesto = response.data.repuesto[0];


            Swal.fire({
            title: 'Digite una cantidad',
            text: 'Modal with a custom image.',



            html: `
                <img src="${repuesto.imagen}" with="200" height="200" class="img-fluid" alt="">
                <input type="number" id="cantidad" class="swal2-input form-control" placeholder="Cantidad">
                <input type="text" id="medida" class="swal2-input form-control" placeholder="Medida">
                `,
            confirmButtonText: 'Añadir',
            focusConfirm: false,
            preConfirm: () => {
                this.cantidad = Swal.getPopup().querySelector('#cantidad').value;
                var cantidad = parseInt(this.cantidad)
                this.medida = Swal.getPopup().querySelector('#medida').value;
                var subTotal = cantidad * repuesto.precioVenta;



                this.arrayRepuestos.push(repuesto.id);
                this.arrayCantidad.push(cantidad);
                this.arrayMedida.push(this.medida);
                alert(this.arrayMedida);

                this.arraySubTotal.push(subTotal);
                this.añadirRepuesto(repuesto.id,c,cantidad,subTotal,medida)
                if (!cantidad  && cantidad <= 0) {
                Swal.showValidationMessage(`por favor ingrese una cantidad valida`)
                }
                return { cantidad: cantidad }
            }
            }).then((result) => {
            Swal.fire(`
                Añadido al Carrito!
            `.trim())
            })
        });

    }
    function añadirRepuesto(id,c,cantidad,subTotal,medida){

        url = '/web/buscarRepuesto?id=' + id ;
        axios.get(url)
        .then((response) => {
            repuesto = response.data.repuesto[0];
            var fila = `<tr class="selected" id="fila${c}">
                                <td><button type="button" class="btn btn-outline-warning" onclick="eliminar(${c});">X</button></td>
                                <td>${repuesto.descripcion}</td>
                                <td><input type="number" min="0" step="1" id="${c}" readonly value="${cantidad}" class="form-control"></td>
                                <td><input type="text" min="0" step="1" id="${c}" readonly value="${medida}" class="form-control"></td>
                                <td><input type="number" readonly name="precio[]" value="${repuesto.precioVenta}"  class="form-control"></td>
                                <td>${subTotal}</td>
                        </tr>
                    `;
                    $("#detalle").append(fila);

                this.total =  this.total + subTotal;
                var montoTotal = `
                    <input type="hidden" name="montoTotal" value="${total}">
                `;

                $("#total").html("Bs/. " + total);
                $("#total").append(montoTotal)
                this.c++;

        });



    }

    function guardarDatos(id){
        h = new Date();


        let url = '/guardar/pedido';

        longitud = document.getElementById("textlongitud").value;
        distancia = document.getElementById("textDistancia").value;
        tiempo = document.getElementById("textTiempo").value;
        latitud = document.getElementById("textlatitud").value;
        link = document.getElementById("textlink").value;
        referencia = document.getElementById('input-referencia').value;

        alert(h.getHours());
        alert(tiempo);
        h.setHours(h.getHours()+tiempo);
        alert(h.getHours());




        data = {
                        'idCliente'  : id,
                        'longitud'   : longitud,
                        'latitud'    : latitud,
                        'tiempo'     : tiempo,
                        'distancia'  : distancia,
                        'link'       : link,
                        'referencia' : referencia,
                        'arrayRepuesto'  : this.arrayRepuesto,
                        'arrayCantidad' : this.arrayCantidad,
                        'arraySubTotal' : this.arraySubTotal,
                        'arrayMedida'    : this.arrayMedida,
                        'total'         : this.total,
                        'c'             : this.c
        }

        axios.post(url,data)
        .then(res => {
            console.log(this.c);
            this.arrayRepuesto  = [],
            this.arrayCantidad = [],
            this.arraySubTotal = [],
            this.arrayMedida    = [],
            this.calcularTotal();
            this.total = 0;
            console.log(res);
        })
        .catch(err => {
            console.error(err);
        })
        // alert(id)
        // alert(longitud);
        // alert(latitud);
        // alert(distancia);
        // alert(tiempo);
        // alert(link);
        // alert(referencia);
        // alert(this.arrayRepuestos);
        // alert(this.arrayCantidad);
        // alert(this.arraySubTotal);
        // alert(this.arrayMedida);
    }
    function eliminarRepuesto(index){
        this.arraySubTotal.splice(index,1);
        this.arrayRepuestos.splice(index,1);
        this.arrayCantidad.splice(index,1);
    }

    function mostrarMapa(){

        Swal.fire(
        'Donde podemos localizarte?',
        'Envianos tu ubicacion',
        'question'
        );



        document.getElementById('btn-guarda').style.display         = 'none';
        document.getElementById('enviar-ubicacion').style.display         = 'block';


    }
    function eliminar(index){

        index++;
        console.log(index);
        console.log(this.arraySubTotal);
        console.log(this.arrayRepuestos);
        console.log(this.arrayCantidad);
        console.log("    ");
        console.log(this.total);
        document.getElementById("detalle").deleteRow(index);

        this.eliminarRepuesto();
        this.calcularTotal();

        console.log(this.arraySubTotal);
        console.log(this.arrayRepuestos);
        console.log(this.arrayCantidad);

        $("#total").html("Bs/. " + total);

    }
    function calcularTotal(){
        this.total = 0;
        for (let index = 0; index < this.arraySubTotal.length; index++) {
            this.total = arraySubTotal[index];
        }
    }

    // function finalizar() {
    //       alert('buu')
    // }




    var marker;
    var coords = {lng:-17.3385438, lat:-63.2710036};//ojo cambiar coordenadas
    var x=document.getElementById("nomDir");
    var options = {
    enableHighAccuracy: true,
    timeout: 6000,
    maximumAge: 0
    };
    //Funcion principal
    initMap = function () {

        // navigator.geolocation.getCurrentPosition(viewMap,ViewError,{timeout:3000});

        //usamos la API para geolocalizar el usuario

            navigator.geolocation.getCurrentPosition(function (position){
                coords =  {
                lng: position.coords.longitude,
                lat: position.coords.latitude,
                };
                document.getElementById("longitud").value = position.coords.longitude;
                document.getElementById("latitud").value = position.coords.latitude;

                setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa


            },function(error){

                // El segundo parámetro es la función de error
                switch(error.code)
                {
                    case error.PERMISSION_DENIED:
                    // El usuario denegó el permiso para la Geolocalización.
                    console.log(error);
                    alert('ACTIVE SU GPS O USTED BLOQUEO EL PERMISO DE UBICACION');
                    // initMap();
                    break;
                    case error.POSITION_UNAVAILABLE:
                    // La ubicación no está disponible.
                    console.log(error);
                        alert('ACTIVE SU GPS Y RECARGE LA PAGINA');
                    break;
                    case error.TIMEOUT:
                    // Se ha excedido el tiempo para obtener la ubicación.
                    console.log(error);
                        alert('ACTIVE SU GPS Y RECARGE LA PAGINA');
                    break;
                    case error.UNKNOWN_ERROR:
                    // Un error desconocido.
                    alert('INTENTE MÁS TARDE');
                    console.log(error);
                    break;
                }
                coords =  {
                    lng: '-17.3385438', //-17.34981426967225 <--por defecto
                    lat: '-63.2710036'//-63.262442186041355 <--por defecto
                };

                document.getElementById("longitud").value = '-17.3385438';
                document.getElementById("latitud").value =  '-63.2710036';
                setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa


            },options);

    }
    function setMapa (coords){

            //Se crea una nueva instancia del objeto mapa
            var map = new google.maps.Map(document.getElementById('map'),{
                zoom: 17,
                center:new google.maps.LatLng(coords.lat,coords.lng),
            });

            //Creamos el marcador en el mapa con sus propiedades
            //para nuestro obetivo tenemos que poner el atributo draggable en true
            //position pondremos las mismas coordenas que obtuvimos en la geolocalización
            marker = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            title:"Mi ubicación actual",
            position: new google.maps.LatLng(coords.lat,coords.lng),

            });
            //map.setCenter(pos);
            //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica
            //cuando el usuario a soltado el marcador
            marker.addListener('click', toggleBounce);

            marker.addListener( 'dragend', function (event)
            {
                //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
                document.getElementById("coords").value =   this.getPosition().lat()+","+ this.getPosition().lng();
                document.getElementById("longitud").value = this.getPosition().lng();
                document.getElementById("latitud").value =  this.getPosition().lat();

                var long=this.getPosition().lat();
                var lat=this.getPosition().long();

                var locApi="https://maps.googleapis.com/maps/api/geocode/json?latlng="+long+","+lat+"&sensor=true";
                //x.innerHTML=locApi+"<br>"+loc.loc +"<br>"+loc.city +"<br>"+loc.region +"<br>";
                var cadena="";

                $.get({

                    url: locApi,
                    success:function(data)
                    {
                        console.log(typeof data);
                        //console.log(data.results.length);
                        if (data.results.length > 0)
                        {
                            cadena=data.results[0].address_components[0].long_name+", ";

                            cadena+=data.results[0].address_components[1].long_name+", ";

                            //cadena+=data.results[0].address_components[4].long_name;
                            x.innerHTML=cadena;
                            document.getElementById("txtDir").value=cadena;
                        }
                        else
                        {
                            x.innerHTML="La ubicacion no se reconoce, por favor intente de nuevo";
                        }

                    },
                    error:function(data)
                    {
                        console.log(data);
                    }
                });

            });
    }
    //callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
    function toggleBounce()
        {
            if (marker.getAnimation() !== null)
            {
            marker.setAnimation(null);
            } else
            {
            marker.setAnimation(google.maps.Animation.BOUNCE);
            }
        }
    function addUbicacion(x,y,dir){

        // alert(dir)

        // document.getElementById('div-referencia').style.display='block';
        document.getElementById("textlatitud").value=x+"";

        document.getElementById("textlongitud").value=y+"";

        //document.getElementById("textdescripcion").value=dir+"";

        document.getElementById("textlink").value="https://maps.google.com/?q="+y+","+x;

        let latitud1=-63.2710036;//latitud de la empresa -63.256608
        let longitud1=-17.3385438;//longitud de la empresa -17.334064

        let latitud2=x; //latitud del destino
        let longitud2=y;//longitud del destino




        (calculateDistance(latitud1,longitud1,latitud2,longitud2));
        //funcion para calcular la distancia en kilometro


        Swal.fire(
            'Ubicacion Registrada Exitosamente!',
            ' ',
            'success'
        )
    }
    function calculateDistance(lt1,lng1,lt2,lng2) {
        console.log(lt1)
        var origin = new google.maps.LatLng(lng1, lt1);

        var destination = new google.maps.LatLng(lng2, lt2);

        var service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix(
            {
                origins: [origin],
                destinations: [destination],
                travelMode: google.maps.TravelMode.DRIVING,
                //unitSystem: google.maps.UnitSystem.IMPERIAL, // millas y pies.
                unitSystem: google.maps.UnitSystem.metric, // kilometros y metros
                avoidHighways: false,
                avoidTolls: false
            }, callback);
        }

        function callback(response, status)
        {
        if (status != google.maps.DistanceMatrixStatus.OK)
        {
            console.log(origin);
        } else
        {
            console.log("ubicacion se cargo exitosamente")
            var origin = response.originAddresses[0];
            var destination = response.destinationAddresses[0];
            if (response.rows[0].elements[0].status === "ZERO_RESULTS")
            {
                $('#textTiempo').val("No hay distancia para  "  + origin + " and " + destination);
                console.log(origin);
            } else
            {
                var distance = response.rows[0].elements[0].distance;
                var duration = response.rows[0].elements[0].duration;
                var distanciaKilometro = distance.value / 1000; // Kilometro
                //var distanciaMillas = distance.value / 1609.34; // millas
                var duracionText = duration.text; //tiempo en formato (1 hours 50 min) (1 h 6 min)
                //aumentamos 10 minutos de preparacion que son 600 segundos
                var duracionValue = duration.value + 600;// tiempo en formato solo segundos


                $('#textDistancia').val(distanciaKilometro.toFixed(2));//distancia en km

                //llamamos a la funcion para calcular el precio de acuerdo a km
                // recargoPedido(distanciaKilometro);
                // //llamamos a la funcion para calcular el tiempo
                convertirSegundosAhoraMinutos(duracionValue);

            }

        }
        }
        function convertirSegundosAhoraMinutos(seconds)
        {
            var hour = Math.floor(seconds / 3600);
            hour = (hour < 10)? '0' + hour : hour;
            var minute = Math.floor((seconds / 60) % 60);
            minute = (minute < 10)? '0' + minute : minute;
            var second = seconds % 60;
            second = (second < 10)? '0' + second : second;
            resultado= hour + ':' + minute + ':' + second;
            $('#textTiempo').val(resultado);//tiempo aproximdao

        }


</script>
