@extends('layout.app')

{{-- Header --}}
@section('title', 'Productos | ')
@section('scripts')
<script type="text/javascript" src="{{ asset('js/productIndex.js') }}"></script>
@endsection
@section('assets')
{{-- <link href="{{ asset('css/home.css') }}" rel="stylesheet"> --}}
@endsection

@section('content')
<div class="container">
    <br />
    <br />
    <h2>
        Productos 
    </h2>
    <br />
    <table id="table_product" class="table table-striped">
        <thead class="table-style">
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Categoría</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Precio</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $p)
            <tr>
                <td>{{$p->code}}</td>
                <td>{{$p->name}}</td>
                <td>{{$p->mark}}</td>
                <td>{{$p->model}}</td>
                <td>{{$p->price}}</td>
                <td>
                    <form method="post" action="{{ url('/product/destroy/'.$p->code )}}">
                        <a href={{ route( 'product.edit') }}>
                            <button type="button" class="btn btn-primary">
                                <i class="far fa-edit"></i>
                            </button>
                        </a>    
                         {{ csrf_field()}}
                        {{ method_field('DELETE')}}
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection