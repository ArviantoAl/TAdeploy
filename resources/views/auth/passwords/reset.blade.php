@extends('layouts.nowa',[
    'titlePage' => __('Reset')
])

@section('content')
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-8 col-xs-10 card-sigin-main py-4 justify-content-center mx-auto">
                    <div class="card-sigin">
                        <!-- Demo content-->
                        <div class="main-card-signin d-md-flex">
                            <div class="wd-100p">
                                <div class="d-flex mb-3"><a href="index.html"><img src="{{ asset('nowa_assets') }}/img/brand/favicon.png" class="sign-favicon ht-40" alt="logo"></a></div>
                                <div class="  mb-1">
                                    <div class="main-signin-header">
                                        <div class="">
                                            <h2>Welcome back!</h2>
                                            <h4 class="text-start">Reset Your Password</h4>
                                            <form method="POST" action="{{ route('password.update') }}">
                                            @csrf
                                                <input type="hidden" name="token" value="{{ $token }}">
                                                <div class="form-group text-start">
                                                    <label for="email">{{ __('Email Address') }}</label>
                                                    <input id="email" type="email" placeholder="Enter your email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                                </div>
                                                <div class="form-group text-start">
                                                    <label for="password">{{ __('New Password') }}</label>
                                                    <input id="password" type="password" placeholder="Enter your password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                </div>
                                                <div class="form-group text-start">
                                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                                    <input id="password-confirm" type="password" placeholder="Confirm your new password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                </div>
                                                <button type="submit" class="btn ripple btn-primary btn-block">Reset Password</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="main-signup-footer mg-t-20 text-center">
                                        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
