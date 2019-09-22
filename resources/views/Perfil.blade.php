@extends('layouts.base')
@section('title', 'Perfil')
@section('content')
@if (session('alert'))
<div class="alert alert-success" role="alert" style="position:absolute;top:16%;left:1%;z-index:4;">
    {{ session('alert') }}
</div>
@endif
@if (session('success'))
<div class="alert alert-success" role="alert" style="position:absolute;top:1%;left:10%;z-index:4;">
    {{ session('success') }}
</div>
@endif
@if (session('erro'))
<div class="alert alert-danger" role="alert" style="position:absolute;top:2%;left:10%;z-index:4;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <i class="fas fa-exclamation-triangle"></i> {{ session('erro') }}
</div>
@endif
<div class="container-fluid" style="padding-bottom:15%;">
    <div class="row">
        <div class="col-md-12" style="background-color:#060606;height:100%;">
            <div class="container-fluid">
                <div class="row" style="margin-bottom:15px;">
                    <div class="col-md-4"></div>
                    <div class="col-md-2 text-center">
                        <img src="/storage/upload/profilepics/{{Auth::user()->avatar}}"
                            style="width:150px;height:150px;border-radius:50%;">
                        <hr>
                        <form method="POST" action="/perfil/updatepic" enctype="multipart/form-data">
                            @csrf
                            <div class="custom-file" id="divfile" style="width:110px;">
                                <input id="file" type="file" class="custom-file-input" id="customFileLangHTML"
                                    name="avatar">
                                <label class="custom-file-label" for="customFileLangHTML"
                                    data-browse="Mudar Foto"></label>
                            </div>
                            <input type="submit" id="submit" class="btn btnfav text-center" value="Guardar"
                                name="submit" style="display:none;">
                        </form>
                    </div>
                    <div class="col-md-2"
                        style="display: flex;justify-content:center;align-content:center;flex-direction:column">
                        <p style="color:white;"><b style="color:#B90FB9;">Nome: </b>{{ Auth::user()->name }}</p>
                        <p style="color:white;"><b style="color:#B90FB9;"> Email: </b>{{ Auth::user()->email }}</p>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        @if (count($viaturas) > 0 )
        @foreach ($viaturas as $viatura)
        <div class=" col-sm-3 cardcar">
            <a href="/viaturas/{{$viatura->id}}/show">
                <div class="card">
                    <div style="height:280px;background-color:#161616;">
                        <img class="card-img-top"
                            style="max-width: 100%;height: 100%;vertical-align: middle;object-fit: cover;"
                            src="/storage/upload/viaturaspics/{{$viatura->nome}}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$viatura->titulo}}</h5>
                        <h6>{{number_format($viatura->preco)}}€</h6>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6">
                                    <p><i class="fas fa-calendar-alt"></i> {{$viatura->registo}}</p>
                                    <p><i class="fas fa-gas-pump"></i> {{$viatura->combustivel}}</p>
                                </div>
                                <div class="col-6">
                                    <p><i class="fas fa-stopwatch"></i> {{number_format($viatura->km)}}km
                                    </p>
                                    <p><i class="fas fa-car"></i> {{$viatura->tipo}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <a class="btn btn-success"
                                        href="http://192.168.1.226/viaturas/{{$viatura->id}}/show" role="button"
                                        style="width:100%;background-color:#009933;"><i class="fas fa-check-circle"></i>
                                        Ver Carro</a>
                                </div>
                                <div class="col-md-6">
                                    <a name="" id="" class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete-{{$viatura->id}}" href="#" role="button"
                                        style="width:100%;background-color:#cc0000;"><i
                                            class="far fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="modal fade bd-example-modal-sm" tabindex="-1" id="delete-{{$viatura->id}}" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="alert alert-danger" role="alert">
                        Eliminar {{$viatura->titulo}}
                    </div>
                    <a href="perfil/{{$viatura->id}}/delete" class="btn btn-danger">Sim Eliminar</a>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="container text-center" style="padding-bottom: 50vh;">
            <h1> Ups não encontramos nenhuma viatura</h1>
            <h5>Tem que adicionar um carro aos favoritos</h5>
        </div>
        @endif
    </div>
</div>

@endsection
@section('scripts')
<script>
    document.getElementById("file").onchange = function () {
        document.getElementById("divfile").style.display = "none";
        document.getElementById("submit").style.display = "block";
    };
</script>
@endsection
