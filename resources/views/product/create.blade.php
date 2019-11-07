@extends('layout.app')

{{-- Header --}}
@section('title', 'Productos | ')
@section('scripts')
<script type="text/javascript" src="{{ asset('js/product.js') }}"></script>
@endsection
@section('assets')
<link href="{{ asset('css/product.css') }}" rel="stylesheet">
@endsection


@section('content')
<br />
<h2 class="p-l-30">
    <em onclick="location.href='javascript:history.back()';" class="fas fa-arrow-left p-r-30">
    </em>Crear nuevo producto
</h2>
<br />
@component('component.formProduct', [
'type' => 'insert',
'route' => 'product.store',
'categories' => $categories ])
@endcomponent

@endsection