<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico')}}" />

    <title>@yield('title')Aceros y Molduras</title>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    {{-- DataTables --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/keytable/2.5.1/css/keyTable.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css" />

    <!--===============================================================================================-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/keytable/2.5.1/js/dataTables.keyTable.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js">
    </script>

    {{-- FontAwesome --}}
    <script src="https://kit.fontawesome.com/f3fb6f4736.js" crossorigin="anonymous"></script>

    {{-- Personales --}}
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    {{-- Styles --}} @yield('assets')
    {{-- Scripts --}} @yield('scripts')


</head>

<body>

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
                </li>&nbsp;
                <li class="nav-item active">
                    <a class="nav-link" href={{ route('product.index') }}>
                        <em class="fas fa-archive"></em> Productos</a>
                </li>&nbsp;
                {{-- <li class="nav-item active">
                    <a class="nav-link" href={{ route('books') }}>
                <em class="fas fa-book m-r-4 "></em>Libros</a>
                </li>&nbsp; --}}

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

    <div class="body" style="margin-bottom: 60px;">
        @yield('content')
    </div>

</body>

</html>