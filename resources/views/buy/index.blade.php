<html></html>@extends('layout.app')

{{-- Header --}}
@section('title', 'Compras | ')
@section('scripts')
<script type="text/javascript" src="{{ asset('js/buyIndex.js') }}"></script>
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
    <h2> Compras </h2>
    <br />
    <table id="table_buy" class="table table-striped">
        <thead class="table-style">
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Proveedor</th>
                <th scope="col">Usuario</th>
                <th scope="col">Fecha</th>
                <th scope="col">Total (S/.)</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchases as $p)
            <tr>
                <td>{{$p->idbuy}}</td>
                <td>{{$p->nameprov}}</td>
                <td>{{$p->nameadm}}</td>
                <td>{{$p->date}}</td>
                <td>{{$p->total}}</td>
                <td>
                    <a href={{ route('buy.show',$p->idbuy )}}>
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </a>
                    <a href={{ route('buy.destroy',$p->idbuy )}}>
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