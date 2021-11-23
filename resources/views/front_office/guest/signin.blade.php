@extends('front_office.layouts.app')
@section('content')
<style>
    .bigText {
        height: 50px;
        border-radius: 0;
        line-height: 32px;
    }

    .btn-primary:hover {
        border: 1px solid;
    }

    .text-danger {
        color: red !important;
    }
</style>
<section class="register">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="card card-body p-5">
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('front.login', app()->getLocale()) }}">
                        @csrf
                        <div class="form-group mt-5">
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif
                            <h2><b>{{ __('Login') }}</b></h2>
                        </div>
                        <div class="form-group mt-5">
                            <label for="password">{{ __('Email') }}</label>
                            <input type="email" class="form-control bigText" name="email" id="email" autocomplete="none">
                            @error('email')
                            <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" class="form-control bigText" 
                                name="password" id="password">
                            @error('password')
                            <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- <div class="form-group d-flex justify-content-between">
                            <a href="forget_password.html" class="text-muted">Forget Password ?</a>
                        </div> --}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                        </div>
                        <div class="form-group text-center mt-5" style="font-size: 18px">
                            {{ __('Dont have account , please click') }} <a
                                href="{{ route('front.signup', app()->getLocale()) }}"
                                class="text-muted" style="color: #ab4b98 !important">{{ __('Register') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection