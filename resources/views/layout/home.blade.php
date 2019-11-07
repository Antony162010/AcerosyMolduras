@extends('layout.app')
@section('assets')
{{-- <link href="{{ asset('css/home.css') }}" rel="stylesheet"> --}}
@endsection

@section('content')
<br>
<div class="container-fluid text-center">
    @if(Session::has('successMsg'))
    <div class="alert alert-success" id="success-alert">
        <button type="button" class="close" data-dismiss="alert">x</button> {{ Session::get('successMsg') }}
    </div>
    @endif

    <h3>¡Bienvenido!
        <br><br></h3>
    <h5>¿Qué deseas hacer primero?
        <br><br></h5>
    <p>
        <a href={{ route('store_house.index') }} class="btn btn-sq-lg btn-light">
                <em class="fas fa-warehouse fa-5x"></em><br />
            Gestionar<br>Almacénes
        </a>
        <a href={{ route('product.index') }} class="btn btn-sq-lg btn-light">
                <em class="fas fa-archive fa-5x"></em><br />
            Gestionar<br>Productos
        </a>
    </p>
</div>
@endsection