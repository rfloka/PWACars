@extends('layouts.base')
@section('title', 'Serviços')
@section('content')
<div class="container-fluid">
    @if (session('alert'))
        <div class="alert alert-success" role="alert">
                {{ session('alert') }}
        </div>
    @endif
    <h1 align="center" style="margin-top:20px;margin-bottom:25px;">Serviços</h1>
    <div class="row justify-content-md-center" style="margin-bottom:25px;">
        <form method="POST" action="servicos/enviar">
            @csrf
            <div class="form-row">
                @guest
                <div class="form-group col-md-4">
                    <label class="sr-only" for="inlineFormInputGroup">Name</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text" style="background-color:#161616;color:#CDA52C;"><i
                                    class="fas fa-user"></i></div>
                        </div>
                        <input type="text" pattern="[A-Za-z]{2,30}" title="Tem que ter entre 2 e 20 caracteres" class="form-control" id="name1" name="name" placeholder="Nome">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label class="sr-only" for="inlineFormInputGroup">Email</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text" style="background-color:#161616;color:#CDA52C;"><i
                                    class="fas fa-envelope"></i></div>
                        </div>
                        <input type="email" class="form-control" id="email1" name="email" placeholder="Email">
                    </div>
                </div>
                @else
                <div class="form-group col-md-4">
                    <label class="sr-only" for="inlineFormInputGroup">name</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text" style="background-color:#161616;color:#CDA52C;"><i
                                    class="fas fa-user"></i></div>
                        </div>
                        <input type="text"  pattern="[A-Za-z]{2,30}" title="Tem que ter entre 2 e 20 caracteres sem numeros" class="form-control" id="name2" name="name" value="{{Auth::user()->name}}">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label class="sr-only" for="inlineFormInputGroup">email</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text" style="background-color:#161616;color:#CDA52C;"><i
                                    class="fas fa-envelope"></i></div>
                        </div>
                        <input type="email" class="form-control" id="inlineFormInputGroup" id="email" name="email"
                            value="{{Auth::user()->email}}">
                    </div>
                </div>
                @endguest
                <div class="form-group col-md-4">
                    <label class="sr-only" for="inlineFormInputGroup">Telefone</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text" style="background-color:#161616;color:#CDA52C;"><i
                                    class="fas fa-phone"></i></div>
                        </div>
                        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-row" style="margin-bottom:20px;">
                <label for="exampleFormControlSelect1">Serviços</label>
                <select onchange="change()" name="servicos" class="form-control" id="servicos">
                    <option value="consultoria auto">Consultoria Automóvel</option>
                    <option value="financiamento">Financiamento</option>
                    <option value="importados">Legalização de Veiculos Importados</option>
                    <option value="extras">Legalização de Extras</option>
                </select>
            </div>
            <hr>
            <div id="consultoria" style="display:inicial;">
                <h4>Viatura Pretendida</h4>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Modelo">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="versao" name="versao" placeholder="Versão">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                            <label for="exampleFormControlSelect1">Combustivel</label>
                            <select class="form-control" name="combustivel" id="exampleFormControlSelect1">
                                <option value=""></option>
                                <option value="gasolina">Gasolina</option>
                                <option value="gasoleo">Gasóleo</option>
                                <option value="gpl">Gpl</option>
                                <option value="eletrico">Elétrico</option>
                            </select>
                    </div>
                    <div class="col-sm-4">
                            <label for="exampleFormControlSelect1">Transmissão</label>
                            <select class="form-control" name="transmissao" id="exampleFormControlSelect1">
                                <option value=""></option>
                                <option value="automatico">Automático</option>
                                <option value="manual">Manual</option>
                                <option value="mista">Mista</option>
                            </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="exampleFormControlSelect1">Cilindrada</label>
                        <input type="number" class="form-control" id="cilindrada" name="cilindrada" placeholder="10000">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input type="number" class="form-control" id="ano_min" name="ano_min" placeholder="Ano Minimo">
                    </div>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" id="km_max" name="km_max" placeholder="Km Maximo">
                    </div>
                </div>
            </div>
            <div id="financiamento" style="display:none;">
                <h4>Financiamento</h4>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <input type="number" class="form-control" id="preco" name="preco"
                            placeholder="Preço do Veiculo">
                    </div>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" id="entrada_ini" name="entrada_ini"
                            placeholder="Entrada Inicial">
                    </div>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" id="prazo" name="prazo" placeholder="Prazo em Meses">
                    </div>
                </div>
            </div>
            <div id="importados" style="display:none;">
                <h4>Legalização de Veiculos Importados</h4>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="marca1" name="marca1" placeholder="Marca">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="modelo1" name="modelo1" placeholder="Modelo">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="versao1" name="versao1" placeholder="Versão">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <div class="col-sm-4"><label>Ano Registo</label></div>
                            <div class="col-sm-8"><input type="month" class="form-control" name="ano1" id="ano1"
                                    placeholder="Ano de Registo"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="pais" name="pais" placeholder="Pais de Origem">
                    </div>
                </div>
            </div>

            <div id="extras" style="display:none;">
                <h4>Legalização de Extras</h4>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="marca2" name="marca2" placeholder="Marca">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="modelo2" name="modelo2" placeholder="Modelo">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="versao2" name="versao2" placeholder="Versão">
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Mensagem</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="mensagem" rows="6" required></textarea>
            </div>
            <button type="submit" class="btn btncontact" style="width:150px;">Enviar</button>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
        function change() {
            var x = document.getElementById("servicos").value;
            switch (x) {
                case "consultoria auto":
                    document.getElementById('consultoria').style.display = "initial";
                    document.getElementById('financiamento').style.display = "none";
                    document.getElementById('importados').style.display = "none";
                    document.getElementById('extras').style.display = "none";
                    break;
                case "financiamento":
                    document.getElementById('consultoria').style.display = "none";
                    document.getElementById('financiamento').style.display = "initial";
                    document.getElementById('importados').style.display = "none";
                    document.getElementById('extras').style.display = "none";
                    break;
                case "importados":
                    document.getElementById('consultoria').style.display = "none";
                    document.getElementById('financiamento').style.display = "none";
                    document.getElementById('importados').style.display = "initial";
                    document.getElementById('extras').style.display = "none";
                    break;
                case "extras":
                    document.getElementById('consultoria').style.display = "none";
                    document.getElementById('financiamento').style.display = "none";
                    document.getElementById('importados').style.display = "none";
                    document.getElementById('extras').style.display = "initial";
                    break;
    
                default:
                    break;
            }
    
        }
    </script>
@endsection