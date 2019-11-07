@extends('layout.app')

{{-- Header --}}
@section('title', 'Almacén | ')
@section('scripts')
<script type="text/javascript" src="{{ asset('js/storeHouseForm.js') }}"></script>
@endsection
@section('assets')
<link href="{{ asset('css/storeHouse.css') }}" rel="stylesheet">
@endsection

@section('content')
<br />
<h2 class="p-l-30">
    <em onclick="location.href='javascript:history.back()';" class="fas fa-arrow-left p-r-30">
    </em>Agregar producto al almacén
</h2>
<br />
@component('component.formStoreHouse', [
'type' => 'insert',
'route' => 'store_house.store',
'warehouses' => $warehouses ])
@endcomponent

@endsection