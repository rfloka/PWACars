@extends('layouts.base')
@section('title', 'Viaturas')
@section('content')
<div class="container-fluid filters">
    <button class="btnfilter" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false"
        aria-controls="collapseExample">
        Filtros <i class="fas fa-sliders-h"></i>
    </button>
    <form class="form-inline my-lg-0" method="GET" action="/viaturas/search/">
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="search" id="inlineFormInputGroup"
                placeholder="Marcas:Ferrari">
            <div class="input-group-prepend">
                <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <div class="collapse" id="collapseExample">
        <h3>Filtros</h3>
        <form method="POST" action="/viaturas/filtros">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="exampleFormControlSelect1">Tipo de Viatura</label>
                    <select name="Tipo_viatura" class="form-control">
                        <option value="">Tipo de Viatura</option>
                        <option value="Carro">Carro</option>
                        <option value="Mota">Mota</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlSelect1">Marca</label>
                    <select name="Marca" class="form-control">
                        <option value="">Marca</option>
                        @foreach ($filtromarcas as $filtromarca)
                        <option value="{{$filtromarca->marca}}">{{$filtromarca->marca}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlSelect1">Modelo</label>
                    <input name="modelo" class="form-control" type="text" placeholder="Default input">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlSelect1">Ordenar</label>
                    <select name="ordenar" class="form-control">
                        <option value="created_at">Ultimos Inseridos</option>
                        <option value="newcar">Mais Recente</option>
                        <option value="oldcar">Mais Antigo</option>
                        <option value="cheap">Mais Barato</option>
                        <option value="expensive">Mais Caro</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="exampleFormControlSelect1">Preço</label>
                    <input name="preco_min" type="number" class="form-control" placeholder="100€" id="preco_min">
                    <input name="preco_max" type="number" class="form-control" placeholder="10000€" id="preco_max">
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlSelect1">Registo</label>
                    <input name="ano_min" type="number" class="form-control" placeholder="1990" id="ano_min">
                    <input name="ano_max" type="number" class="form-control" placeholder="2019" id="ano_max">
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlSelect1">KM</label>
                    <input name="km_min" type="number" class="form-control" placeholder="0 KM" id="km_min">
                    <input name="km_max" type="number" class="form-control" placeholder="200.000 KM" id="km_max">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-1">
                    <a href="#" id="gasolina" onclick="check1()" class="btn btncombu">Gasolina</a>
                </div>
                <div class="form-group col-xs-1">
                    <a href="#" id="gasoleo" onclick="check2()" class="btn btncombu">Gasóleo</a>
                </div>
                <div class="form-group col-xs-1">
                    <a href="#" id="gpl" onclick="check3()" class="btn btncombu">GPL</a>
                </div>
                <div class="form-group col-xs-1">
                    <a href="#" id="eletrico" onclick="check4()" class="btn btncombu">Elétrico</a>
                </div>
                <div class="form-group col-md-12" style="display:none;">
                    <input name="combus[gasolina]" id="checkgasolina" value="gasolina" class="form-check-input"
                        type="checkbox">
                    <label for="exampleFormControlSelect2">Gasolina</label><br>
                    <input name="combus[gasoleo]" id="checkgasoleo" value="gasoleo" class="form-check-input"
                        type="checkbox">
                    <label for="exampleFormControlSelect2">Gasóleo</label><br>
                    <input name="combus[gpl]" id="checkgpl" value="gpl" class="form-check-input" type="checkbox">
                    <label for="exampleFormControlSelect2">GPL</label><br>
                    <input name="combus[eletrico]" id="checkeletrico" value="eletrico" class="form-check-input"
                        type="checkbox">
                    <label for="exampleFormControlSelect2">Elétrico</label><br>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center">
                    <button type="submit" class="btn searchbtn" style="width:50%;font-size:20px;">Filtrar</button>
                </div>
                <div class="col-md-4"></div>
            </div>
            <hr>
        </form>
    </div>

</div>
<div class="container-fluid" style="padding-bottom:31%;">
    <div class="row">
        @if (count($viaturas) > 0 )
        @foreach ($viaturas as $viatura)
        <div class=" col-md-4 cardcar">
            <a href="/viaturas/{{$viatura->id}}/show">
                <div class="card">
                    <div style="height:280px;background-color:#161616;">
                        <img class="card-img-top" style="width: 100%;height: 100%;vertical-align: middle;object-fit: cover;"
                            src="/storage/upload/viaturaspics/{{$viatura->nome}}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$viatura->titulo}}</h5>
                        <h6>{{number_format($viatura->preco)}}€</h6>
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <p><i class="fas fa-calendar-alt"></i> {{$viatura->registo}}</p>
                                    <p><i class="fas fa-gas-pump"></i> {{$viatura->combustivel}}</p>
                                </div>
                                <div class="col-6">
                                        @if ($viatura->km == 0)
                                        <p><i class="fas fa-stopwatch"></i><b> Novo</b></p>
                                        @else
                                        <p><i class="fas fa-stopwatch"></i> {{number_format($viatura->km)}}km</p>
                                        @endif
                                    
                                    <p><i class="fas fa-car"></i> {{$viatura->tipo}}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        @endforeach
        @else
        <h1> Ups não encontramos nenhuma viatura</h1>
        @endif
    </div>
</div>
<script type="text/javascript" src="/js/combustivel.js"></script>
@endsection