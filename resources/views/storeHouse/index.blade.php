@extends('layout.app')

{{-- Header --}}
@section('title', 'Almacén | ')
@section('scripts')
<script type="text/javascript" src="{{ asset('js/storeHouseIndex.js') }}"></script>
@endsection
@section('assets')
{{-- <link href="{{ asset('css/home.css') }}" rel="stylesheet"> --}}
@endsection

@section('content')
<br>
@if(Session::has('successMsg'))
<div class="alert alert-success" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">x</button> {{ Session::get('successMsg') }}
</div>
@endif

<div class="container">
    <br />
    <br />
    <h2>
        Almacén
    </h2>
    <br />

    <div class="row">
        <div class="col-sm-4">Busque por fecha, por defecto la fecha acual:</div>
        <div class="col-sm-1"></div>
        <div class="col-sm-3"><input type="date" class="form-control datepicker text-center"
                value="{{ date('Y-m-d',strtotime(now())) }}"></div>
        <div class="col-sm-1"></div>
        <div class="col-sm-1"><button type="button" class="btn btn-primary" id="search_date">Buscar</button></div>
        <div class="col-sm-2"></div>
    </div>
    <div class="row">
        <a class="nav-link" href={{ route('store_house.catalog') }}>
            <button type="button" class="btn btn-primary">
                Generar Catálogo
            </button>
        </a>
    </div>
    <br /><br />

    <table id="table_store_house" class="table table-striped">
        <thead class="table-style">
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Categoria</th>
                <th scope="col">Modelo</th>
                <th scope="col">Marca</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $p)
            <tr>
                <td>{{$p->code}}</td>
                <td>{{$p->category}}</td>
                <td>{{$p->model}}</td>
                <td>{{$p->mark}}</td>
                <td>{{$p->boxes_quantity}}</td>
                <td>
                    <a href={{ route( 'store_house.edit',$warehouseId.';'.$p->code) }}>
                        <button type="button" class="btn btn-primary">
                            <em class="far fa-edit"></em>
                        </button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection