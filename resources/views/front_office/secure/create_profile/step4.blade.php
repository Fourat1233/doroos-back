@extends('front_office.layouts.app')
@section('content')
    <style>
        .steps {
            list-style: none;
            margin: 0;
            padding: 0;
            display: table;
            table-layout: fixed;
            width: 100%;
            color: #929292;
            height: 4rem;
        }
        .steps > .step {
            position: relative;
            display: table-cell;
            text-align: center;
            font-size: 0.875rem;
            color: #6D6875;
        }
        .steps > .step:before {
            content: attr(data-step);
            display: block;
            margin: 0 auto;
            background: #ffffff;
            border: 2px solid #e6e6e6;
            color: #e6e6e6;
            width: 2rem;
            height: 2rem;
            text-align: center;
            margin-bottom: -4.2rem;
            line-height: 1.9rem;
            border-radius: 100%;
            position: relative;
            z-index: 1;
            font-weight: 700;
            font-size: 1rem;
        }
        .steps > .step:after {
            content: '';
            position: absolute;
            display: block;
            background: #e6e6e6;
            width: 100%;
            height: 0.125rem;
            top: 1rem;
            left: {{ app()->getLocale() === 'ar' ? '-50%' : '50%' }};
        }
        .steps > .step:last-child:after {
            display: none;
        }
        .steps > .step.is-complete {
            color: #6D6875;
        }
        .steps > .step.is-complete:before {
            content: '\2713';
            color: #32384C;
            background: #8bc34a;
            border: 2px solid #32384C;
        }
        .steps > .step.is-complete:after {
            background: #32384C;
        }
        .steps > .step.is-active {
            font-size: 1rem;
        }
        .steps > .step.is-active:before {
            color: #FFF;
            border: 2px solid #32384C;
            background: #32384C;
            margin-bottom: -4.9rem;
        }

        .bigText {
            height:50px;
            border-radius: 0;
            line-height: 32px;
        }
        label {
            font-size: 16px;
        }

        form .btn-primary {
            border-radius: 5px;
        }
        form .btn-light {
            background: #8d8d8d;
            border-radius: 5px;
            color: #ffffff;
        }
        form .btn:hover {
            border: 1.2px solid #1a2035;
            background: #ffffff;
        }

        .text-danger {
            color: red !important;
        }

    </style>
    <header class="header-sub">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="title">{{ __('Create Profile') }}</h1>
                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="container">
            <ol class="steps">
                <li class="step is-complete" data-step="1">
                    {{ __('Step') }} 1
                </li>
                <li class="step is-complete" data-step="2">
                    {{ __('Step') }} 2
                </li>
                <li class="step is-complete" data-step="3">
                    {{ __('Step') }} 3
                </li>
                <li class="step is-active" data-step="4">
                    {{ __('Step') }} 4
                </li>
            </ol>
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card card-body p-3">
                        <form method="POST" action="{{ route('front.secure.profile.saveStep4', app()->getLocale()) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="subjects">{{ __('Teaching') }}</label>
                                <select name="subjects[]" multiple class="form-control bigText" id="subjects">
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                @error('subjects')
                                <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <img src="{{ asset('front-office/img/profile_icons/1.png') }}" alt="" style="width: 60px; margin-bottom: 15px">
                                    <label for="file1">{{ __('Select your resume') }}</label>
                                    <input type="file" class="form-control bigText" id="file1" placeholder="Picture profile" name="resume" autocomplete="off">
                                    @error('resume')
                                    <small id="emailHelp2" class="form-text text-danger text-muted mb-3">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <img src="{{ asset('front-office/img/profile_icons/2.png') }}" alt="" style="width: 60px; margin-bottom: 15px">
                                    <label for="file2">{{ __('Select your degrees') }}</label>
                                    <input type="file" class="form-control bigText" id="file2" placeholder="Picture profile" name="degrees" autocomplete="off"">
                                </div>
                                <div class="form-group col-md-6 mt-5">
                                    <img src="{{ asset('front-office/img/profile_icons/3.png') }}" alt="" style="width: 60px; margin-bottom: 15px">
                                    <label for="file3">{{ __('Select your certificates') }}</label>
                                    <input type="file" class="form-control bigText" id="file3" placeholder="Picture profile" name="certificates" autocomplete="off">
                                </div>
                                <div class="form-group col-md-6 mt-5">
                                    <img src="{{ asset('front-office/img/profile_icons/4.png') }}" alt="" style="width: 60px; margin-bottom: 15px">
                                    <label for="file4">{{ __('Select your experiences') }}</label>
                                    <input type="file" class="form-control bigText" id="file4" placeholder="Picture profile" name="experiences" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                            <a href="{{ route('front.secure.profile.step3', app()->getLocale()) }}" class="btn btn-light">{{ __('Back') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
