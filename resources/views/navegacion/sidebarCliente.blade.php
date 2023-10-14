<div class="sidebar">
    <div class="pb-3 mt-3 mb-3 user-panel d-flex">
        <div class="image">
            <img src="{{ asset(Auth::user()->avatar) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="{{ url('/') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <!--Modulo Pedidos-->
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
                    <a href="{{ route('cliente.pedido') }}" class="nav-link">
                        {{-- <i class="fas fa-truck nav-icon"> </i> --}}
                        <i class="far fa-circle nav-icon"></i>
                        <p> Mis Pedidos </p>
                    </a>
                </li>
                
            </ul>
            </li>
            <!--Ir a realizar un Pedido-->
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-cart-plus" style="color: #c1c1c1;"></i>
                    <p>
                        Realizar un Pedido
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">
                            {{-- <i class="fas fa-truck nav-icon"> </i> --}}
                            <i class="fab fa-chrome"></i>
                            <p> Ir a Realizar un Pedido </p>
                        </a>
                    </li>
                    
                </ul>
                </li>



        </ul>
    </nav>
</div>
