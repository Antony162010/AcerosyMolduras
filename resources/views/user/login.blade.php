<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico')}}" />

    <title>Login | Aceros y Molduras</title>

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

    <link href="{{ asset('css/principal.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

</head>

<body class="login-background">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div> {{-- Separador --}}
            <div class="col-md-6 m-b-40 m-t-40">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br>
                @endif
                <div>
                    <div class="container card bg-light" style="padding-top: 30px; padding-bottom: 30px">
                        <img class="img-fluid rounded mx-auto d-block" src="{{asset('img/Aceros y molduras logo.png')}}"
                            alt="logo">
                        <br>
                        <form method="POST" action="{{ route('signin')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="user_email">Correo</label>
                                <input type="text" name="user-email" class="form-control" id="user_email"
                                    aria-describedby="emailHelp" placeholder="Ingrese su correo" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="user_password">Contraseña</label>
                                <input type="password" name="user-password" class="form-control" id="user_password"
                                    placeholder="Ingrese su contraseña" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div> {{-- Separador --}}
        </div>
    </div>

    <br><br>
</body>

</html>