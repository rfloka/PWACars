@extends('layouts.base')
@section('title', $viaturas->titulo)
@section('content')
@php
$j = 0;
$i = 0;
@endphp
@if (session('alert'))
<div class="alert alert-success" role="alert">
        {{ session('alert') }}
</div>
@endif
    <div class="divfullscreen"  id="fullscreen">
        <button id="close" class=" btn btn-danger " onclick="fullclose()"><i
                class="fas fa-times"></i></button>
        <!--Carousel Wrapper-->
        <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
            <!--Slides-->
            <div class="carousel-inner" role="listbox">
                @foreach ($fotos as $foto)
                @if ($foto->head == 1)
                <div class="carousel-item active">
                    <img class="fullimg" src="/storage/upload/viaturaspics/{{$foto->nome}}" alt="First slide">
                </div>
                @else
                <div class="carousel-item">
                    <img class="fullimg" src="/storage/upload/viaturaspics/{{$foto->nome}}" alt="First slide">
                </div>
                @endif
                @endforeach
            </div>
        </div>

        <!--/.Slides-->
            <a class="setapref carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                <i class="fas fa-chevron-left"></i>
            </a>
            <a class="setanext carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                <i class="fas fa-chevron-right"></i>
            </a>

    </div>


<div class="container-fluid" id="content">

    <div class="row">
        <div class="col-xl-9" style="margin-left:-2%">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-11">
                        <!--Carousel Wrapper-->
                        <div id="carousel-thumbs" class="carousel slide carousel-fade carousel-thumbnails"
                            data-ride="carousel">
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
                                <button class="btn btn-primary fullscreen" style="border-color:#B90FB9;z-index:2;"
                                    onclick="full()"><i class="fas fa-expand"></i></button>
                                @foreach ($fotos as $foto)
                                @if ($foto->head == 1)
                                <div class="carousel-item active caro" style="background-color:#161616;">
                                    <img class="d-block w-100" src="/storage/upload/viaturaspics/{{$foto->nome}}"
                                        alt="First slide" style="object-fit: contain;">
                                </div>
                                @else
                                <div class="carousel-item caro" style="background-color:#161616;">
                                    <img class="d-block w-100" src="/storage/upload/viaturaspics/{{$foto->nome}}"
                                        alt="First slide" style="object-fit: contain;">
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carousel-thumbs" role="button" data-slide="prev">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a class="carousel-control-next" href="#carousel-thumbs" role="button" data-slide="next">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                    <!--/.Slides-->
                    <div class=" col col-lg-1 thumb">
                        <ol class="carousel-indicators">
                            <div class="carousel-inner">
                                @foreach ($fotos as $foto)
                                <li data-target="#carousel-thumbs" data-slide-to="{{$j}}" class="active"> <img
                                        class="d-block w-100" src="/storage/upload/viaturaspics/{{$foto->nome}}"
                                        class="img-fluid"></li>
                                @php
                                $j++;
                                @endphp
                                @endforeach
                            </div>
                        </ol>
                    </div>
                </div>
            </div>
            <!--/.Carousel Wrapper-->
        </div>
        <div class="col-xl-3 info">
            <h1>{{$viaturas->titulo}}</h1>
            <h3>{{number_format($viaturas->preco)}}€</h3>
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <p><b>Modelo:</b> {{$viaturas->modelo}}</p>
                        <p><b>Combustivel:</b> {{$viaturas->combustivel}}</p>
                        <p><b>Registo:</b> {{$viaturas->registo}}</p>
                        <p><b>Cilindrada:</b> {{number_format($viaturas->cilindrada)}}cc</p>
                        <p><b>Garantia:</b>@if ($viaturas->garantia=="com_garantia")
                            <i class="fas fa-check-circle" style="color:#B90FB9"></i>
                            @else
                            <i class="fas fa-times-circle" style="color:red"></i>
                            @endif</p>
                    </div>
                    <div class="col-6">
                        <p><b>Tipo:</b> {{$viaturas->tipo}}</p>
                        @if ($viaturas->km == 0)
                        <p><b>KM:</b> Novo</p>
                        @else
                        <p><b>KM:</b> {{number_format($viaturas->km)}}km</p>
                        @endif
                        <p><b>Cor:</b> {{$viaturas->cor}}</p>
                        <p><b>Potencia:</b> {{number_format($viaturas->potencia)}}cv</p>
                        <p><b>Portas:</b> {{$viaturas->portas}}</p>
                    </div>
                </div>

                @guest
                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Faça Login">
                    <button class="btn btn-primary"
                        style="background-color:#B90FB9;border-color:#B90FB9;pointer-events:none;" type="button"
                        disabled><i class="fas fa-star"></i></button>
                </span>
                @else
                @if ($mycar == true)
                <button id="unfav" onclick="unfav({{$viaturas->id}})" class="btn btn-primary"
                    style="background-color:#B90FB9;border-color:#B90FB9;"><i class="fas fa-star"></i></button>
                @else
                <button id="fav" onclick="fav({{$viaturas->id}})" class="btn btn-primary btnfav"><i
                        class="fas fa-star"></i></button>
                @endif
                @endguest
                <button class="btn btn-primary btncontact" data-toggle="modal"
                    data-target="#contactar">Contactar</button>

            </div>
        </div>
        <div id="extras" class="row extras">
            <h1>Extras</h1>
            <div class="col-12 extra">
                {!!$viaturas->extras!!}
            </div>
        </div>
        <div class="modal fade" id="contactar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header loginheader">
                        <h5 class="modal-title" id="exampleModalLabel">Contactar para Compra</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="contactar">
                            @csrf
                            <div class="form-row">
                                @guest
                                <div class="form-group col-md-4">
                                    <label class="sr-only" for="inlineFormInputGroup">Name</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"
                                                style="background-color:#161616;color:#B90FB9;"><i
                                                    class="fas fa-user"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="name1" name="name"
                                            placeholder="Nome" pattern=".{2,30}" title="Tem que ter entre 2 e 30 caracteres" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="sr-only" for="inlineFormInputGroup">Email</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"
                                                style="background-color:#161616;color:#B90FB9;"><i
                                                    class="fas fa-envelope"></i></div>
                                        </div>
                                        <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="email" class="form-control" id="email1" name="email"
                                            placeholder="Email" title="Tem que ser um email válido" required>
                                    </div>
                                </div>
                                @else
                                <div class="form-group col-md-4">
                                    <label class="sr-only" for="inlineFormInputGroup">name</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"
                                                style="background-color:#161616;color:#B90FB9;"><i
                                                    class="fas fa-user"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="name2" name="name"
                                            value="{{Auth::user()->name}}" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="sr-only" for="inlineFormInputGroup">email</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"
                                                style="background-color:#161616;color:#B90FB9;"><i
                                                    class="fas fa-envelope"></i></div>
                                        </div>
                                        <input type="email" class="form-control" id="inlineFormInputGroup" id="email"
                                            name="email" value="{{Auth::user()->email}}" required>
                                    </div>
                                </div>
                                @endguest
                                <div class="form-group col-md-4">
                                    <label class="sr-only" for="inlineFormInputGroup">Telefone</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"
                                                style="background-color:#161616;color:#B90FB9;"><i
                                                    class="fas fa-phone"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="telefone" name="telefone"
                                            placeholder="Telefone" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div id="consultoria" style="display:inicial;">
                                <h4>Viatura Pretendida</h4>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <input type="hidden" name="id" value="{{$viaturas->id}}">
                                        <input type="text" class="form-control" id="marca" name="marca"
                                            value="{{$viaturas->marca}}" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="modelo" name="modelo"
                                            value="{{$viaturas->modelo}}" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Mensagem</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="mensagem"
                                        rows="6" required></textarea>
                                </div>
                                <button type="submit" class="btn btncontact" style="width:150px;">Enviar</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('scripts')
        <script>

            function full() {
                document.getElementById("content").style.overflow = "hidden";
                document.getElementById("fullscreen").style.display = "block";
                document.getElementsByTagName("body").style.WebkitTransform = "rotate(90deg)";
            }
            function fullclose() {
                document.getElementById("content").style.overflow = "initial";
                document.getElementById("fullscreen").style.display = "none";
            }
            function unfav(id) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: 'unfav',
                    data: { car_id: id },
                    async: false
                });
                document.getElementById("unfav").style.backgroundColor = "#202020";
                document.getElementById("unfav").style.color = "white";
                location.reload();
            }
            function fav(id) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: 'fav',
                    data: { car_id: id },
                    async: false
                });
                document.getElementById("fav").style.backgroundColor = "#B90FB9";
                document.getElementById("fav").style.color = "white";
                location.reload();
            }
        </script>
        @endsection
