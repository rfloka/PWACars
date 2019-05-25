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
<h1 align="center">Viaturas</h1>
@if (count($veiculos) > 0 )
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Procurar por Titulo">
<table class="table table-hover" id="myTable">
    <thead class="thead">
        <tr style="background-color:#1C1C1C;color:#CDA52C">
            <th scope="col">ID</th>
            <th scope="col">Titulo</th>
            <th scope="col">Preço</th>
            <th scope="col">Data de Registo</th>
            <th scope="col">Inserido</th>
            <th scope="col"></th>
            <th scope="col"><a href="viaturas/adicionar/" class="btn btn-success" style="float:right;"><i class="fas fa-plus"></i></a></th>
        </tr>
    </thead>
    <tbody>
        @foreach($veiculos as $veiculo)
        
       <tr> 
            <th scope="row"> {{$veiculo->id}}</th>
            <td>{{$veiculo->titulo}}</td>
            <td>{{$veiculo->preco}}€</td>
            <td>{{$veiculo->registo}}</td>
            <td>{{$veiculo->created_at}}</td>
            <td colspan="3">
                <a class="btn btn-primary" href="/viaturas/{{$veiculo->id}}/show"><i class="fas fa-eye"></i></a>
                <a href="viaturas/{{$veiculo->id}}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                <a class="btn btn-danger" data-toggle="modal" data-target="#delete-{{$veiculo->id}}"><i class="fas fa-times"></i></a>
            </td>
        </tr>
        <div class="modal fade bd-example-modal-sm" tabindex="-1" id="delete-{{$veiculo->id}}" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="alert alert-danger" role="alert">
                        Eliminar {{$veiculo->titulo}}
                    </div>
                    <a href="viaturas/{{$veiculo->id}}/delete" class="btn btn-danger">Sim Eliminar</a>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>
@else
<h3 align="center">Sem Viaturas registadas</h3>
<a href="viaturas/adicionar/" class="btn btn-success"><i class="fas fa-plus"></i></a>
@endif
@endsection
@section('scripts')
<script>
        function myFunction() {
          // Declare variables 
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");
        
          // Loop through all table rows, and hide those who don't match the search query
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            } 
          }
        }
        </script>
@endsection

