  <!-- CARROSEL DE SLIDERS -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide 1 -->
          <div class="carousel-item active" style="background-image: url('imagenes/slider6.jpg');">
            <div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animate__animated animate__fadeInDown">Los mejores repuestos de vehiculos<span></span></h2>
              </div>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="carousel-item" style="background-image: url('imagenes/slider8.jpg');">
            <div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animate__animated animate__fadeInDown">Contamos con Repuestos de marcas reconocidas</h2>
              </div>
            </div>
          </div>

          <!-- Slide 3 -->
          <div class="carousel-item" style="background-image: url('imagenes/slider9.jpg');">
            <div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animate__animated animate__fadeInDown">Haz tu Pedido de Repuestos Online</h2>
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
  </section>

  <!--QUIENES SOMOS- AUTOREPUESTO-->
  <div class="section-title" data-aos="fade-up" data-aos-delay="100">
    <h2>QUIENES SOMOS</h2>
  </div>
  <section id="portfolio" class="portfolio section-bg1">
    
    <div class="container containerquienessomos" data-aos="fade-up" data-aos-delay="100">
      <div class="section">
        <img src="{{ asset('imagenes/quienessomos.jpg') }}" alt="imagen empresa">
      </div>
      <div class="section-title-descripcion" data-aos="fade-up" data-aos-delay="100">
        <h2 class="titulo-descripcion">Autorepuestos JAPANAUTO</h2>
        <p><strong>JapanAuto</strong> 39 años brindando los mejores Autorepuestos en la Ciudad de Montero <br><br> Repuestos para vehículos 4 X 4 y servicio mecánico general, exportamos los mejores repuestos para tu vehiculo de las mejores marcas reconocidas a nivel mundial</p>
      </div>
    </div>
  </section><!-- End Descripcion -->

    <!--BUSCAR AUTOREPUESTO POR FILTROS-->
  <section id="portfolio" class="portfolio section-bg">
    <div class="container-productos" data-aos="fade-up" data-aos-delay="100">
      <div class="row">
        <div class="col-lg-12">
          <ul id="portfolio-flters">
            
            <!--BUSCAR REPUESTOS POR FILTROS-->
            <h2 class="section-titleh2">NUESTROS REPUESTOS</h2>
            <p class="buscapor">Busca nuestros Repuestos filtrando por:</p>
            <li data-filter="*" class="filter-active">Todos</li>
            <li data-filter=".filter-marca">Marcas</li>
            <li data-filter=".filter-categoria">Categorias</li>
            <li data-filter=".filter-tipo">SubCategorias</li>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container">

        <!--BUSCAR POR MARCA-->
        @foreach (@marcas() as $marca)
          <div class="col-lg-4 col-md-6 portfolio-item filter-marca">
            <div class="portfolio-wrap">
              <img src="{{ asset($marca->logo) }}"  class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>{{ $marca->nombre }}</h4>
                <p>{{ $marca->nombre }}</p>
                <div class="portfolio-links">
                  <a href="{{ asset($marca->logo) }}"  data-gall="portfolioGallery" class="venobox" title="{{ $marca->nombre }}"><i class="icofont-eye"></i></a>
                  <a href="{{ route('web.marcas', ['id'=>$marca->id]) }}" title="mas detalle"><i class="icofont-external-link"></i></a>
                </div>
              </div>
            </div>
          </div>
        @endforeach

        <!--BUSCAR POR CATEGORIAS-->
        @foreach (@categorias() as $categoria)
          <div class="col-lg-4 col-md-6 portfolio-item filter-categoria">
            <div class="portfolio-wrap">
              <img src="{{ asset($categoria->logo) }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>{{ $categoria->nombre }}</h4>
                <p>{{ $categoria->nombre }}</p>
                <div class="portfolio-links">
                  <a href="{{ asset($categoria->logo) }}" data-gall="portfolioGallery" class="venobox" title="{{ $categoria->nombre }}"><i class="icofont-eye"></i></a>
                  <a href="{{ route('web.categorias', ['id'=>$categoria->id]) }}" title="mas detalle"><i class="icofont-external-link"></i></a>
                </div>
              </div>
            </div>
          </div>
        @endforeach

        <!--BUSCAR POR SUBCATEGORIAS-->
        @foreach (@tipos() as $tipo)
          <div class="col-lg-4 col-md-6 portfolio-item filter-tipo">
            <div class="portfolio-wrap">
              <img src="{{ asset($tipo->logo) }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>{{ $tipo->tipo }}</h4>
                <p>{{ $tipo->tipo }}</p>
                <div class="portfolio-links">
                  <a href="{{ asset($tipo->logo) }}" data-gall="portfolioGallery" class="venobox" title="{{ $tipo->tipo }}"><i class="icofont-eye"></i></a>
                  <a href="{{ route('web.tipos', ['id'=>$tipo->id]) }}" title="mas detalle"><i class="icofont-external-link"></i></a>
                </div>
              </div>
            </div>
          </div>
        @endforeach 

      </div>
    </div>
  </section><!-- End Our Portfolio Section -->

  <!--NUESTRA UBICACION-->
  <div class="section-title" data-aos="fade-up" data-aos-delay="100">
    <h2>NUESTRA UBICACION</h2>
  </div>

  <section id="portfolio" class="portfolio section-bg1">
    <div class="container containernuestra-ubicacion" data-aos="fade-up" data-aos-delay="100">
      {{-- <iframe class="nuestra-ubicacion" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3808.530655071093!2d-63.26172082584033!3d-17.338180162858357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93ee3e8f07776ff7%3A0x212751ce46f0348f!2sJapanauto!5e0!3m2!1ses!2sbo!4v1689038679687!5m2!1ses!2sbo" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
      <iframe class="nuestra-ubicacion" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3808.530655071093!2d-63.26172082584033!3d-17.338180162858357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93ee3e8f07776ff7%3A0x212751ce46f0348f!2sJapanauto!5e0!3m2!1ses!2sbo!4v1689038679687!5m2!1ses!2sbo" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </section><!-- End Descripcion -->