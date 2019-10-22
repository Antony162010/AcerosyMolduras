@extends('layout.app')
@section('assets')
{{-- <link href="{{ asset('css/home.css') }}" rel="stylesheet"> --}}
@endsection

@section('content')
<br>
<div class="container-fluid text-center">
    @if(Session::has('successMsg'))
    <div class="alert alert-success" id="success-alert">
        <button type="button" class="close" data-dismiss="alert">x</button> {{ Session::get('successMsg') }}
    </div>
    @endif
</div>
<h1>Home</h1>
@endsection