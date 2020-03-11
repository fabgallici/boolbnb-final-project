@extends('layouts.base')
@section('apt-show')
@include('components.header')
<main class="main-show">

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

</div>
<hr>

@auth
    @if (Auth::user() -> id == $apartment -> user -> id)
        <a href="{{route('charts', $apartment -> id)}}">vedi stats</a>
    @endif
@endauth


</main>
@include('components.footer')
@endsection
