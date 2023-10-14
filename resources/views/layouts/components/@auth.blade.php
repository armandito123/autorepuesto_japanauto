@auth      
<section id="topbar" class="d-none d-lg-block">
  <div class="container clearfix">
    <div class="contact-info float-left">
      {{-- <i class="fas fa-user fa-2x"></i><a href="mailto:contact@example.com">{{ Auth::user()->name }}</a>
      
      <i class="icofont-envelope"></i>  --}}
    </div>
    <div class="social-links float-right">
      <a href="#" data-toggle="modal" data-target="#carrito-modal" class="linkedin">
          {{-- <i class="fas fa-search"></i> --}}
          
          <i class="fas fa-shopping-cart fa-2x carrito"></i>
          <span class="badge badge-success">{{ @contarCarrito(Auth::user()->id) }}</span>
      </a>
      <i class="fas fa-user fa-2x"></i><a href="mailto:contact@example.com">{{ Auth::user()->name }}</a>

      <div class="modal fade" id="carrito-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Autorepuestos Seleccionados</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="tabla" style="display: block">
                    <div class="row">
                                
                        <div class="col-12 table-responsive">
                            <table id="detalle" class="table table-hover table-hover table-bordered">
                                <thead class="">
                                <th>Opciones</th>
                                <th>Autorepuesto</th>
                                <th>Cantidad</th>
                                <th>Medidas</th>
                                <th>Precio </th>
                                <th>Subtotal</th>
                                </thead>
                                <tbody>
    
                                </tbody>
                                <tfoot>
                                <th>TOTAL</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>
                                    <h6 id="total"> Bs/. 0.00</h6>
                                </th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="cliente" style="display: none">
    
                </div>
                <div class="ubicacion" style="display: none">
    
                </div>
    
                <div style='display:none'>
                  <div class="form-group">
                    <input type="text"  class="form-control" readonly required placeholder="latitud" name="textlatitud" id="textlatitud">
                  </div>
                  <div class="form-group">
                    <input type="text"  class="form-control" readonly required placeholder="Longitud" name="textlongitud" id="textlongitud">
                  </div>
                  <div class="form-group">
                    <input type="text"  class="form-control" readonly required placeholder="Ubicación" name="textlink" id="textlink">
                  </div>
                  <div class="form-group">
                        <label for="" class="form-label">Distancia /KM</label>
                        <input  type="number" readonly class="form-control" name="textDistancia" id="textDistancia" >
                  </div>
                  <div class="form-group">
                      <label for=""  class="form-label">Tiempo</label>
                      <input type="text" id="textTiempo">
                  </div>
                </div>
    
              <div id='div-referencia' style='display:none' class="form-group">
                  <label for=""   class="form-label ">Escribenos una referencia de tu ubicacion</label>
                  <input type="text" id="input-referencia" class="form-control">
                  <br>
                  @auth
                    <button  onclick="guardarDatos({{ Auth::user()->id }})" type="button" class="btn btn-sm btn-success" >
                      <i class="fas fa-map-marker-alt"></i> Guardar Datos
                    </button>
                  @endauth
              </div>
            </div>
            <div class="modal-footer">
              @auth
                    <button id="btn-guarda" type="button" onclick="mostrarMapa()" class="btn btn-primary">Guardar</button>
                    <div  id="enviar-ubicacion" style="display: none; align-items: center">
                      <button   type="button" class="btn btn-sm btn-success" data-target="#maps" data-toggle="modal">
                        <i class="fas fa-map-marker-alt"></i> - GPS
                      </button>
                    </div>        
              @else
                    <button type="button" onclick="mostrarFormularioDatos()" class="btn btn-primary">Guardar</button>
              @endauth
            
            </div>
          </div>
        </div>
    </div>
      {{-- <i class="icofont-envelope"></i> --}}
    </div>
  </div>
</section>
@else

@endauth
<!-- Button trigger modal -->



<div class="modal fade" id="maps" role="dialog">
<div class="modal-dialog modal-lg">    
  <!-- Modal content-->
  <div class="modal-content" id="modalcon" >
      <div class="modal-header" >         
        <h3 align="center" style="width:100%; padding: 0px;">Indica tu dirección 
        </h3>
      </div>
      <div class="modal-body">
      <div id="div_maps" >
          <!--  GOOGLE MAPS-->
          <div id="map"></div>

          <div style="display:none">
              Nueva Ubiv.<input type="text" id="coords" />
              <br>
              Latitud <input class="xy" type="text"  id="longitud" name="longitud" />
              <br>
              Longitud <input class="xy" type="text" id="latitud" name="latitud" />
              <br>
              <br>
          </div>
          <div class="clearfix"></div>

          <div id="ayuda" align="center">

          <p id="nomDir">
          <!--<b>No es tu ubicacion ? </b><small style="font-size: 10px;" >Recuerda que puedes modificar tu ubicación moviendo el icono que indica donde estas ahora. </small>
          -->
          </p> 

          </div>
          <input  type="text" id="txtDir" name="txtDir" style="display:none">        
          <!-- END ,MAPS -->
      </div>

      <div class="clearfix"></div>
          <div class="alert alert-info" style="padding: 5px; margin-bottom: 0px;" align="center" >
          <b> Verifique su ubicación exacta para recibir su pedido</b>
          </div> 
      </div>

      <div class="modal-footer" stye="text-align: center !important;">
          <button  type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Cancelar</button>
          <button  style=" border-radius: 6px !important; font-size: 16px; width:220px;"  type="button" name="confir_ubv" id="confir_ubv" Onclick="addUbicacion(longitud.value,latitud.value,txtDir.value); " class="btn btn-success btn-lg verde" data-dismiss="modal"  >ACEPTAR</button>
      </div>
  </div>
</div>

</div>

<style> 
  @media(max-width: 700px){
  #div_maps {
        
        height: 320px;
    
    }

  }

  @media(min-width: 700px){
  #div_maps {
        height: 380px;
    
    }

  }

  #map {
  width: 100%;
  height: 90%;

  }

  #modalcon{
    color: #16438e;
    line-height: 1.42857143;
    font-family: "Frank";
  }
</style>


@section('mapa')
@include('layouts.components.jsMapa')
@endsection