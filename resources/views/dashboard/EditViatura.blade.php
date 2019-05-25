@extends('dashboard.Dashboard')
@section('title', 'Dashboard')
@section('admincontent')
<div class="container">
    <br>
    @if (session('alert'))
        <div class="alert alert-success" role="alert">
                {{ session('alert') }}
        </div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
                {{ $error }}
        </div>
        @endforeach
    @endif
    <h2>Editar Viatura</h2>
    <form method="POST" action="/admin/viaturas/{{$viatura->id}}/update" id="form_viatura" enctype="multipart/form-data">
        @csrf
        <small>* obrigatório</small>
        <div class="form-group">
            <label for="exampleFormControlInput1">Titulo*</label>
        <input type="text" class="form-control" name="titulo" id="Titulo" value="{{$viatura->titulo}}" required>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="exampleFormControlSelect1">Tipo de Viatura</label>
                <select name="Tipo_viatura" onchange="hide()" class="form-control" id="Tipo_de_Viatura">
                    <option value="Carro">Carro</option>
                    <option value="Mota">Mota</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlInput1">Marca*</label>
                <input type="text" class="form-control" value="{{$viatura->marca}}" name="marca" id="Marca" required>
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlInput1">Modelo*</label>
                <input type="text" class="form-control" value="{{$viatura->modelo}}" name="modelo" id="Modelo" required>
            </div>
        </div>
        <!-- Estrutura -->
        <div class="form-group" id="carro1" style="display:initial;">
            <label for="exampleFormControlSelect1">Estrutura do Carro</label>
            <select name="tipo_carro" class="form-control" id="tipo_carro">
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
        <div class="form-group" id="mota1" style="display:none;">
            <label for="exampleFormControlSelect1">Estrutura da Mota</label>
            <select name="tipo_mota" class="form-control" id="tipo_mota">
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
        <!-- Estrutura -->
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="exampleFormControlInput1">Preço*</label>
                <input name="preco" type="number" value="{{$viatura->preco}}" class="form-control" id="preco" required>
            </div>
            <div class="form-group col-md-3">
                <label for="exampleFormControlInput1">KM*</label>
                <input name="km" type="number" value="{{$viatura->km}}" class="form-control" id="km" required>
            </div>
            <div class="form-group col-md-3">
                <label for="exampleFormControlInput1">Data de Registo*</label>
                <input name="registo" type="month" value="{{$viatura->registo}}" class="form-control" id="registo" required>
            </div>
            <div class="form-group col-md-3">
                <label for="exampleFormControlSelect1">Garantia</label>
                <select name="garantia" class="form-control" id="garantia">
                    <option value="com_garantia">Com Garantia</option>
                    <option value="sem_garantia">Sem Garantia</option>
                    <option value="outro">Outro</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Combustivel</label>
            <select name="combustivel" class="form-control" id="combustivel">
                <option value="Gasolina">Gasolina</option>
                <option value="GPL">GPL</option>
                <option value="Gasoleo">Gasóleo</option>
                <option value="Eletrico">Elétrico</option>
                <option value="Outro">Outro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Cor</label>
            <input name="cor" type="text" value="{{$viatura->cor}}" class="form-control" id="cor">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="exampleFormControlInput1">Cilindrada*</label>
                <input name="cilindrada" type="Number" value="{{$viatura->cilindrada}}" class="form-control" id="cilindrada" required>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleFormControlInput1">Potencia*</label>
                <input name="potencia" type="text" value="{{$viatura->potencia}}" class="form-control" id="potencia" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="exampleFormControlInput1">Portas</label>
                <input name="portas" type="number" value="{{$viatura->portas}}" class="form-control" id="portas">
            </div>
            <div class="form-group col-md-6">
                <label for="exampleFormControlInput1">Lotação</label>
                <input name="lotacao" type="number" value="{{$viatura->lotacao}}" class="form-control" id="lotacao">
            </div>
        </div>
        <!-- caixa tracao -->
        <div class="form-row" id="carro2" style="display:initial;">
            <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Caixa de Transmissão</label>
                <select name="caixa" class="form-control" id="caixa">
                    <option value="Manual">Manual</option>
                    <option value="Automatico">Automático</option>
                    <option value="Semiautomatico">Semiautomático</option>
                    <option value="CVT">CVT</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Tracção</label>
                <select name="tracao" class="form-control" id="tracao">
                    <option value="tracao_4x4">Tração 4x4</option>
                    <option value="tracao_AWD">Tração AWD</option>
                    <option value="tracao_4x2_dianteira">Tração 4x2 Dianteira</option>
                    <option value="tracao_4x2_traseira">Tração 4x2 Traseira</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
        </div>
        <div class="form-row" id="mota2" style="display:none;">
            <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Transmissão</label>
                <select name="caixa_mota" class="form-control" id="caixa_mota">
                    <option value="Corrente">Corrente</option>
                    <option value="Correia">Correia</option>
                    <option value="Carda">Cardã</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Tracção</label>
                <select name="tracao_mota" class="form-control" id="tracao_mota">
                    <option value="Mota">Mota</option>
                    <option value="tracao_4x4">Tração 4x4</option>
                    <option value="tracao_4x2_dianteira">Tração 4x2 Dianteira</option>
                    <option value="tracao_4x2_traseira">Tração 4x2 Traseira</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
        </div>
        <!-- caixa tracao -->
        <hr>
        <div class="form-group" >
                <label for="exampleFormControlSelect1">Fumador</label>
                <select name="fumador" class="form-control" id="fumador">
                    <option value=0>Não</option>
                    <option value=1>Sim</option>
                </select>
            </div>
        <hr>
        <div class="form-group">
                <label for="exampleFormControlFile1">Adicionar Fotografias</label>
                <input name="fotos[]" type="file" class="form-control-file" id="fotos" multiple>
        </div>
        <div class="row" style="height:230px;overflow:auto;">
                @forelse ($fotos as $foto)
                    <div class="col-3" >
                        <a href="/admin/viaturas/{{$foto->id}}/deletefoto" class="btn btn-danger"><i class="fas fa-times"></i></a>
                        @if ($foto->head == true)
                            <span>Foto Principal</span>                            
                        @else
                            <a href="/admin/viaturas/{{$foto->id}}/changehead" class="btn btn-primary">Por como principal</a>
                        @endif
                        <img src="/storage/upload/viaturaspics/{{$foto->nome}}" class="img-fluid" alt="...">
                    </div>
                @empty
                    <div class="alert alert-warning" role="alert">
                        Sem Fotografias
                    </div>
                @endforelse
        </div>
        <hr>
        <div>
            <label for="exampleFormControlTextarea1">Extra</label>
            <textarea name="extra" class="form-control" id="article-ckeditor" rows="5">{!!$viatura->extras!!}</textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
    <br>
</div>
<!--editor-->
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('article-ckeditor');
</script>
<!--editor-->
<!--options-->
<script>
    function hide() {
        var x = document.getElementById("Tipo_de_Viatura").value;
        if (x == "Mota") {
            document.getElementById('mota1').style.display = "initial";
            document.getElementById('mota2').style.display = "initial";
            document.getElementById('carro1').style.display = "none";
            document.getElementById('carro2').style.display = "none";
            document.getElementById("portas").readOnly = true;
            document.getElementById("fumador").readOnly = true;
        }
        if (x == "Carro") {
            document.getElementById('carro1').style.display = "initial";
            document.getElementById('carro2').style.display = "initial";
            document.getElementById('mota1').style.display = "none";
            document.getElementById('mota2').style.display = "none";
            document.getElementById("portas").readOnly = false;
            document.getElementById("fumador").readOnly = false;
        }
    }      
</script>
<script>

</script>
@endsection