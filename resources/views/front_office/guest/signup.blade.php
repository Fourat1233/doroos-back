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

    label {
        color: #1a2035;
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
                    <form method="POST" action="{{ route('front.register', app()->getLocale()) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <h2><b>{{ __('Create account') }}</b></h2>
                            <p class="text-muted"> {{ __('Create free account now') }} </p>
                        </div>
                        <div class="form-group mt-5">
                            <label for="name">{{ __('Full name') }}</label>
                            <input type="text" class="form-control bigText" id="name" 
                                value="{{ old('full_name') }}" name="full_name" autocomplete="off">
                            @error('full_name')
                            <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ __('Phone number') }}</label>
                            <input type="text" class="form-control bigText" id="phone" 
                                name="phone_number" value="{{ old('phone_number') }}" autocomplete="off">
                            @error('phone_number')
                            <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="picture">{{ __('Profile picture') }}</label>
                            <input type="file" class="form-control bigText" id="picture" 
                                name="file" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="contact_point">{{ __('Email') }}</label>
                            <input type="email" class="form-control bigText" id="contact_point"
                                 name="contact_point" value="{{ old('contact_point') }}"
                                autocomplete="off">
                            @error('contact_point')
                            <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="type">{{ __('Account Type') }}</label>
                            <select name="account_type" class="form-control bigText" id="type">
                                <option value="" selected>{{ __('Choose type') }}</option>
                                <option value="student">{{ __('Student Account') }}</option>
                                <option value="teacher">{{ __('Teacher Account') }}</option>
                            </select>
                            @error('account_type')
                            <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Gender') }}</label>
                            <div style="display: flex;
                                flex-wrap: nowrap;">
                                <div style="border: 1px solid #d8d8d8; padding: 10px; margin-right: 10px">
                                    <input id="male" type="radio" value="Male" name="gender">
                                    <label for="male" style="margin-bottom: 0 !important">{{ __('Male') }}</label>
                                </div>
                                <div style="border: 1px solid #d8d8d8; padding: 10px">
                                    <input id="female" type="radio" value="Female" name="gender">
                                    <label for="female" style="margin-bottom: 0 !important">{{ __('Female') }}</label>
                                </div>
                            </div>
                            @error('gender')
                            <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" class="form-control bigText" 
                                name="password" id="password" autocomplete="off">
                            @error('password')
                            <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                        </div>
                        <div class="form-group text-center mt-5" style="font-size: 18px">
                            {{ __('You have already an account , please click') }} <a
                                href="{{ route('front.login', app()->getLocale()) }}" class="text-muted"
                                style="color: #ab4b98 !important">{{ __('Login') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection