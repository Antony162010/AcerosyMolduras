@extends('layout.app')

{{-- Header --}}
@section('title', 'Ventas | ')
@section('scripts')
<script type="text/javascript" src="{{ asset('js/saleIndex.js') }}"></script>
@endsection
@section('assets')
<link href="{{ asset('css/sale.css') }}" rel="stylesheet">
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
    <h2> Ventas </h2>
    <br />
    <table id="table_sale" class="table table-striped">
        <thead class="table-style">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Distrito</th>
                <th scope="col">Fecha</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $s)
            <tr>
                <td>{{$s->idsale}}</td>
                <td>{{$s->name}}</td>
                <td>{{$s->date}}</td>
                <td>
                    <a href={{ route('sale.show',$s->idsale )}}>
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </a>
                    <a href={{ route('sale.destroy',$s->idsale )}}>
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-trash"></i>
                        </button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection