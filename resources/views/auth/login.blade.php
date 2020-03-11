@extends('layouts.base')

@section('login')

<main class="main-access d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="back-home d-flex justify-content-center py-5">
            <a href="{{URL::to('/')}}"><i class="fas fa-home fa-2x p-2"></i></a>
            <h1>Login</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="wrap-inputs d-flex flex-column col-lg-9 m-auto">
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
                                        <button type="submit" class="btn btn-primary px-4 ml-3">
                                            {{ __('Login') }}
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
