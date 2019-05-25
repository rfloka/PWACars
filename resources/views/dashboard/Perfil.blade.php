@extends('layouts.base')
@section('title', 'Landing Page')
@section('content')
@if (session('alert'))
<div class="alert alert-success" role="alert" style="position:absolute;top:16%;left:1%;z-index:4;">
    {{ session('alert') }}
</div>
@endif
@if (session('success'))
<div class="alert alert-success" role="alert" style="position:absolute;top:16%;left:1%;z-index:4;">
    {{ session('success') }}
</div>
@endif
@if (session('erro'))
        <div class="alert alert-danger" role="alert" style="position:absolute;top:2%;left:10%;z-index:4;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fas fa-exclamation-triangle"></i> {{ session('erro') }}
        </div>
        @endif

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 text-center" style="background-color:#060606;height:91.5vh;">
        <img src="/storage/upload/profilepics/{{$user->avatar}}" style="width:150px;height:150px;border-radius:50%;">
        <hr>       
        <p style="color:white;"><b style="color:#CDA52C;">Nome: </b>{{ $user->name }}</p>
        <p style="color:white;"><b style="color:#CDA52C;"> Email: </b>{{ $user->email }}</p>
        @if ($user->role == 1)
        <p style="color:white;"><b style="color:#CDA52C;">Papel: </b>Admin</p>
        @else
        <p style="color:white;"><b style="color:#CDA52C;">Papel: </b>Utilizador</p>
        @endif
        <button id="butao" class="btn btnfav" onclick="modificar()">Modificar</button>
        <form id="modif" method="POST" action="/admin/users/perfil/rolemod" style="display:none;">
            @csrf
            <div class="form-group">
                <hr>
                    <input type="hidden" value="{{$user->id}}" name="userid">
                    <select name="role" class="form-control" id="exampleFormControlSelect1">
                      <option value="1">Admin</option>
                      <option value="0">Utilizador</option>
                    </select>
                  </div>
            <input type="submit" id="submit" class="btn btnfav" value="Guardar" name="submit">
        </form>
        </div>
        <hr>
        <div class="col-md-9">
            <div class="container-fluid">
                <div class="row">
                    @if (count($viaturas) > 0 )
                    @foreach ($viaturas as $viatura)
                    <div class=" col-sm-6 cardcar">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    @else
                    <div class="container text-center">
                    <h1> Ups não encontramos nenhuma viatura</h1>
                    <h5>Tem que adicionar um carro aos favoritos</h5>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div>
@endsection
@section('scripts')
<script>
 function modificar() {
    document.getElementById("butao").style.display = "none";
    document.getElementById("modif").style.display = "block";
};
</script>
@endsection