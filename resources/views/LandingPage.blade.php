@extends('layouts.base')
@section('title', 'Landing Page')
@section('content')
@php
 $i = 0;   
@endphp
<!-- carossel -->
<div class="bd-example">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators" id="arrow">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="item carousel-item active">
        <img src="/img/banner.png" class="banner d-block w-100" alt="...">
      </div>
      @foreach ($veiculos as $veiculo)
        @php
        if ($i++ == 2) break;
        @endphp
        
        <div class="item carousel-item">
            <a href="/viaturas/{{$veiculo->id}}/show">
          <img src="/storage/upload/viaturaspics/{{$veiculo->nome}}" class="anunci d-block " alt="...">
          <div class="caption carousel-caption d-md-block">
            <h4>{{$veiculo->titulo}}</h4>
            <h5>{{number_format($veiculo->preco)}}€</h5>
            <hr>
          </div>
        </a>
        </div>
        
      @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<!-- carossel -->
<!-- viaturas -->
<a href="/viaturas">
<div class="viaturas ">
  <div class="darken">
  <div class="zoom">
    <div id="viaturas">
      <i class="fas fa-car"></i>
      <h1>Viaturas</h1>
      <p>Veja o nosso stock de viaturas desde carros, motas, embarcações de A a Z</p>
    </div>
  </div>
  </div>
</div>
</a>
<a href="/servicos">
<div class="servicos">
  <div class="darken">
  <div class="zoom">
    <div id="servicos">
      <i class="fas fa-hands-helping"></i>
      <h1>Serviços</h1>
      <p>Veja os nossos serviços desde soluções de financiamento, consultoria automóvel </p>
    </div>
  </div>
  </div>
</div>
</a>
<a href="/mycar">
<div class="mycar">
  <div class="darken">
    <div class="zoom">
    <div id="mycar">
      <i class="fas fa-star"></i>
      <h1>MyCar</h1>
      <p>Diga-nos as características do seu carro de sonho e nós mostramos-lhe o seu futuro carro </p>
    </div>
  </div>
  </div>
</div>
</a>
<a href="/contactos">
  <div class="contactos">
    <div class="darken">
      <div class="zoom">
      <div id="contactos">
        <i class="fas fa-headset"></i>
        <h1>Contactos</h1>
        <p>Fale com o nosso staff </p>
      </div>
    </div>
    </div>
  </div>
</a>
@endsection
@section('scripts')
<script>
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[data-target="#"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      divid = $(target).attr('id');
      console.log(divid);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      
      if (divid != "carouselExampleCaptions") {
        if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 500, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
      }
    
    }
  });
</script>
@endsection