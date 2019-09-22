@extends('dashboard.Dashboard')
@section('title', 'Dashboard')
@section('admincontent')
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
<h1 align="center">Serviços</h1>
@if (count($servicos) > 0 )
<table class="table table-hover" id="myTable">
        <thead class="thead">
            <tr style="background-color:#1C1C1C;color:#B90FB9">
            <th scope="col">ID</th>
            <th scope="col">Servico</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Data</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($servicos as $servico)
        <tr>
            <th scope="row"> {{$servico->id}}</th>
            <td>{{$servico->servico}}</td>
            @if ($servico->nome_cliente == "no")
                <td>---------</td>
            @else
                <td>{{$servico->nome_cliente}}</td>
            @endif
            <td>{{$servico->email_cliente}}</td>
            <td>{{$servico->created_at}}</td>
            @if ($servico->visto === 0)
            <td>Por Abrir <i class="fas fa-exclamation" style="color:red;"></i></td>
            @else
                <td>Aberto <i class="fas fa-check" style="color:green;"></i> </td>
            @endif
            <td>
                <a href="servico/{{$servico->id}}" class="btn btn-success"><i class="fas fa-external-link-alt"></i></a>
                <a class="btn btn-danger" data-toggle="modal" data-target="#delete-{{$servico->id}}"><i class="fas fa-times"></i></a>
            </td>
        </tr>
        <div class="modal fade bd-example-modal-sm" tabindex="-1" id="delete-{{$servico->id}}" role="dialog"
                aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="alert alert-danger" role="alert">
                            Eliminar servico nº{{$servico->id}}
                        </div>
                        <a href="servicos/{{$servico->id}}/delete" class="btn btn-danger">Sim Eliminar</a>
                    </div>
                </div>
            </div>
        @endforeach
    </tbody>
</table>
@else
<h3 align="center">Sem Servicos registados</h3>
@endif
@endsection
