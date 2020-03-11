<style>
    .custom-toggler .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgb(0, 255, 217)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
    }
    .custom-toggler.navbar-toggler {
        border-color: rgb(0, 255, 217);
    }
</style>
<div class="container">
    <nav class="navbar  navbar-expand-md fixed-top {{Route::is('all.index') ? 'scrollNav' : ''}} dark ">
        <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"
        style="color:rgb(0, 255, 217);">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse" >
            <ul class="navbar-nav mr-auto flex-grow-1 justify-content-between pr-5">
                <li>
                    <a class="navbar-brand" href="{{route('all.index') }}">
                        <img src="{{ url('/') }}/images/BhootelLogo.png" alt="">
                    </a>
                </li>
                @if(!Route::is('bhootel.login') && !Route::is('register'))
                    {{-- GUEST login + register--}}
                    @if(Auth::guest())
                        <form method="POST" action="{{ route('login')}}">
                            @csrf
                            <li class="nav-item login-item">
                                <a class="nav-link" data-toggle="modal" data-target="#login-modal">Login</a>
                                <div class="login-modal modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modal" aria-hidden="true">
                                    <div class="d-flex w-100 h-100 align-items-center ">

                                        <div class="modal-dialog bRad-all" role="document">
                                            <main class="main-access bh-modal d-flex justify-content-center align-items-center bRad-all">
                                                <div class="modal-content container">

                                                    <div class="modal-header w-100">
                                                        <div class="back-home d-flex justify-content-center w-100">
                                                            <h1>Login</h1>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>

                                                        </div>
                                                    </div>


                                                    <div class="modal-body d-flex flex-row justify-content-center pt-0 pb-5">

                                                        <div class="container" >
                                                            <div class="row justify-content-center">
                                                                <div class="">
                                                                    <div class="card">
                                                                        <div class="card-body" >


                                                                                <div class="wrap-inputs d-flex flex-column m-auto">
                                                                                    <div class="form-group row">
                                                                                        {{-- <input type="hidden" name="status" value="{{$status}}"> --}}
                                                                                    </div>

                                                                                    <div class="form-group d-flexflex-column justify-content-start">
                                                                                        <div class="bh-input-group">
                                                                                            <input id="email" type="email"
                                                                                            class="form-control @error('email') is-invalid @enderror"
                                                                                            name="email"
                                                                                            value="{{ old('email') }}"
                                                                                            required autocomplete="off"
                                                                                            autofocus
                                                                                            placeholder="Indirizzo e-mail"
                                                                                            >

                                                                                            @error('email')
                                                                                                <span class="invalid-feedback" role="alert">
                                                                                                    <strong>{{ $message }}</strong>
                                                                                                </span>
                                                                                            @enderror
                                                                                            <div class="input-icon px-3">
                                                                                                <i class="far fa-user"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group d-flexflex-column justify-content-start mt-2">
                                                                                        <div class="bh-input-group">
                                                                                            <input id="password"
                                                                                            type="password"
                                                                                            class="form-control @error('password') is-invalid @enderror"
                                                                                            name="password"
                                                                                            required
                                                                                            autocomplete="current-password"
                                                                                            placeholder="password">

                                                                                            @error('password')
                                                                                                <span class="invalid-feedback" role="alert">
                                                                                                    <strong>{{ $message }}</strong>
                                                                                                </span>
                                                                                            @enderror
                                                                                            <div class="input-icon px-3">
                                                                                                <i class="fas fa-unlock-alt"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group d-flexflex-column justify-content-start py-3 mt-3">
                                                                                        <div class="d-flex justify-content-between">
                                                                                            <div class="form-check" >
                                                                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                                                                <label class="form-check-label" for="remember">
                                                                                                    {{ __('Remember Me') }}
                                                                                                </label>
                                                                                            </div>
                                                                                            <button type="submit" id="submit-login"class="btn btn-primary px-4 ml-3">
                                                                                                Login
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group d-flex flex-column justify-content-start">
                                                                                        <div class="">
                                                                                            @if (Route::has('password.request'))
                                                                                                <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
                                                                                                <span class="btn-link or">or</span>
                                                                                                <a class="btn btn-link" href="{{ route('register') }}">Register</a>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" name="status" value='upr'>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </main>
                                        </div>

                                    </div>
                                </div>
                            </li>
                        </form>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <li class="nav-item register-item">
                                <a class="nav-link" data-toggle="modal" data-target="#register-modal">Sign Up</a>
                            </li>
                            <div class="login-modal modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="register-modal" aria-hidden="true">
                                <div class="d-flex w-100 h-100 align-items-center ">

                                    <div class="modal-dialog bRad-all col-lg-9 p-0" role="document">
                                        <main class="main-access bh-modal d-flex justify-content-center align-items-center bRad-all" >
                                            <div class="modal-content container">

                                                <div class="modal-header w-100">
                                                    <div class="back-home d-flex justify-content-center w-100">
                                                        <h1>Sign Up</h1>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                </div>


                                                <div class="modal-body d-flex flex-row justify-content-center pt-0 pb-5 w-100" >

                                                    <div class="container-fluid" >
                                                        <div class="justify-content-center w-100">
                                                            <div class="">
                                                                <div class="card">
                                                                    <div class="card-body" >
                                                                        <div class="wrap-inputs d-flex flex-column m-auto">

                                                                            <div class="form-group d-flexflex-column justify-content-start">
                                                                                <div class="bh-input-group">
                                                                                    <input id="name"
                                                                                    type="text"
                                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                                    name="name"
                                                                                    value="{{ old('name') }}"
                                                                                    required
                                                                                    autocomplete="name"
                                                                                    autofocus
                                                                                    placeholder="Nome">

                                                                                    @error('name')
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                    <div class="input-icon px-3">
                                                                                        <i class="far fa-user"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group d-flexflex-column justify-content-start mt-2">
                                                                                <div class="bh-input-group">
                                                                                    <input id="email"
                                                                                    type="email"
                                                                                    class="form-control @error('email') is-invalid @enderror"
                                                                                    name="email"
                                                                                    value="{{ old('email') }}"
                                                                                    required
                                                                                    autocomplete="email"
                                                                                    placeholder="e-mail">

                                                                                    @error('email')
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                    <div class="input-icon px-3">
                                                                                        <i class="fas fa-at"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group d-flexflex-column justify-content-start mt-2">
                                                                                <div class="bh-input-group">
                                                                                    <input id="password"
                                                                                    type="password"
                                                                                    class="form-control @error('password') is-invalid @enderror"
                                                                                    name="password"
                                                                                    required
                                                                                    autocomplete="new-password"
                                                                                    placeholder="password"
                                                                                    >

                                                                                    @error('password')
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                    <div class="input-icon px-3">
                                                                                        <i class="fas fa-unlock-alt"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group d-flexflex-column justify-content-start mt-2">
                                                                                <div class="bh-input-group">
                                                                                    <input id="password-confirm"
                                                                                    type="password"
                                                                                    class="form-control"
                                                                                    name="password_confirmation"
                                                                                    required
                                                                                    autocomplete="new-password"
                                                                                    placeholder="conferma password">
                                                                                    <div class="input-icon px-3">
                                                                                        <i class="fas fa-lock"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group d-flexflex-column justify-content-start py-3 mt-3">
                                                                                <div class="">
                                                                                    <button type="submit" class="btn btn-primary">
                                                                                        {{ __('Register') }}
                                                                                    </button>
                                                                                    <span class="btn-link or ml-3">or</span>
                                                                                    <a class="btn-link ml-3" href="{{route('bhootel.login','upr')}}">Login</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </main>
                                    </div>

                                </div>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('login')}}">
                            @csrf
                            <li class="nav-item newapt-item">
                                <a class="nav-link" data-toggle="modal" data-target="#newapt-modal">Inserisici appartamento</a>
                                <div class="login-modal modal fade" id="newapt-modal" tabindex="-1" role="dialog" aria-labelledby="newapt-modal" aria-hidden="true">
                                    <div class="d-flex w-100 h-100 align-items-center ">

                                        <div class="modal-dialog bRad-all" role="document">
                                            <main class="main-access bh-modal d-flex justify-content-center align-items-center bRad-all">
                                                <div class="modal-content container">

                                                    <div class="modal-header w-100">
                                                        <div class="back-home d-flex justify-content-center w-100 align-items-center">
                                                            <h1 class="mr-2">Login</h1><span><h6>nuovo appartamento</h6></span>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="modal-body d-flex flex-row justify-content-center pt-0 pb-5">
                                                        <div class="container" >
                                                            <div class="row justify-content-center">
                                                                <div class="">
                                                                    <div class="card">
                                                                        <div class="card-body" >

                                                                            <div class="wrap-inputs d-flex flex-column m-auto">
                                                                                <div class="form-group row">
                                                                                    {{-- <input type="hidden" name="status" value="{{$status}}"> --}}
                                                                                </div>

                                                                                <div class="form-group d-flexflex-column justify-content-start">
                                                                                    <div class="bh-input-group">
                                                                                        <input id="email" type="email"
                                                                                        class="form-control @error('email') is-invalid @enderror"
                                                                                        name="email"
                                                                                        value="{{ old('email') }}"
                                                                                        required
                                                                                        autocomplete="off"
                                                                                        autofocus
                                                                                        placeholder="Indirizzo e-mail"
                                                                                        >

                                                                                        @error('email')
                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                        <div class="input-icon px-3">
                                                                                            <i class="far fa-user"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group d-flexflex-column justify-content-start mt-2">
                                                                                    <div class="bh-input-group">
                                                                                        <input id="password"
                                                                                        type="password"
                                                                                        class="form-control @error('password') is-invalid @enderror"
                                                                                        name="password"
                                                                                        required
                                                                                        autocomplete="current-password"
                                                                                        placeholder="password">

                                                                                        @error('password')
                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                        <div class="input-icon px-3">
                                                                                            <i class="fas fa-unlock-alt"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group d-flexflex-column justify-content-start py-3 mt-3">
                                                                                    <div class="d-flex justify-content-between">
                                                                                        <div class="form-check" >
                                                                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                                                            <label class="form-check-label" for="remember">
                                                                                                {{ __('Remember Me') }}
                                                                                            </label>
                                                                                        </div>
                                                                                        <button type="submit" id="submit-login"class="btn btn-primary px-4 ml-3">
                                                                                            Login
                                                                                        </button>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group d-flex flex-column justify-content-start">
                                                                                    <div class="">
                                                                                        @if (Route::has('password.request'))
                                                                                            <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
                                                                                            <span class="btn-link or">or</span>
                                                                                            <a class="btn btn-link" href="{{ route('register') }}">Register</a>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" name="status" value='apt'>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </main>
                                        </div>

                                    </div>
                                </div>
                            </li>
                        </form>
                    {{-- GUEST logout + name user--}}
                    @elseif(Auth::user())
                        <li class="nav-item">
                            <a class="nav-link user-name" href="{{ route('user.user-panel') }}"><i class="fas fa-user    "></i>{{Auth::user()->name}}</a>
                        </li>
                        <li class="d-flex">
                            <div class="nav-item">
                                <a class="nav-link" href="{{ route ('user-apt.create') }}">Inserisci appartamento</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('post')
                                </form>
                                </a>
                            </div>
                        </li>
                    @endif
                    {{-- ADD APT GUEST/UPR/UPRA --}}
                @endif
            </ul>
        </div>
       {{-- GUEST/UPR/UPRA --}}
        {{-- SOSTITUITA DA CANC <form class="form-inline mt-2 mt-md-0" action="{{route(Auth::user()?'user.search':'guest.search')}}" method="post"> --}}
        {{-- <form class="form-inline mt-2 mt-md-0" action="{{route('search.show')}}" method="post">
            @csrf
            @method('POST')
            <label for="search_field"></label>
            <input class="form-control mr-sm-2" name='search_field' type="text">
        </form> --}}
    </nav>

    {{-- MODAL  --}}


</div>
{{-- style="border:1px solid red" --}}

<script>
    // script scroll navbar
    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if(scroll < 100){
            $('.fixed-top.scrollNav').css('background', 'transparent');
        } else{
            $('.fixed-top.scrollNav').css('background', 'rgb(37, 47, 50)');
        }
    });
</script>
