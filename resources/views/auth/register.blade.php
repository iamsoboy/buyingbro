@extends('layouts.auth')

@section('title2', 'Register')

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
                    <span class="badge badge-warning badge-pill">{{setting('site.title')}}</span>
                    <h5 class="h5 text-white mt-3">Your ticket to the world</h5>
                    <p class="text-white opacity-8">
                        A Gift card Buying and Selling App.
                    </p>
                </div>
            </div>
        </div>
        <div class="container-fluid d-flex flex-column">
            <div class="row align-items-center justify-content-center justify-content-lg-end min-vh-100">
                <div class="col-sm-7 col-lg-6 col-xl-6 py-6 py-md-0">
                    <div class="row justify-content-left">
                        <div class="col-12">
                            <div>
                                <div class="align-items-center justify-content-center mb-5 col-12">
                                    <h6 class="h3 mb-0">Welcome back!</h6>
                                    <p class="text-muted mb-0">
                                        Welcome, register with us...
                                    </p>
                                </div>
                                <form class="form-row col-12 mt-2" method="POST" action="{{ route('register') }}">
                                @csrf
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label">Full Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="user"></i></span>
                                            </div>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="First & Last Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label">Phone Number</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="+(XXX)-XXX-XXXX" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label">Email address</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="mail"></i></span>
                                            </div>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" name="email" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label">Username</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="user-check"></i></span>
                                            </div>
                                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" name="username" value="{{ old('username') }}" required autocomplete="username">

                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="d-flex align-items-right justify-content-between">
                                            <div>
                                                <label class="form-control-label">Password</label>
                                            </div>
                                            <div class="mb-2">
                                                <a href="#" class="small text-muted text-underline--dashed border-primary" id="showpassword">Show password</a>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="key"></i></span>
                                            </div>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="d-flex align-items-right justify-content-between">
                                            <div>
                                                <label class="form-control-label">Confirm Password</label>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control" id="password_confirmation" placeholder="Password" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label class="form-control-label">Address</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="map-pin"></i></span>
                                            </div>
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="House Address" name="address" value="{{ old('address') }}" required autocomplete="address">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label">Country</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="flag"></i></span>
                                            </div>
                                            <select onchange="print_state('state', this.selectedIndex);" id="country" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}">
                                                <option selected>Choose Country</option>
                                                <option>...</option>
                                            </select>
                                            <script language="javascript">print_country("country");</script>
                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-control-label">State</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="flag"></i></span>
                                            </div>
                                            <select id="state" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}">
                                                <option selected>Choose State</option>
                                                <option>...</option>
                                            </select>

                                            @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <!--<label class="form-control-label">Zip Code</label>-->
                                        {!! NoCaptcha::display() !!}
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <!--<div class="form-group col-md-6">
                                        <label class="form-control-label">Terms and Conditions</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="terms">
                                            <label class="form-check-label" for="gridCheck1">
                                              By registering you automatically agree to our terms and conditions
                                            </label>
                                        </div>
                                    </div> -->

                                   <button type="submit" class="btn btn-block btn-primary mt-2">
                                        <span class="btn-inner--icon">
                                            <i data-feather="user"></i>
                                        </span>
                                    Register</button>
                                </form>
                                <div class="py-0 text-center">
                                    <span class="text-xs text-uppercase">or</span><br>
                                    <span class="text-xxl text-titlecase">
                                        Already have  an account? <a href="{{ route('login') }}">Login</a>
                                    </span>
                                </div>
                                <!-- Alternative login -->


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
