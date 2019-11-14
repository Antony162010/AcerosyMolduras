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
    </em>Realizar nueva compra
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

@component('component.formBuy', [
'type' => 'insert',
'route' => 'buy.store',
'providers' => $providers ])
@endcomponent

@endsection