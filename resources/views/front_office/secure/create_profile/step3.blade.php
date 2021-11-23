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

    .steps>.step {
        position: relative;
        display: table-cell;
        text-align: center;
        font-size: 0.875rem;
        color: #6D6875;
    }

    .steps>.step:before {
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

    .steps>.step:after {
        content: '';
        position: absolute;
        display: block;
        background: #e6e6e6;
        width: 100%;
        height: 0.125rem;
        top: 1rem;

        left: {{app()->getLocale()==='ar'? '-50%': '50%'}}

        ;
    }

    .steps>.step:last-child:after {
        display: none;
    }

    .steps>.step.is-complete {
        color: #6D6875;
    }

    .steps>.step.is-complete:before {
        content: '\2713';
        color: #32384C;
        background: #8bc34a;
        border: 2px solid #32384C;
    }

    .steps>.step.is-complete:after {
        background: #32384C;
    }

    .steps>.step.is-active {
        font-size: 1rem;
    }

    .steps>.step.is-active:before {
        color: #FFF;
        border: 2px solid #32384C;
        background: #32384C;
        margin-bottom: -4.9rem;
    }

    .bigText {
        height: 50px;
        border-radius: 0;
        line-height: 32px;
    }

    .text-danger {
        color: red !important;
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

    .btn-success:hover {
        color: #1a2035;
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
            <li class="step is-active" data-step="3">
                {{ __('Step') }} 3
            </li>
            <li class="step" data-step="4">
                {{ __('Step') }} 4
            </li>
        </ol>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card card-body p-3">
                    <form method="POST" action="{{ route('front.secure.profile.saveStep3', app()->getLocale()) }}">
                        @csrf
                        <div class="form-group">
                            <h3><b> {{ __('Step') }} 3 </b></h3>
                        </div>
                        <div style="display: inline-block" id="businessHoursContainer3"></div>
                        <input type="hidden" value="{{ session()->get('account.business_hours') }}"
                            name="business_hours" id="business_hours">
                        <br>
                        <div class="form-group mt-3" style="display: inline-block">
                            @error('business_hours')
                            <small id="emailHelp2" class="form-text text-danger text-muted mb-3">Please validate working
                                hours</small>
                            @enderror
                            <button id="btn" class="btn btn-success">Validate Hours</button>
                            <a href="{{ route('front.secure.profile.step2', app()->getLocale()) }}"
                                class="btn btn-light">{{ __('Back') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Next') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('back-office/js/core/jquery.3.2.1.min.js') }}"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.businessHours/1.0.1/jquery.businessHours.min.css"
        integrity="sha512-t6HMFeYeXpgLABTNbhpMYMJz3aDLr20sNk7Wat3tm0GR0BSnnViCnmArQrl1XXX+y+YIZYq9PFCY3kP/W13MhA=="
        crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css"
        integrity="sha512-eOKbnuWqH2HMqH9nXcm95KXitbj8k7P49YYzpk7J4lw1zl+h4uCjkCfV7RaY4XETtTZnNhgsa+/7x29fH6ffjg=="
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"
        integrity="sha512-RLw8xx+jXrPhT6aXAFiYMXhFtwZFJ0O3qJH1TwK6/F02RSdeasBTTYWJ+twHLCk9+TU8OCQOYToEeYyF/B1q2g=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.businessHours/1.0.1/jquery.businessHours.min.js"
        integrity="sha512-zi4X4/sySU3R4zfD02M8NT9zKrtzQGFdjJBAt1QhS2bg1m9yEPseRSNzalJnbvXbs0amtAKQxHCoKTefsLbNBg=="
        crossorigin="anonymous"></script>
    <script>
        var data = $("#businessHoursContainer3").businessHours({
                    postInit: function () {
                        $('.operationTimeFrom, .operationTimeTill').timepicker({
                            'timeFormat': 'H:i',
                            'step': 15
                        });
                    },
                    dayTmpl: '<div class="dayContainer" style="width: 80px;">' +
                        '<div data-original-title="" class="colorBox"><input type="checkbox" class="invisible operationState"></div>' +
                        '<div class="weekday"></div>' +
                        '<div class="operationDayTimeContainer">' +
                        '<div class="operationTime input-group"><span class="input-group-addon"><i class="fa fa-sun-o"></i></span><input type="text" name="startTime" class="mini-time form-control operationTimeFrom" value=""></div>' +
                        '<div class="operationTime input-group"><span class="input-group-addon"><i class="fa fa-moon-o"></i></span><input type="text" name="endTime" class="mini-time form-control operationTimeTill" value=""></div>' +
                        '</div></div>'
                });


                $('#btn').click(function (e) {
                    e.preventDefault();
                    $('#business_hours').val(data.serialize())
                })
    </script>
</section>
@endsection