@extends('layout.app')

{{-- Header --}}
@section('title', 'Catálogo | ')
@section('scripts')
{{-- <script type="text/javascript" src="{{ asset('js/storeHouseIndex.js') }}"></script> --}}
@endsection
@section('assets')
{{-- <link href="{{ asset('css/home.css') }}" rel="stylesheet"> --}}
@endsection

@section('content')
<br />
<h2 class="p-l-30">
    <em onclick="location.href='javascript:history.back()';" class="fas fa-arrow-left p-r-30">
    </em>Crear nuevo catálogo
</h2>
<br />

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

<div class="container card bg-light p-t-50 p-r-50 p-l-50 p-b-50">
    <form method="POST" action="{{ route('store_house.catalog') }}">
        {{ csrf_field() }}

        <button type="button" id="add_product" class="btn btn-primary">Añadir producto</button>
        <br>
        <div class="products"></div>
        <br>
        <div class="row">
            <div class="form-group col-md-8"> </div>
            <div class="form-group col-md-2"><button type="submit" class="btn btn-primary">Generar pdf</button></div>
        </div>


    </form>
</div>
@endsection