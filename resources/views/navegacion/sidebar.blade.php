<div class="sidebar">
    <div class="pb-3 mt-3 mb-3 user-panel d-flex">
        <div class="image">
            <img src="{{ asset(Auth::user()->avatar) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            {{-- <li class="nav-item">
                <a href="{{ route('proveedor.index') }}" class="nav-link">
                    <i class="fas fa-truck nav-icon"></i>
                    <p>Proveedor</p>
                </a>
            </li> --}}

            <!--modulo almacen--->
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-warehouse"></i>
                    <p>
                        Modulo Almacen
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('sucursal.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Sucursal</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('almacen.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Almacen</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('repuestoAlmacen.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Inventario</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('repuesto.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Repuesto</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('marcaModelo.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Marca Modelo</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('categoria.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Categoria</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('modelo.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Modelo</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('marca.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Marca</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tipoRepuesto.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>SubCategoria</p>
                        </a>
                    </li>
                </ul>
            </li>


            <!--MODULO PEDIDO DELIVERY-->
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-shipping-fast"></i>
                <p>
                    Modulo Pedidos Delivery
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('repartidor.index') }}" class="nav-link">
                    <i class="far fa-user nav-icon"></i>
                    <p>Repartidor</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('vehiculo.index') }}" class="nav-link">
                    <i class="fas fa-car nav-icon"></i>
                    <p>Vehiculos</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('delivery.index') }}" class="nav-link">
                    <i class="fas fa-shopping-cart nav-icon"></i>
                    <p>Ver Pedidos</p>
                </a>
            </li>
        </ul>
    </li>

        <!--MODULO VENTAS-->
        <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-shopping-bag"></i>
                    <p>
                        Modulo Ventas
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('cliente.index') }}" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>Cliente</p>
                        </a>
                    </li>

            <li class="nav-item">
                <a href="{{ route('venta.index') }}" class="nav-link">
                    <i class="far fa-clipboard nav-icon"></i>
                    <p>Nota Venta</p>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a href="{{ route('compra.index') }}" class="nav-link">
                    <i class="far fa-clipboard nav-icon"></i>
                    <p>Nota Compra</p>
                </a>
            </li> --}}
</ul>
            </li>
        
            <!--MODULO USUARIOS-->
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-users size:7x"></i>
                    <p>
                        Modulo Usuario
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('usuario.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ url('/bitacora') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Bitacora</p>
                        </a>
                    </li> --}}
                </ul>
            </li>

            <!--ENVIAR CORREOS-->
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-envelope"></i>
                <p>
                    Enviar Correos
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('contactoadministrador.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Envia un Correo</p>
                    </a>
                </li>
            </ul>
        </li>


        </ul>
    </nav>
</div>
