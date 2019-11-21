<nav class="navbar navbar-expand-lg navbar-dark nav-style navbar-padding shadow">

    <a class="navbar-brand" href={{route( "home")}}>
        <span><img class="navbar-logo" src="{{asset('img/Aceros y molduras logo.png')}}" /></span>
        Admin
    </a>

    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href={{ route('store_house.index') }}>
                    <em class="fas fa-warehouse m-r-4"></em> Almacén</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href={{ route('product.index') }}>
                    <em class="fas fa-archive m-r-4"></em> Productos</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href={{ route('sale.index') }}>
                    <em class="fas fa-cart-arrow-down m-r-4 "></em>Ventas</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href={{ route('buy.index') }}>
                    <em class="fas fa-cart-plus m-r-4 "></em>Compras</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href={{ route('quotation.index') }}>
                    <em class="fas fa-comments-dollar m-r-4 "></em>Cotizaciones</a>
            </li>

        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown"><em class="fas fa-user-circle"></em>
                    Hola, {{$_SESSION['user_session']['user_name']}}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href={{ route( 'logout') }}> <em class="fas fa-power-off"></em> Cerrar
                        sesión</a>
                </div>
            </li>
        </ul>

    </div>
</nav>