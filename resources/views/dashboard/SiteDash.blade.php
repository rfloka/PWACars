@extends('dashboard.Dashboard')
@section('title', 'Dashboard')
@section('admincontent')
<div class="container-fluid" style="margin-top:20px;">
    <div class="row">
        <div class="col-md-6" style="padding:20px;">
            <div class="card" style="background-color:#003049;">
                <div class="card-body text-center" style="color:white;">
                    <i class="fas fa-users" style="font-size:150px;"></i>
                    <hr>
                    <h5 class="card-title">Utilizadores</h5>
                    <p class="card-text"  style="color:white;">Utilizadores: {{$users}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="padding:20px;">
            <div class="card" style="background-color:#D90429;">
                <div class="card-body text-center" style="color:white;">
                    <i class="fas fa-car" style="font-size:150px;"></i>
                    <hr>
                    <h5 class="card-title">Veiculos</h5>
                    <p class="card-text" style="color:white;">Veiculos: {{$veiculos}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="padding:20px;">
            <div class="card" style="background-color:#B90FB9;">
                <div class="card-body  text-center">
                    <i class="fas fa-crown" style="font-size:150px;"></i>
                    <hr>
                    @if (!count($bestcar) > 0)
                    <h5 class="card-title">Sem carros</h5>
                    <p class="card-text">Numero de Likes:None</p>
                    <a class="btn btnfav disabled" role="button">Ver Carro</a>
                    @else
                    <h5 class="card-title">{{$bestcar[0]->titulo}}</h5>
                    <p class="card-text">Numero de Likes:{{$likes}}</p>
                    <a class="btn btnfav" href="/viaturas/{{$bestcar[0]->id}}/show" role="button">Ver Carro</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6" style="padding:20px;">
            <div class="card"  style="background-color:#009933;">
                <div class="card-body  text-center">
                    <i class="fas fa-concierge-bell" style="font-size:150px;"></i>
                    <hr>
                    <h5 class="card-title">Serviços</h5>
                    <p class="card-text">Serviços não vistos:<span style="color:red;">{{$servicos}}</span></p>
                    <a class="btn btnfav" href="/admin/servicos" role="button">Ver Servicos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
