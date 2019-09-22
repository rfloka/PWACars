@extends('layouts.base')
@section('title', 'MyCar')
@section('content')
<div class="container-fluid" style="background-color:#161616;padding-bottom:30%;">
<div class=" formmycar">
    <h2 style="color: #B90FB9;">Como é que é o seu carro de sonho?</h2>
    <form method="POST" action="/mycar/filtrado">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Tipo de Viatura</label>
                <select name="Tipo_viatura" onchange="hide()" class="form-control form-control-lg" id="Tipo_de_Viatura">
                    <option value="">Tipo de Viatura</option>
                    <option value="Carro">Carro</option>
                    <option value="Mota">Mota</option>
                </select>
            </div>

            <div class="form-group col-md-6" id="carro" style="display:initial;">
                <label for="exampleFormControlSelect1">Estrutura do Carro</label>
                <select name="tipo_carro" class="form-control form-control-lg" id="tipo_carro">
                    <option value="">Cupê</option>
                    <option value="Cupe">Cupê</option>
                    <option value="Crossover">Crossover</option>
                    <option value="Desportivo">Desportivo</option>
                    <option value="Hatchback">Hatchback</option>
                    <option value="Jipe">Jipe</option>
                    <option value="Pick-up">Pick-up</option>
                    <option value="Citadino">Citadino</option>
                    <option value="SUV">SUV</option>
                    <option value="Carrinha">Carrinha</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
            <div class="form-group col-md-6" id="mota" style="display:none;">
                <label for="exampleFormControlSelect1">Estrutura da Mota</label>
                <select name="tipo_mota" class="form-control form-control-lg" id="tipo_mota">
                    <option value="Scooter">Scooter</option>
                    <option value="Touring">Touring</option>
                    <option value="Supersport">Supersport</option>
                    <option value="Off-Road">Off-Road</option>
                    <option value="Naked">Naked</option>
                    <option value="Custom">Custom</option>
                    <option value="Citadina">Citadina</option>
                    <option value="Maxi-Trail">Maxi-Trail</option>
                    <option value="Carrinha">Carrinha</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="exampleFormControlSelect1">Preço</label>
                <input name="preco_min" type="number" class="form-control form-control-lg" placeholder="100€" id="preco_min">
                <input name="preco_max" type="number" class="form-control form-control-lg" placeholder="10000€" id="preco_max">
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlSelect1">Registo</label>
                <input name="ano_min" type="number" class="form-control form-control-lg" placeholder="1990" id="ano_min">
                <input name="ano_max" type="number" class="form-control form-control-lg" placeholder="2019" id="ano_max">
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlSelect1">KM</label>
                <input name="km_min" type="number" class="form-control form-control-lg" placeholder="0 KM" id="km_min">
                <input name="km_max" type="number" class="form-control form-control-lg" placeholder="200.000 KM" id="km_max">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-xs-1">
                <a href="#" id="gasolina" onclick="check1()"class="btn btncombu btn-lg">Gasolina</a>
            </div>
            <div class="form-group col-xs-1">
                <a href="#" id="gasoleo" onclick="check2()" class="btn btncombu btn-lg">Gasóleo</a>
            </div>
            <div class="form-group col-xs-1">
                <a href="#" id="gpl" onclick="check3()" class="btn btncombu btn-lg">GPL</a>
            </div>
            <div class="form-group col-xs-1">
                <a href="#" id="eletrico" onclick="check4()" class="btn btncombu btn-lg">Elétrico</a>
            </div>
            <div class="form-group col-md-12" style="display:none;">
                <input name="combus[gasolina]" id="checkgasolina" value="gasolina" class="form-check-input" type="checkbox">
                <label for="exampleFormControlSelect2">Gasolina</label><br>
                <input name="combus[gasoleo]" id="checkgasoleo" value="gasoleo" class="form-check-input" type="checkbox">
                <label for="exampleFormControlSelect2">Gasóleo</label><br>
                <input name="combus[gpl]" id="checkgpl" value="gpl" class="form-check-input" type="checkbox">
                <label for="exampleFormControlSelect2">GPL</label><br>
                <input name="combus[eletrico]" id="checkeletrico" value="eletrico" class="form-check-input" type="checkbox">
                <label for="exampleFormControlSelect2">Elétrico</label><br>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <button type="submit" class="btn searchbtn btn-lg" style="width:30%;">Filtrar</button>
            </div>
            <div class="col-md-4"></div>
        </div>
    </form>
</div>
</div>
<script>
    function hide() {
        var x = document.getElementById("Tipo_de_Viatura").value;
        if (x == "Mota") {
            document.getElementById('mota').style.display = "initial";
            document.getElementById('carro').style.display = "none";
        }
        if (x == "Carro") {
            document.getElementById('carro').style.display = "initial";
            document.getElementById('mota').style.display = "none";
        }
    }
    </script>
<script type="text/javascript" src="/js/combustivel.js"></script>
@endsection
