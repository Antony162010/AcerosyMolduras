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
                <th scope="col">Título</th>
                <th scope="col">Estado</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($books as $book) --}}
            <tr>
                <td></td>
                <td></td>
                <td>
                    {{-- <button type="button" class="btn round-btn btn-danger btn-disabled-book">
                        Deshabilitado
                    </button> --}}
                </td>
                <td>
                    <a {{-- href={{ route( 'books.edit') }} --}}>
                        <button type="button" class="btn btn-primary">
                            <i class="far fa-edit"></i>
                        </button>
                    </a>
                </td>
            </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>
</div>
@endsection