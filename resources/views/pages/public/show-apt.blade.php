@extends('layouts.base')
@section('apt-show')
@include('components.header')
<main>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>


    <div class="carousel-inner" style="height:600px">

        <div class="carousel-caption text-left" style="bottom:200px" >
            <h1>Vista sul Mare</h1>
            <p>Descrizione {{$apartment -> description}}</p>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Chiedi Informazioni</a></p>
        </div>
        <div class="carousel-item active">
            <img class="first-slide w-100" src="{{ $apartment -> image }}" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="second-slide w-100" src="{{ $apartment -> image }}" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="third-slide w-100" src="{{ $apartment -> image }}" alt="Third slide">
        </div>
    </div>


    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>

</div>

<div class="d-flex flex-wrap mt-3">
    <div class="col-4 p-5">
        <h3>Configurazione</h3>
        <span> Beds:{{$apartment -> beds}}</span>
        <p>Rooms: {{$apartment -> rooms}}</p>
        <p> M2:{{$apartment -> square_mt}}</p>
        <p> M2:{{$apartment -> sight_mt}}</p>
    </div>
    <div class="col-4 p-5">
        <h3>Descrizione</h3>
        <p> {{$apartment -> description}}</p>
    </div>
    <div class="col-4 p-5">
        <h3>Servizi</h3>
        @foreach ($apartment->configs as $config)
            <li> {{$config -> service}}</li>
        @endforeach
    </div>
    {{-- mettere anche il form --}}
</div>
<hr>
<div class="d-flex flex-wrap mt-3">
    <div class="col-12 p-5">
        <h3>Posizione dell'appartamento</h3>
        <p>{{$apartment -> address}}</p>
        <img class="map-img" src="" alt="apart-map">
        <div id="apart-map">
            <div class="data-lat" data-lat="{{ $apartment -> lat }}"></div>
            <div class="data-lon" data-lon="{{ $apartment -> lon }}"></div>
        </div>
    </div>
</div>

</main>

@include('components.footer')
@endsection
