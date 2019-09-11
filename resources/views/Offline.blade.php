@extends('layouts.base')
@section('title', 'Offline')
@section('content')
<div class="container-fluid center" style="padding-bottom:31%;">
    <h1 align="center"> Voçê está Offline</h1>
    <br>
    <div class="row justify-content-center">
        <img src="{{ URL::asset('img/offline.png') }}" alt="Nature" class="responsive">
    </div>
    <br>
    <div class="row justify-content-center">
        <a class="btn btncontact btn-lg" href="/" role="button">Actualizar</a>
    </div>
</div>
@endsection
