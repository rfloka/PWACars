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
<h1 align="center">Utilizadores</h1>
@if (count($users) > 0 )
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Procurar por nome">
<table class="table table-hover" id="myTable">
    <thead class="thead">
        <tr style="background-color:#1C1C1C;color:#CDA52C">
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Tipo de Utilizador</th>
            <th scope="col">Data de Registo</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <th scope="row"> {{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            @switch($user->role)
            @case(1)
            <td><i class="fas fa-user-cog"></i> Administrador</td>
            @break
            @case(0)
            <td><i class="fas fa-user"></i> Utilizador</td>
            @break
            @endswitch
            <td>{{$user->created_at}}</td>
            <td><a href="users/perfil/{{$user->id}}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
            @if (Auth::user()->id != $user->id )
                <a class="btn btn-danger" data-toggle="modal" data-target="#delete-{{$user->id}}"><i class="fas fa-times"></i></a>
            @endif
                
            </td>
        </tr>
        <div class="modal fade bd-example-modal-sm" tabindex="-1" id="delete-{{$user->id}}" role="dialog"
                aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="alert alert-danger" role="alert">
                            Eliminar {{$user->name}}
                        </div>
                        <a href="users/{{$user->id}}/delete" class="btn btn-danger">Sim Eliminar</a>
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