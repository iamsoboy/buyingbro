@extends('layouts.auth')

@section('title', 'Login')

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
                    <span class="badge badge-warning badge-pill">{{setting('site.title')}} </span>
                    <h5 class="h5 text-white mt-3">Your ticket to the world</h5>
                    <p class="text-white opacity-8">
                        A Gift card Buying and Selling App
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
                                    <h6 class="h3 mb-1">Welcome</h6>
                                    <p class="text-muted mb-0">
                                        Sign in to your account to continue.
                                    </p>
                                </div>
                                        @if (session()->has('success_message'))
                                            <div class="alert alert-success mb-6">
                                                <strong>{{session()->get('success_message')}}</strong>
                                            </div>
                                        @endif


                                <form method="POST" action="{{ route('login') }}">

                                    @csrf
                                    <div class="form-group">
                                        <label class="form-control-label">Email address</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="user"></i></span>
                                            </div>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group" x-data="{ show: true }">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <label class="form-control-label">Password</label>
                                            </div>
                                            <div class="mb-2">
                                                <a class="small text-muted text-underline--dashed border-primary"
                                                   @click="show = !show" >
                                                    Show password</a>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="key"></i></span>
                                            </div>
                                            <input type="password" placeholder="" :type="show ? 'password' : 'text'" class="form-control @error('password') is-invalid @enderror" id="input-password" placeholder="Password" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>


                                        </div>
                                    </div> -->
                                    @if (Route::has('password.request'))
                                                <a class="btn btn-link center" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                    <button type="submit" class="btn btn-block btn-primary">Log in</button>
                                </form>
                                <div class="py-3 text-center">
                                    <span class="text-xs text-uppercase">or</span><br>
                                    <span class="text-xxl text-titlecase">
                                        Don't have account yet? <a href="{{ route('register') }}">Register</a>
                                    </span>
                                </div>
                                <!-- Alternative login -->
                                <div class="row justify-content-center ">
                                    <div class="col-sm-12">
                                        <a href="#" class="btn btn-neutral btn-icon">
                                            <span class="btn-inner--icon"><img src="{{asset('img/icons/google.svg')}}" alt="Google"></span>
                                            <span class="btn-inner--text">Google</span>
                                        </a>
                                        <a href="#" class="btn btn-neutral btn-icon">
                                            <span class="btn-inner--icon"><img src="{{asset('img/icons/facebook.svg')}}" alt="Facebook"></span>
                                            <span class="btn-inner--text">Facebook</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
