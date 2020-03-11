@extends('layouts.base')

@section('register')
<main class="main-access d-flex justify-content-center align-items-center">
<div class="container">
    <div class="back-home d-flex justify-content-center py-5">
        <a href="{{URL::to('/')}}"><i class="fas fa-home fa-2x p-2"></i></a>
        <h1>Register</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="wrap-inputs d-flex flex-column col-lg-9 m-auto">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

@endsection
