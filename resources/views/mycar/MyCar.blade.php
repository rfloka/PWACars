@extends('layouts.base')
@section('title', 'MyCar')
@section('links')
@endsection
@section('content')
<div id="dom-target" style="display:none;"><?php echo ($viaturas);?></div>
<div id="colec" class="container-fluid mycarcontai">
    <div id="swiper" class="swiper">
        <div id="swiper-card" class="swiper-card">
            <img src="#" draggable="false" class="swiper-card-img"/>
            <section class="swiper-card-info" style="background-color:#161616;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-times" style="color:#ff0000;"></i>
                        </div>
                        <div class="col-8">
                            <h1 class="swiper-card-name" style="color:#ffff;"></h1>
                            <p class="swiper-card-location" style="color:#B90FB9;"></p>
                        </div>
                        <div class="col-2">
                            <i class="fas fa-check" style="color:#2ec600;"></i>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>
<div id="fim" class="container-fluid mycarcontai" style="background-color:#161616;display:none;">
    <div>
        <div class="swiper">
            <div class="swiper-card">
                <img src="/img/banner.png" draggable="false" class="swiper-card-img" />
                <section class="swiper-card-info">
                    <h1 class="swiper-card-name" style="color:#ffff;">A coleção acabou</h1>
                    <h2 class="swiper-card-location" style="color:#B90FB9;">Visite o seu perfil e veja a sua coleção
                    </h2>
                </section>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript" src="{{ URL::asset('js/tinder.js') }}"></script>
@endsection
