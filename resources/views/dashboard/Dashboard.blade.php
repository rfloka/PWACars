@extends('layouts.base')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidenav">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="/admin"><i class="fas fa-chart-line"></i> Site</a></li>
                <li class="nav-item"><a href="/admin/viaturas"><i class="fas fa-car"></i> Viaturas</a></li>
                <li class="nav-item"><a href="/admin/users"><i class="fas fa-users"></i> Utilizadores</a></li>
                <li class="nav-item"><a href="/admin/servicos"><i class="fas fa-concierge-bell"></i> Serviços</a></li>
            </ul>
        </div>
        <div class="admincontent col-10">
               @yield('admincontent')
        </div>
    </div>

</div>
@endsection