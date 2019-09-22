@extends('dashboard.Dashboard')
@section('title', 'Dashboard')
@section('admincontent')
<div class="container">
    <div class="text-center">
        <h2>Servico nº:{{$servicos->id}}</h2>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p><b>Servico: </b>{{$servicos->servico}}</p>
            <p><b>Email: </b>{{$servicos->email_cliente}}</p>
            @if ($servicos->nome_cliente != null)
            <p><b>Nome: </b>{{$servicos->nome_cliente}}</p>
            @endif
            @if ($servicos->telefone_cliente != null)
            <p><b>Telefone: </b>{{$servicos->telefone_cliente}}</p>
            @endif

        @if( $servicos->servico == "contacto_compra")
            <p><b>Viatura:</b><a href="/viaturas/{{$info[0]}}/show" style="color:#B90FB9;"> {{$info[1]}}
                    {{$info[2]}}</a>
            </p>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12 extra">
            {{$info[3]}}
        </div>
    </div>
    @else
    <div class="row">
            <div class="col-12 extra">
                <ul>
                    @foreach ($info as $inf)
                    <li>{{$inf}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
</div>

@endif
</div>
@endsection
