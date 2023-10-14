{{-- https://programacionymas.com/blog/integrar-pagos-paypal-en-laravel --}}
<div>
  @auth

    <section id="about" class="team">
      <div class="container">

        <div class="section-title">
          <h2>{{ $marca->nombre }}</h2>
        </div>

        <div class="row">
          <div class="input-group">
            <select class="form-control" wire:model='criterio' name="" >
              <option value="tipo_repuestos">SubCategorias</option>
              <option value="categorias">Categorias</option>
          </select>
              <input type="text" class="form-control" wire:model='searchText'>
              <button class="btn btn-secondary"><i class="fas fa-search"></i></button>
          </div>
        </div>

        <div class="row">

          @if (count($repuestos))
            @foreach ($repuestos as $repuesto)

                <div class="col-xl-3 col-lg-4 col-md-6" >
                <div class="member">
                    <div class="pic"><img src="{{ asset($repuesto->img) }}" class="img-fluid" alt=""></div>
                    <div class="member-info">
                    <h4>{{ $repuesto->marca }} - {{ $repuesto->modelo }}</h4>
                    <span>{{ $repuesto->precio }} .BOB</span>
                    <div class="social">

                        <a href="" wire:click='seleccionarRepuesto({{$repuesto->idRepuesto}})' data-toggle="modal" data-target="#modal-detalle{{$repuesto->idRepuesto}}"><i class="fas fa-shopping-cart"></i></a>

                        <div wire:ignore.self class="modal fade" id="modal-detalle{{$repuesto->idRepuesto}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            @if ($x)
                                <div class="modal-header">
                                    <button type="button" class="btn btn-info btn-sm" wire:click='ocultar' ><i class="fas fa-plus"></i> Añadir al carrito <i class="fas fa-shopping-cart"> </i></button>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">

                                    <div class="p-0 card-body table-responsive">
                                    <div class="row">
                                        <div class="col-6">
                                        <img src="{{ asset(@repuesto($repuesto->idRepuesto)->imagen) }}" width="100" height="400" class="card-img-top" alt="Card image cap">
                                        <h5 class="card-title"></h5>
                                        </div>
                                        <div class="col-6">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr style="font-size: 16px">
                                                    <th>{{ @repuesto($repuesto->idRepuesto)->descripcion }}</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <dl class="row">
                                                    <tr>
                                                        <td><dt class="col-sm-4">SubMedida:</dt>
                                                        <td><dd class="col-sm-8">{{@repuesto($repuesto->idRepuesto)->submedida}}</dd>
                                                    </tr>
                                                    <tr>
                                                      <td><dt class="col-sm-4">Medida:</dt>
                                                      <td><dd class="col-sm-8">{{@repuesto($repuesto->idRepuesto)->medida}}</dd>
                                                  </tr>

                                                    <tr>
                                                        <td><dt class="col-sm-4">Categoria:</dt></td>
                                                        <td><dd class="col-sm-8">{{@repuesto($repuesto->idRepuesto)->nombre}}</dd>
                                                    </tr>
                                                    <tr>
                                                        <td><dt class="col-sm-4">Repuesto:</dt></td>
                                                        <td><dd class="col-sm-8">{{@repuesto($repuesto->idRepuesto)->descripcion}}</dd>
                                                    </tr>
                                                    <tr>
                                                        <td><dt class="col-sm-4">SubCategoria:</dt></td>
                                                        <td><dd class="col-sm-8">{{@repuesto($repuesto->idRepuesto)->tipo}}</dd>
                                                    </tr>
                                                    <tr>
                                                        <td><dt class="col-sm-4">Marca:</dt></td>
                                                        <td><dd class="col-sm-8">{{@repuesto($repuesto->idRepuesto)->marca}}</dd>
                                                    </tr>
                                                    <tr>
                                                        <td><dt class="col-sm-4">Modelo:</dt></td>
                                                        <td><dd class="col-sm-8">{{@repuesto($repuesto->idRepuesto)->modelo}}</dd>
                                                    </tr>
                                                    <tr>
                                                        <td><dt class="col-sm-4">Precio:</dt></td>
                                                        <td><dd class="col-sm-8">{{@repuesto($repuesto->idRepuesto)->precioVenta}}</dd>
                                                    </tr>
                                                </dl>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @else
                                <div class="modal-header">
                                  <button type="button" class="btn btn-primary btn-sm" wire:click='mostrar' ><i class="fas fa-arrow-left"> </i></button>
                                <h5 class="text-center title">
                                    Detalle su pedido
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                    <div class="col-6">
                                        <label for="">¿Cuantos deseas?</label>
                                        <input type="number" min="0" class="form-control" wire:model='cantidad' placeholder="Cantidad">
                                    </div>
                                    <div class="col-6">
                                        <label for="">¿Que Medida deseas?</label>
                                        <input type="text" min="0" class="form-control" wire:model='medida' placeholder="Medida">
                                    </div>
                                    <div class="col-6">
                                      <label for="">¿Que SubMedida deseas?</label>
                                      <input type="text" min="0" class="form-control" wire:model='submedida' placeholder="SubMedida">
                                  </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-info btn-sm" 
                                wire:click='mostrar' ><i class="fas fa-eye"> </i>Ver Repuesto </button>

                                <button data-dismiss="modal" aria-label="Close" type="button" class="btn btn-info btn-sm" 
                                wire:click='añadirRepuesto({{Auth::user()->id}},{{$repuesto->idRepuesto}})' >
                                    <i class="fas fa-plus"></i>  Añadir al carrito
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                                </div>
                            @endif
                            </div>
                        </div>
                        </div>

                    </div>
                    </div>
                </div>
                </div>
            @endforeach


          @else
          <div class="text-center" >
            <br>
            <br>
            <h5 class="text-center">No se encontraron resultados de su busqueda</h5>
            <br>

          </div>
          @endif

        </div>

      </div>
    </section>
  @else
    {{-- <section id="hero">
      <div class="hero-container">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

          <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

          <div class="carousel-inner" role="listbox">

            <!-- Slide 1 -->
            <div class="carousel-item active" style="background-image: url('assets/img/slide/slide-1.jpg');">
              <div class="carousel-container">
                <div class="container carousel-content">
                  <h2 class="animate__animated animate__fadeInDown">Bienvenidos a <span>CONY</span></h2>
                  <p class="animate__animated animate__fadeInUp">
                      ENCUENTRA  {{ $marca->nombre }}
                  </p>
                  <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Ver Repuestos</a>
                </div>
              </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item" style="background-image: url('assets/img/slide/slide-2.jpg');">
              <div class="carousel-container">
                <div class="container carousel-content">
                  <h2 class="animate__animated animate__fadeInDown">Lorem Ipsum Dolor</h2>
                  <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                  <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Ver Repuestos</a>
                </div>
              </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item" style="background-image: url('assets/img/slide/slide-3.jpg');">
              <div class="carousel-container">
                <div class="container carousel-content">
                  <h2 class="animate__animated animate__fadeInDown">Sequi ea ut et est quaerat</h2>
                  <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                  <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">RVer Repuestos</a>
                </div>
              </div>
            </div>

          </div>

          <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon icofont-rounded-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon icofont-rounded-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>

        </div>
      </div>
    </section> --}}


    <section id="about" class="team">
      <div class="container">

        <div class="section-title">
          <h2>{{ $marca->nombre }}</h2>
          {{-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem.</p> --}}
        </div>

        <div class="row">
          <div class="input-group">
            <select class="form-control" wire:model='criterio' name="" >
              <option value="repuestos">Repuesto</option>
              <option value="tipo_repuestos">SubCategoria</option>
              <option value="categorias">Categoria</option>
          </select>
              <input type="text" class="form-control" wire:model='searchText'>
              <button class="btn btn-secondary"><i class="fas fa-search"></i></button>
          </div>
        </div>
        <div class="row">
          @if (count($repuestos))


            @foreach ($repuestos as $repuesto)

              <div class="col-xl-3 col-lg-4 col-md-6" >
                <div class="member">
                  <div class="pic"><img src="{{ asset($repuesto->img) }}" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>{{ $repuesto->marca }} - {{ $repuesto->modelo }}</h4>
                    <span>{{ $repuesto->precio }} .BOB</span>
                    <div class="social">

                      <a href="" wire:click='seleccionarRepuesto({{$repuesto->idRepuesto}})' data-toggle="modal" data-target="#modal-detalle{{$repuesto->idRepuesto}}"><i class="fas fa-eye"></i></a>
                      <a href="" data-toggle="modal" data-target="#modal-register"><i class="fas fa-shopping-cart"></i></a>

                      <!-- Modal -->
                      <div wire:ignore.self class="modal fade" id="modal-detalle{{$repuesto->idRepuesto}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">REPUESTO</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="p-0 card-body table-responsive">
                                <div class="row">
                                  <div class="col-6">
                                    <img src="{{ asset(@repuesto($repuesto->idRepuesto)->imagen) }}" width="100" height="400" class="card-img-top" alt="Card image cap">

                                  </div>
                                  <div class="col-6">

                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>FICHA TECNICA</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <dl class="row">
                                                <tr>
                                                    <td><dt class="col-sm-4">SubMedida:</dt>
                                                    <td><dd class="col-sm-8">{{@repuesto($repuesto->idRepuesto)->submedida}}</dd>
                                                </tr>
                                                <tr>
                                                    <td><dt class="col-sm-4">Medidas:</dt></td>
                                                    <td><dd class="col-sm-8">{{@repuesto($repuesto->idRepuesto)->medida}}</dd>
                                                </tr>
                                                <tr>
                                                    <td><dt class="col-sm-4">Categoria:</dt></td>
                                                    <td><dd class="col-sm-8">{{@repuesto($repuesto->idRepuesto)->nombre}}</dd>
                                                </tr>
                                                <tr>
                                                    <td><dt class="col-sm-4">Repuesto:</dt></td>
                                                    <td><dd class="col-sm-8">{{@repuesto($repuesto->idRepuesto)->descripcion}}</dd>
                                                </tr>
                                                <tr>
                                                    <td><dt class="col-sm-4">SubCategoria:</dt></td>
                                                    <td><dd class="col-sm-8">{{@repuesto($repuesto->idRepuesto)->tipo}}</dd>
                                                </tr>
                                                <tr>
                                                    <td><dt class="col-sm-4">Marca:</dt></td>
                                                    <td><dd class="col-sm-8">{{@repuesto($repuesto->idRepuesto)->marca}}</dd>
                                                </tr>
                                                <tr>
                                                    <td><dt class="col-sm-4">Modelo:</dt></td>
                                                    <td><dd class="col-sm-8">{{@repuesto($repuesto->idRepuesto)->modelo}}</dd>
                                                </tr>
                                                <tr>
                                                    <td><dt class="col-sm-4">Precio:</dt></td>
                                                    <td><dd class="col-sm-8">{{@repuesto($repuesto->idRepuesto)->precioVenta}}</dd>
                                                </tr>
                                            </dl>
                                        </tbody>
                                    </table>
                                  </div>

                                </div>

                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

            @endforeach
          @else
            <div class="text-center">
              <h5>No se encontraron resultados de su busqueda</h5>
            </div>
          @endif



        </div>

      </div>
    </section>


  <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            @if ($eldy=='registro')
              <h5 class="modal-title" id="exampleModalLabel">Registrate por favor!!</h5>
            @endif
            @if ($eldy=='login')
              <h5 class="modal-title" id="exampleModalLabel">Ingresa tus credenciales. </h5>

            @endif
            @if ($eldy=='mensaje')
              <h5 class="modal-title" id="exampleModalLabel">Hola bienvenido!!</h5>
            @endif

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

              @if($eldy=='registro')
                <div class="card-body register-card-body">
                  <p class="login-box-msg">CREAR CUENTA</p>

                  <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3 input-group">
                      <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('name') }}" required placeholder="Nombre" autocomplete="name" autofocus>
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-user"></span>
                        </div>
                      </div>
                      @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>


                    <div class="mb-3 input-group">
                      <input id="apellidos" type="text" class="form-control @error('apellidos') is-invalid @enderror" placeholder="Apellidos" name="apellidos" value="{{ old('name') }}" required autocomplete="name" autofocus>
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-user"></span>
                        </div>
                      </div>
                      @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <div class="mb-3 input-group">
                      <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" placeholder="telefono" name="telefono" value="{{ old('name') }}" required autocomplete="name" autofocus>
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-user"></span>
                        </div>
                      </div>
                      @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <div class="mb-3 input-group">
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="User name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-user"></span>
                        </div>
                      </div>
                      @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <div class="mb-3 input-group">
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-envelope"></span>
                        </div>
                      </div>
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="mb-3 input-group">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" name="password" required autocomplete="new-password">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                        </div>
                      </div>
                      @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                    </div>


                    <div class="mb-3 input-group">
                      <input id="password-confirm" type="password" class="form-control" placeholder="Confirmar contraseña" name="password_confirmation" required autocomplete="new-password">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                        </div>
                      </div>
                      @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                    </div>

                    <div class="row">
                      </div>
                      <!-- /.col -->
                      <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                      </form>

                        <button type="button" wire:click='opcion(1)' class="btn btn-success btn-block">Login</button>

                      </div>
                      <!-- /.col -->
                    </div>
                </div>
              @endif
              @if ($eldy=='login')
                <div class="card-body login-card-body">
                  <p class="login-box-msg">Iniciar Sesion</p>

                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3 input-group">
                      <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-envelope"></span>
                        </div>
                      </div>
                    </div>


                    <div class="mb-3 input-group">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">

                      <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Iniciar Sesion</button>
                      <!-- /.col -->
                  </form>

                  <button type="button" wire:click='opcion(2)' class="btn btn-success btn-block">Register</button>
                </div>
                </div>
              @endif
              @if ($eldy=='mensaje')
                  <div class="text-center">
                    <h5><i class="fas fa-shopping-cart"></i>  Deseas utilizar un carrito ?? Registrate antes por favor...</h5>
                    <button wire:click='opcion(1)' class="btn btn-info btn-sm">Inicia Sesion</button>
                    <button wire:click='opcion(2)' class="btn btn-info btn-sm">Registrate</button>
                  </div>
              @endif
          </div>
        </div>
      </div>
    </div>

      <br>

    @endauth

</div>
