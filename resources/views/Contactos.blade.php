@extends('layouts.base')
@section('title', 'Contactos')
@section('content')
@if (session('alert'))
<div class="alert alert-success" role="alert" style="position:absolute;top:16%;left:1%;z-index:4;">
        {{ session('alert') }}
</div>
@endif

<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#redes" role="tab" aria-controls="home"
            aria-selected="true"><i class="fas fa-share-alt-square"></i> Contacto</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#mapa" role="tab" aria-controls="profile"
            aria-selected="false"><i class="fas fa-directions"></i> Mapa</a>
    </li>
</ul>
<div class="container-fluid" style="padding-bottom:36vh;">
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="redes" role="tabpanel" aria-labelledby="home-tab">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4  text-center">
                    <h1>Email</h1>
                    <form method="POST" action="contactos/mensagem">
                        @csrf
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend" >
                                    <div class="input-group-text" style="background-color:#161616;color:#CDA52C;"><i class="fas fa-at"></i></div>
                                </div>
                                <input type="email" name="email" class="form-control" id="inlineFormInputGroup"
                                    placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="mensagem" required placeholder="Mensagem" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btncontact  btn-block">Enviar</button>
                    </form>
                </div>
                <div class="col-md-4  text-center">
                    <h1>Redes Sociais</h1>
                    <div class="container redes">
                            <a href="https://www.facebook.com/essencialcarr/"> <i class="fab fa-facebook-square"></i></a>
                        
                        <a> <i class="fab fa-twitter-square"></i><br></a>
                        <a href="https://www.instagram.com/essencialcar/"> <i class="fab fa-instagram"></i></a>
                        <a><i class="fab fa-youtube"></i><br></a>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <h1>Telefone</h1>
                <div class="tele">
                    <i class="fas fa-phone"></i> 915547895<br>
                    <i class="fas fa-phone"></i> 962587458
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade text-center" id="mapa" role="tabpanel" aria-labelledby="profile-tab">
        <h1>Morada</h1>
        <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=Estarreja&t=&z=13&ie=UTF8&iwloc=&output=embed"
            frameborder="0" scrolling="no"></iframe>
    </div>
</div>
</div>
@endsection