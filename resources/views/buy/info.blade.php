@extends('layout.app')

{{-- Header --}}
@section('title', 'Compras | ')
@section('scripts')
<script type="text/javascript" src="{{ asset('js/buyForm.js') }}"></script>
@endsection
@section('assets')
<link href="{{ asset('css/sale.css') }}" rel="stylesheet">
@endsection


@section('content')
<br />
<h2 class="p-l-30">
    <em onclick="location.href='javascript:history.back()';" class="fas fa-arrow-left p-r-30">
    </em>Información de la compra
</h2>
<br />
@component('component.formBuy', [
'type' => 'info',
'buy' => $buy,
'products' => $products,
'providers' => $providers
])
@endcomponent

@endsection