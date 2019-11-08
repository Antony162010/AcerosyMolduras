@extends('layout.app')

{{-- Header --}}
@section('title', 'Ventas | ')
@section('scripts')
<script type="text/javascript" src="{{ asset('js/saleForm.js') }}"></script>
@endsection
@section('assets')
<link href="{{ asset('css/sale.css') }}" rel="stylesheet">
@endsection


@section('content')
<br />
<h2 class="p-l-30">
    <em onclick="location.href='javascript:history.back()';" class="fas fa-arrow-left p-r-30">
    </em>Información de la venta
</h2>
<br />
@component('component.formSale', [
'type' => 'info',
'sale' => $sale,
'products' => $products,
'departments' => $departments
])
@endcomponent

@endsection