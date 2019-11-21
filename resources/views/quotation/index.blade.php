@extends('layout.app')

{{-- Header --}}
@section('title', 'Cotizaciones | ')
@section('scripts')
<script type="text/javascript" src="{{ asset('js/quotationIndex.js') }}"></script>
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
    <h2> Cotizaciones realizadas </h2>
    <br />
    <table id="table_sale" class="table table-striped">
        <thead class="table-style">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Fecha</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Total</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quotations as $q)
            <tr>
                <td>{{$q->idquotation}}</td>
                <td>{{$q->date}}</td>
                <td>{{$q->c_name}}</td>
                <td>{{$q->last_name}}</td>
                <td>{{$q->totalprice}}</td>
                <td>
                    <a href={{ route('quotation.show',$q->idquotation )}}>
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection