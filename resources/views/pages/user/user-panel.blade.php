@extends('layouts.base')
@section('user-panel')
@include('components.header')
@php
    $now = date('Y-m-d H:i:s');
@endphp
<main class='main-panel nav-fix'>


    <div class="panel d-flex container-fluid m-0 p-0">
        <div class="panel_left col-3 col-md-3 m-0 p-0 pt-5  ">
            <div class="panel_left--avatar d-flex w-100 align-items-center py-2">
                <div class="div-icon px-2">
                    <img src="https://img.icons8.com/cute-clipart/64/000000/iron-man.png">
                </div>
                <div class="div-label px-2 " onclick="location.href=window.location.origin+'/user/user-panel'">
                    {{Auth::user()->name}}
                </div>
            </div>
            <div class="panel_left--create d-flex w-100 align-items-center py-2">
                <div class="div-icon px-3 disable">
                    <img src="https://img.icons8.com/ios/35/000000/plus.png">
                </div>
                <div class="div-label px-2" onclick="location.href=window.location.origin+'/user/create-apt'">
                    Nuovo appartamento
                </div>
            </div>
            <div class="panel_left--ads_price d-flex w-100 align-items-center py-2" data-toggle="modal" data-target="#price-table">
                <div class="div-icon px-3">
                    <img src="https://img.icons8.com/ios/35/000000/rating.png">
                </div>
                <div class="div-label px-2">
                    Tabella prezzi
                </div>
            </div>
            <div class="panel_left--disable d-flex w-100 align-items-center py-2" data-toggle="modal" data-target="#apt-disable">
                <div class="div-icon px-3">
                    <img src="https://img.icons8.com/ios/35/000000/box.png">
                </div>
                <div class="div-label px-2">
                    Annunci disattivati
                </div>
            </div>
            <div class="panel_left--profle d-flex w-100 align-items-center py-2 disable">
                <div class="div-icon px-3">
                    <img src="https://img.icons8.com/ios/35/000000/contacts.png">
                </div>
                <div class="div-label px-2">
                    Profilo Utente
                </div>
            </div>
            <div class="panel_left--settings d-flex w-100 align-items-center py-2 disable">
                <div class="div-icon px-3">
                    <img src="https://img.icons8.com/ios/35/000000/settings.png">
                </div>
                <div class="div-label px-2">
                    Impostazioni
                </div>
            </div>

        </div>
        <div class="panel_right col-9 d-md-flex flex-column">
            <div class="title-panel py-4 px-sm-2 px-md-5">
                <h3>La mia Dashboard</h3>
                <p>opzioni e interazioni</p>
            </div>
            <div class="panel_right-cards d-flex flex-row justify-content-center flex-wrap py-3 mt-xl-0 text-center">
                <div class="panel_right-cards--msgs p-4 mx-sm-4 ">
                    <div class="card">
                        <div class="card-title">APPARTAMENTI</div>
                        <h2>@isset($apartments) {{$apartments->count()}} @else 0 @endisset</h2>
                    </div>
                </div>
                <div class="panel_right-cards--apts p-4 mx-sm-4">
                    <div class="card">
                        <div class="card-title">MESSAGGI</div>
                        <h2>{{$countMsg}}
                    </div>
                </div>
                <div class="panel_right-cards--views p-4 mx-sm-4">
                    <div class="card">
                        <div class="card-title">IN VETRINA</div>
                        <h2>{{$activeCount->count()}}</h2>
                    </div>
                </div>
            </div>
            <div class="panel_right-table d-flex flex-column table-cont px-sm-2 px-md-5 py-5 mb-5">
                <div class="d-flex flex-column panel_right-table--apt ">
                    <div class="title">
                        <h5 class="title p-3 mb-0">I MIEI APPARTAMENTI</h5>
                    </div>
                    <div class="bh-table-wrap w-100 d-flex">
                        <div class="bh-table table-responsive ">
                           <table class="table mt-0" style="min-width:635px;">
                                <tbody>
                                    @isset($apartments)
                                    @foreach ($apartments as $apartment)
                                    <tr>
                                        <td class="col-img ">
                                            <a href="{{route('user-apt.show', $apartment -> id)}}">
                                                <div class="img-apt">
                                                    <div class="wrap-div">
                                                        <div class="img-div">
                                                            <img src='{{ url('/') }}/{{$apartment -> image}}'/>
                                                        </div>
                                                        <div class="id-apt">
                                                            {{$apartment->id}}
                                                        </div>
                                                    </div>

                                                </div>
                                            </a>
                                        </td>
                                        <td class="col-infos">
                                            <div class="title-apt">
                                                {{$apartment->title}}
                                            </div>
                                            <div class="desc-apt text-truncate">
                                                {{$apartment->description}}
                                            </div>
                                            <ul class="d-flex list-group list-group-horizontal justify-content-start mt-2">
                                                @foreach ($apartment->configs as $config)
                                                    @switch($config->service)
                                                        @case('wifi')
                                                        <i class="fas fa-wifi"></i>
                                                            @break
                                                        @case('parking')
                                                        <i class="fas fa-parking"></i>
                                                            @break
                                                        @case('pool')
                                                        <i class="fas fa-swimming-pool"></i>
                                                            @break
                                                        @case('reception')
                                                        <i class="fas fa-concierge-bell"></i>
                                                            @break
                                                        @case('sauna')
                                                        <i class="fas fa-hot-tub"></i>
                                                            @break
                                                        @case('sight')
                                                        <i class="fas fa-eye"></i>
                                                            @break
                                                        @default
                                                    @endswitch
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td colspan="option">
                                            <div class="d-flex align-items-center">

                                                <button class="btn btn-primary mr-3 btn-paypal" type="button" data-toggle="modal" data-target="#paypal" data-payid="{{$apartment->id}}">
                                                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                </button>

                                                <button type="button" class="btn btn-primary btn-eye mr-3" data-toggle="modal" data-target="#show-hide" style="display:none">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>

                                                <a href="{{route('user-apt.edit', $apartment->id)}}" class="btn btn-success mr-3"><i class="fas fa-edit"></i></a>

                                                <button type="button" class="btn btn-danger  " data-toggle="modal" data-target="#delete-modal" data-delid="{{$apartment->id}}">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </div>
                                            @if(isset($apartment->ads_expired) && (\Carbon\Carbon::now())->diffInDays($apartment->ads_expired, false) >= 0)
                                            <div  class='text-uppercase promo py-3'><i class="fas fa-bahai"></i> PROMO Attiva</div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel_right-table-group mt-5 d-lg-flex justify-content-xl-around justify-content-between">
                    <div class="panel_right-table--msg">
                        <div class="title">
                            <h5 class="title p-3 mb-0">POSTA IN ARRIVO</h5>
                        </div>
                        <div class="bh-table">
                            <table class="table">
                                <tbody>
                                    @foreach($allMsgsApt as $item)
                                        @foreach($item as $el)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="msg-icon px-2">
                                                        <i class="fas fa-envelope    "></i>
                                                    </div>
                                                    <div class="msg-msg">
                                                    <a href="{{route('user-apt.show', $el->apartment_id)}}" style="color:rgb(21, 37, 46)">
                                                            {{$el->apartment_id}} - {{$el->body}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="panel_right-table--ads mt-5 mt-lg-0">
                        <div class="title">
                            <h5 class="title p-3 mb-0">PROMO ATTIVE</h5>
                        </div>
                        <div class="bh-table">
                            <table class="table" >
                                <tbody>
                                @foreach($allAdsApt as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="ads-icon px-2">
                                                        <i class="fas fa-award"></i>
                                                    </div>
                                                    <div class="ads-time activated">
                                                        attivato il:{{\Carbon\Carbon::create($item)->isoFormat('MM/DD/YYYY')}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>

                                                <div class="ads-time expire">
                                                @if(( \Carbon\Carbon::now())->diffInDays($item, false) < 0)
                                                    stato: SCADUTO
                                                    @else
                                                    stato: ATTIVO
                                                @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- modals --}}
        <div class="price-table modal fade" id="price-table" tabindex="-1" role="dialog" aria-labelledby="price-table" aria-hidden="true">
            <div class="d-flex w-100 h-100 align-items-center ">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title px-5" id="exampleModalLabel">La nostra offerta</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body d-flex flex-row justify-content-center">

                            <!-- First -->
                            <div class="bh-modal-item bRad-all">
                                <div class="card mb-5 mb-lg-0 h-100 bRad-all">
                                    <div class="card-body p-0 bRad-top bRad-bottom">
                                        <div class="price_title p-3 pb-5 text-center bRad-top">
                                            <h1 class="bRad-top mb-3">24h</h1>
                                        </div>
                                        <div class="price_info">
                                            <div class="price_price text-center base">
                                                €2.99
                                            </div>
                                            <div class="price_details pt-5 px-3">
                                            <div class="py-2">Annuncio in vetrina</div>
                                            <div class="py-2">Durata 24h (1 giorno) <span class="sub_text">*previo annullamento dell'offerta</span></div>
                                            <div class="py-2">Possibilità di rinnovo</div>
                                            <div class="py-2">Offerta cumulabile</div>
                                        </div>
                                    </div>
                                        <div class="price_footer p-2 bRad-bottom"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Secondo-->
                            <div class="bh-modal-item bRad-all">
                                <div class="card mb-5 mb-lg-0 h-100 bRad-all">
                                    <div class="card-body p-0 bRad-top bRad-bottom">
                                        <div class="price_title p-3 pb-5 text-center bRad-top">
                                            <h1 class="bRad-top mb-3">72h</h1>
                                        </div>
                                        <div class="price_info">
                                            <div class="price_price text-center mid">
                                                €5.99
                                            </div>
                                            <div class="price_details pt-5 px-3">
                                            <div class="py-2">Annuncio in vetrina</div>
                                            <div class="py-2">Durata 24h (1 giorno) <span class="sub_text">*previo annullamento dell'offerta</span></div>
                                            <div class="py-2">Possibilità di rinnovo</div>
                                            <div class="py-2">Offerta cumulabile</div>
                                        </div>
                                    </div>
                                        <div class="price_footer p-2 bRad-bottom"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Third -->
                            <div class="bh-modal-item bRad-all">
                                <div class="card mb-5 mb-lg-0 h-100 bRad-all">
                                    <div class="card-body p-0 bRad-top">
                                        <div class="price_title p-3 pb-5 text-center bRad-top">
                                            <h1 class="bRad-top mb-3">144h</h1>
                                        </div>
                                        <div class="price_info">
                                            <div class="price_price text-center high">
                                                €9.99
                                            </div>
                                            <div class="price_details pt-5 px-3">
                                            <div class="py-2">Annuncio in vetrina</div>
                                            <div class="py-2">Durata 24h (1 giorno) <span class="sub_text">*previo annullamento dell'offerta</span></div>
                                            <div class="py-2">Possibilità di rinnovo</div>
                                            <div class="py-2">Offerta cumulabile</div>
                                        </div>
                                    </div>
                                        <div class="price_footer p-2 bRad-bottom"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @isset($apartment)
            <div class="apt-disable modal fade" id="apt-disable" tabindex="-1" role="dialog" aria-labelledby="apt-disable" aria-hidden="true">
                <div class="d-flex w-100 h-100 align-items-center">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title px-5" id="exampleModalLabel">Appartamenti che hai nascosto dal nostro portale</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body d-flex flex-row justify-content-center">
                                <!-- First -->
                                <div class="bh-modal-item bRad-all">
                                    <div class="card mb-5 mb-lg-0 h-100 bRad-all">
                                        <div class="card-body p-0 bRad-top bRad-bottom">
                                            <div class="apt_title p-3 pb-3 text-center bRad-top">
                                            <h1 class="bRad-top mb-3">{{$countHide->count()}}</h1>
                                                <p>nascosti</p>
                                            </div>
                                            <div class="apt_info">
                                                <div class="apt_details pt-2 px-3">
                                                @foreach($countHide as $apt)
                                                <div class="py-2">{{$apt->id}} - <a href="{{route('user-apt.show', $apartment -> id)}}">{{$apt->title}}</a></div>
                                                @endforeach
                                            </div>
                                        </div>
                                            <div class="price_footer p-2 bRad-bottom"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="delete-item modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal" aria-hidden="true">
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
                                <form action="" method="GET">
                                    @csrf
                                    @method('DELETE')
                                    <div class="card d-flex flex-row border-0">
                                        <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">Annulla</span>
                                        </button>
                                        <div class="spacer mx-2"></div>
                                        <button type="submit" id="delThisApt" name="del_apart" value="" class="btn btn-danger">Elimina</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="paypal modal fade" id="paypal" tabindex="-1" role="dialog" aria-labelledby="paypal" aria-hidden="true">
                <div class="d-flex w-100 h-100 align-items-center">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title px-5" id="exampleModalLabel">Seleziona un'offerta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body d-flex flex-column justify-content-center" >

                                    <form action="{{route('payment.pay', $apartment->id)}}" method="get">
                                    @csrf
                                            <div class="alert alert-success">
                                                <p>Seleziona la tua sponsorizzazione:</p>
                                                <div class="form-group">
                                                @foreach ($adsTypo  as $ad)
                                                        <input  type="radio" name="ads" value="{{ $ad->id}}">
                                                        <label for="{{ $ad->price }}">
                                                            {{ $ad->price/100 }} €
                                                        </label>
                                                        <br>
                                                @endforeach
                                                </div>
                                                    <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">Annulla</span>
                                                    </button>
                                                    <button class="btn btn-dark" type="submit">Sponsorizza</button>
                                                </div>
                                        <input type="hidden" name="payID" value="" id="payID">
                                    </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="show-hide modal fade" id="show-hide" tabindex="-1" role="dialog" aria-labelledby="show-hide" aria-hidden="true">
                <div class="d-flex w-100 h-100 align-items-center">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title px-5" id="exampleModalLabel">Confermi di voler eliminare l'appartamento?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body d-flex flex-column justify-content-center">
                                <p>
                                    Vuoi davvero nascondere l'appartamento dalla lista degli appartamenti?
                                    Ricordati di cliccare sull'occhiolino se vorrai mostrare nuovamente il tuo appartamento.
                                    Questa azione avrà effetto anche se il tuo appartamento è sponsorizzato!
                                </p>
                                <div class="buttons text-right">
                                    <button class="btn btn-danger">Procedi</button>
                                    <button class="btn btn-success">Annulla</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset

    </div>

</main>



<script>
    $('#delete-modal').on('shown.bs.modal', function(evt) {
        var delButton = $(evt.relatedTarget);
        var idToDel = delButton.data('delid')
        console.log(idToDel);
        var thisModal = $(this);
        thisModal.find(".modal-body #delThisApt").val(idToDel)
    })

    $('#paypal').on('shown.bs.modal', function(evt) {
        var payButton = $(evt.relatedTarget);
        var aptIDPay = payButton.data('payid')
        var thisModal = $(this);
        thisModal.find(".modal-body #payID").val(aptIDPay)
    })

</script>

@include('components.footer')
@endsection
