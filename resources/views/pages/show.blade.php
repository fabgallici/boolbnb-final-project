@extends('layouts.base')
@section('apt-show')
@include('components.header')
@php
    $now = date('Y-m-d H:i:s');
@endphp
<main class='main-show nav-fix pb-5'>
    <p id="notouchid">{{$apartment->id}}</p>
    <div class="jumbotron jumbotron-fluid" style="background-image: url('{{asset($apartment->image)}}');">

        {{-- status guest/upr/upra --}}
        <div class="container-fluid">
            <div class="greetings-sub d-flex flex-column offset-xl-1 col-6" >
                @if(auth()->user() && Auth::user() -> id != $apartment -> user -> id || auth()->guest())
                    <p> <i class="fas fa-thumbs-up"></i> Ti piace questo<br>
                        Appartamento? Compila<br>
                        il form e invia al propietario!
                    </p>
                    <p><a class="btn btn-lg btn-primary plus-info" href="#plus-info" data-scroll="plus-info" role="button">Chiedi Informazioni</a></p>
                @endif


                @if(auth()->user() && Auth::user() -> id == $apartment->user->id)
                @if(isset($apartment->ads_expired) && (\Carbon\Carbon::now())->diffInDays($apartment->ads_expired, false) >= 0)
                    <p> <i class="fas fa-bahai"></i> Il tuo appartamento <br>
                        è visibile in vetrina, <br>non farlo scadere!<br>
                    </p>
                    <button class="btn btn-danger mt-2" data-toggle="modal" data-target="#payment-modal">più info</button>
                @else
                    <p> <i class="fas fa-bahai"></i> Rendi il tuo appartamento <br>
                        visibile tra i primi i risultati!<br>
                    </p>
                    <button class="btn btn-danger mt-2" data-toggle="modal" data-target="#payment-modal">Attiva ora!</button>
                @endif
                @endif
            </div>
        </div>

        {{-- Apartment MAP --}}
        <div class="main-wrapper px-md-5">

            <div class="d-flex justify-content-end">
                <div  id="apart-map" style="height:500px; width:500px;">
                    <div class="data-lat" data-lat="{{ $apartment -> lat }}"></div>
                    <div class="data-lon" data-lon="{{ $apartment -> lon }}"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- apt data: TITLE --}}
    <div class="col-xl-9 div-colored offset-xl-1 p-0">
        <h1>&#8220; {{ $apartment->title }} &#8221;</h1>
    </div>

    {{-- apt data: CONFIGS --}}
    <div class="infos d-flex mt-5" id="plus-info">
        <div class="infos_right col-6 p-0 py-3">
            <div class="infos_right--wrap offset-2 col-9">
                <div class="d-flex flex-column mt-3 div-config">
                    <div class="px-5 pt-4">
                        <h3>Descrizione</h3>
                        <p> {{$apartment -> description}}</p>
                    </div>
                    <div class="px-5 mt-5">
                        <h5 class="text-uppercase">Dove si trova</h5>
                        <li>{{$apartment -> address}}</li>
                    </div>
                    <div class="sub-config d-flex flex-row pb-4">
                        <div class="px-5 mt-5 ">
                            <h5 class="text-uppercase">Configurazione</h5>
                            <li>Letti: {{$apartment -> beds}}</li>
                            <li>Stanze: {{$apartment -> rooms}}</li>
                            <li>Metri quadri: {{$apartment -> square_mt}}</li>
                        </div>
                        <div class="px-5 my-5 ">
                            <h5 class="text-uppercase">Servizi</h5>
                            @foreach ($apartment->configs as $config)
                                <li> {{$config -> service}}</li>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            {{--  --}}
        </div>
        <div class="infos_left col-6 p-0 py-3" >
            <div class="infos_left--wrap d-flex flex-column col-9 offset-1">
                {{-- info user interaction --}}
                @auth
                    @if (Auth::user() -> id == $apartment -> user -> id)
                        <div class="mt-3 div-count px-5">
                            <h3>Il tuo appartamento ha ricevuto:</h3>
                        <h4>@if($apartment->views == 1) 1 visualizzazione @else {{ $apartment -> views }} visualizzazioni @endif</h4>
                        </div>
                        <div class="view-stats px-5 mt-5">
                            <h5 class="text-uppercase"> Vuoi vedere le statische di questo appartamento?</h5>
                            <p class="mb-1">Clicca qui <i class="far fa-hand-point-down"></i></p>
                            <div class="">
                                <a class="btn btn-info"href="{{route('charts', $apartment -> id)}}" data-toggle="modal" data-target="#charts-modal">Vedi Statistiche</a>
                            </div>
                            <div>
                                <button class="btn btn-outline-dark mt-4" type="button" data-toggle="collapse" data-target="#bh-options" aria-expanded="false" aria-controls="optionsCollapse">
                                    Opzioni
                                </button>
                                <div class="bh-options collapse" id="bh-options">
                                    <div class="wrap-option d-flex pt-4">
                                        <a class="btn btn-primary mr-4" href="{{route('user-apt.edit', $apartment->id)}}" role="button">Modifica</a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal-apt" data-delid="{{$apartment->id}}">
                                            ELIMINA
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif
                @endauth


                {{-- form not upra / upr only--}}
                @if(auth()->user() && Auth::user() -> id != $apartment -> user -> id || auth()->guest())
                    <form class="mt-4" id="uploadForm" method="POST" action="{{route('mail-store')}}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="email" class="col-form-label py-2">Indirizzo Email</label>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" name="email" value="{{ auth()->user() ? Auth::user() -> email : "" }}" required autocomplete="off">
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }} formField mt-5">
                            <label for="comment">Contatta il proprietario per maggiori info</label>
                            <input type="hidden" name="id" value=" {{$apartment -> user -> id}} ">
                            <input type="hidden" name="id-apt" value=" {{$apartment -> id}} ">
                            <textarea class="form-control" rows="5" name="text" maxlength="750"></textarea>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" name="button" class="btn btn-primary">Invia</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>




    {{-- -------------------------- --}}
    {{-- modal --}}
    <div class="charts-modal modal fade" id="charts-modal" tabindex="-1" role="dialog" aria-labelledby="charts-modal" aria-hidden="true">
        <div class="d-flex w-100 h-100 align-items-center">
            <div class="modal-dialog" role="document" style="border:1px solid green">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title px-5" id="exampleModalLabel">Statistiche del tuo appartamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex flex-column justify-content-center" >
                        <div class="container-fluid d-flex flex-column align-items-center container-stats">
                            {{-- selection year --}}
                            <div class="form-group w-100 select-year">
                                <select class="col-6 col-md-4 form-control m-auto text-center" id="year_selection" >
                                    <option value="2020" selected>2020</option>
                                    <option value="2019" >2019</option>
                                    <option value="2018">2018</option>
                                </select>
                            </div>
                            <div class="chart-container">
                                <canvas id="messagesChart"></canvas>
                            </div>
                            <div class="chart-container">
                                <canvas id="viewsChart"></canvas>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="payment-modal modal fade" id="payment-modal" tabindex="-1" role="dialog" aria-labelledby="payment-modal" aria-hidden="true">
        <div class="d-flex w-100 h-100 align-items-center">
            <div class="modal-dialog" role="document" style="border:1px solid green">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title px-5" id="exampleModalLabel">Seleziona un'offerta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex flex-column justify-content-center" >
                        @auth
                            @if(Auth::user()->id == $apartment->user->id and $apartment->ads_expired > $now)
                                <div class="ad-result">
                                    <p>Hai una sponsorizzazione attiva  </p>

                                    <p>scadrà giorno:</p>
                                    {{-- per tirarsi fuori i pagamenti precedenti  --}}
                                    @foreach ($apartment->ads  as $ad)
                                        @if($loop->last)
                                            <p>{{$ad->pivot->expire_date}}</p>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <form action="{{route('payment.pay', $apartment->id)}}" method="get">
                                @csrf
                                    @if (Auth::user()->id == $apartment->user->id)
                                        <div class="alert alert-success">
                                            <p>Seleziona la tua sponsorizzazione:</p>
                                            <div class="form-group">
                                            @foreach ($ads  as $ad)
                                                    <input  type="radio" name="ads" value="{{ $ad->id}}">
                                                    <label for="{{ $ad->price }}">
                                                        {{ $ad->price/100 }} €
                                                    </label>
                                                    <br>
                                            @endforeach
                                                </div>
                                            <button type="submit">Sponsorizza</button>
                                        </div>
                                    @endif
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="delete-item modal fade" id="delete-modal-apt" tabindex="-1" role="dialog" aria-labelledby="delete-modal-apt" aria-hidden="true">
        <div class="d-flex w-100 h-100 align-items-center">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title px-5" id="exampleModalLabel">Confermi di voler eliminare l'appartamento?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex flex-row justify-content-center">
                        <form action=" {{route('user-apt.destroy', $apartment->id)}} " method="GET">
                            @csrf
                            @method('DELETE')
                            <div class="card d-flex flex-row border-0">
                                <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">Annulla</span>
                                </button>
                                <div class="spacer mx-2"></div>
                                <button type="submit" id="delThisAptInside" name="del_apart" value="" class="btn btn-danger">Elimina</button>
                                <input type="hidden" name="home" value="{{URL('/')}}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#delete-modal-apt').on('shown.bs.modal', function(evt) {
            var delButton = $(evt.relatedTarget);
            var idToDel = delButton.data('delid')
            console.log(idToDel);
            var delModal = $(this);
            delModal.find(".modal-body #delThisAptInside").val(idToDel)

        })
    </script>
</main>
@include('components.footer')
@endsection
