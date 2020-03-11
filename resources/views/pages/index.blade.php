@extends('layouts.base')

@section('guest_index')
@include('components.header')

<main>
    @php
        $now = date('Y-m-d H:i:s');
    @endphp

    {{-- navbarbar --}}
    <div class="container-fluid wrapper main">
        <div class="container-fluid bg-index">
        </div>
        <div class="bg-index-gradient"></div>
        <div class="container-fluid wrapper">
            @include('components.search-bar')
        </div>
    </div>



    {{-- carousel --}}
    <div class="position-relative w-100" style="height:300px">
        <div id="carouselExampleIndicators" class="carousel col-9 slide m-auto position-absolute" style="top:calc(0% - 100px); left:50%; transform:translateX(-50%)" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($adApts -> chunk(3) as $key => $chunk)
                    <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                        <div class="d-flex justify-content-center">
                            @foreach ($chunk as $apt)
                                @if($apt -> ads_expired > $now)
                                    <div class="card flex-row" style="margin:20px; width:25%">
                                        <div class="wrapper">
                                            <img  class ="card-img-top w-100" src='{{asset ($apt -> image) }}'/>
                                            <div class="card-body w-100" style="">
                                                <p class="card-text"  style="height:80px; overflow-y:hidden">{{$apt -> description}}</p>
                                                <div class="d-flex justify-content-end">
                                                <a class="btn btn-primary" href="{{route (Auth::user() ? 'user-apt.show' :'guest-apt.show', $apt -> id )}}"> Più informazioni</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>
    </div>

    {{-- index --}}
    <div class="d-flex flex-wrap justify-content-center mt-5">
        @foreach ($apartments as $apartment)
            <div class="card flex-row w-25" style="margin:20px">
                <div class="wrapper">
                    <img  class ="card-img-top w-100" src='{{asset ($apartment -> image) }}'/>
                    <div class="card-body w-100" style="">
                        <p class="card-text"  style="height:80px; overflow-y:hidden">{{$apartment -> title}}</p>
                        <p class="card-text"  style="height:80px; overflow-y:hidden">{{$apartment -> description}}</p>
                        <div class="d-flex justify-content-end">

                        <a class="btn btn-primary" href="{{route (Auth::user() ? 'user-apt.show' :'guest-apt.show', $apartment -> id )}}"> Più informazioni</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="w-100 d-flex justify-content-center py-5">
        <div>
            {{$apartments->links()}}
        </div>
    </div>

</main>

@include('components.footer')
@endsection

