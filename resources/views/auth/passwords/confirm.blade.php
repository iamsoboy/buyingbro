@extends('layouts.auth')

@section('title', 'Password Confirmation')

@section('content')
<!-- Main content -->
    <!-- Go back -->
    <a href="/" class="btn btn-white btn-icon-only rounded-circle position-absolute zindex-101 left-4 top-4 d-none d-lg-inline-flex" data-toggle="tooltip" data-placement="right" title="Go back">
        <span class="btn-inner--icon">
            <i data-feather="arrow-left"></i>
        </span>
    </a>
    <!-- Side cover login -->
    <section>
        <div class="bg-primary position-absolute h-100 top-0 left-0 zindex-100 col-lg-6 col-xl-6 zindex-100 d-none d-lg-flex flex-column justify-content-end" data-bg-size="cover" data-bg-position="center">
            <!-- Cover image -->
            <img src="{{asset('img/img-v-2.jpg')}}" alt="Image" class="img-as-bg">
            <!-- Overlay text -->
            <div class="row position-relative zindex-110 p-5">
                <div class="col-md-8 text-center mx-auto">
                    <span class="badge badge-warning badge-pill">News</span>
                    <h5 class="h5 text-white mt-3">The all new Quick is here</h5>
                    <p class="text-white opacity-8">
                        Everything you need to create amazing websites at scale.
                    </p>
                </div>
            </div>
        </div>
        <div class="container-fluid d-flex flex-column">
            <div class="row align-items-center justify-content-center justify-content-lg-end min-vh-100">
                <div class="col-sm-7 col-lg-6 col-xl-6 py-6 py-md-0">
                    <div class="row justify-content-center">
                        <div class="col-11 col-lg-10 col-xl-6">
                            <div>
                                <div class="mb-5">
                                    <h6 class="h3 mb-1">{{ __('Confirm Password') }}</h6>
                                    <p class="text-muted mb-0">
                                    {{ __('Please confirm your password before continuing.') }}
                                    </p>
                                </div>
                                                                                                                       
                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label class="form-control-label">{{ __('Password') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="user"></i></span>
                                            </div>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="name@example.com" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-block btn-primary">{{ __('Confirm Password') }}</button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </form>
                                <div class="py-3 text-center">
                                    <span class="text-xs text-uppercase">or</span><br>
                                    <span class="text-xxl text-titlecase">
                                        Don't have account yet? <a href="{{ route('register') }}">Register</a>
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection