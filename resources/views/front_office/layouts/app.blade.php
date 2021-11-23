<!doctype html>
<html {{ ((app()->getLocale()) == 'ar') ? "dir=rtl" : "dir=ltr" }}>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(app()->getLocale() == 'en')
    <link rel="stylesheet" href="{{ asset('front-office/css/bootstrap.min.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('front-office/css/bootstrap-rtl.css')}}">
    @endif

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('front-office/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-office/css/custom.css')}}">
    <link rel="shortcut icon" href="{{ asset('front-office/img/icon.png')}}" type="image/x-icon">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="{{ asset('js/share.js') }}"></script>


    <title>دروس - Doroos</title>
    <style>
        .user {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .user-pic {
            width: 38px;
            height: 38px;
            border-radius: 19px;
            border: 1px solid;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <div class="navbar-box">
                <div class="logo">
                    <a href="{{ route('front.home', app()->getLocale()) }}">
                        <img src="{{ asset('front-office/img/logo.png')}}" class="img-fluid" alt="logo">
                    </a>
                </div>
                <div class="menu">
                    <div class="collapse navbar-collapse" id="nav">
                        <ul class="navbar-nav">
                            <li class="d-inline d-lg-none">
                                <button data-toggle="collapse" data-target="#nav"
                                    class="close float-right">&times;</button>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ !Request::segment(2) ? 'active' : null }}"
                                    href="{{ route('front.home', app()->getLocale()) }}">{{__('Home')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) === 'about' ? 'active' : null }}"
                                    href="{{ route('front.about', app()->getLocale()) }}">{{__('About')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) === 'teachers' ? 'active' : null }}"
                                    href="{{ route('front.teachers', app()->getLocale()) }}">{{__('Teachers')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) === 'subjects' ? 'active' : null }}"
                                    href="{{ route('front.subjects', app()->getLocale()) }}">{{__('Subjects')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) === 'contact' ? 'active' : null }}"
                                    href="{{ route('front.contact', app()->getLocale()) }}">{{__('Contact Us')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="action-button d-md-block d-none">

                    @auth
                    <a href="{{ route('front.signin', app()->getLocale()) }}" class="btn btn-primary mr-2 user">
                        <div style="margin-right: 10px">
                            <img src="{{ Auth::user()->profile_image != 'default.png' ? asset('uploads/users').'/'.Auth::user()->profile_image : "https://www.pngitem.com/pimgs/m/150-1503945_transparent-user-png-default-user-image-png-png.png" }}"
                                class="user-pic">
                        </div>
                        <div>
                            {{Auth::user()->full_name}}
                            <small
                                class="d-block">{{ Auth::user()->userable_type === 'App\Instructor' ? 'Teacher Account' : 'Student Account' }}</small>
                        </div>
                    </a>
                    @else
                    <a href="{{ route('front.signin', app()->getLocale()) }}"
                        class="btn btn-primary mr-2">{{__('Sign In')}}<small
                            class="d-block">{{__('Free Registration')}}</small></a>
                    @endauth
                    <a href="{{ route(Route::currentRouteName(), 'ar') }}">
                        <img src="https://cdn.countryflags.com/thumbs/qatar/flag-round-500.png"
                            style="width: 35px; border: 2px solid #ffffff; border-radius: 50px;  margin: 4px">
                    </a>
                    <a href="{{ route(Route::currentRouteName(), 'en') }}">
                        <img src="https://cdn.countryflags.com/thumbs/united-kingdom/flag-round-500.png"
                            style="width:35px; border: 2px solid #ffffff;border-radius: 50px; margin: 4px" alt="">
                    </a>
                </div>
                <div class="cta d-md-none d-block" data-toggle="collapse" data-target="#nav">
                    <div class="toggle-btn type1"></div>
                </div>

            </div>
        </div>
    </nav>
    @if(!Request::segment(2))
    <header class="slider">
        <div class="container">
            <div class="row content-header align-items-center">
                <div class="col-lg-6 mb-lg-0 mb-5">
                    <h1 class="title">{{__('Find a teacher anytime, anywhere...')}}</h1>
                    <p>{{__('Download Doroos app and enjoy our free services')}}</p>
                    <a href="#!" class="mr-2">
                        <img src="{{ asset('front-office/img/google-play.png')}}" alt="" style="width: 200px">
                    </a>
                    <a href="#!">
                        <img src="{{ asset('front-office/img/app-store.png')}}" alt="" style="width: 200px">
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="slider-carousel owl-carousel">
                        <div class="item">
                            <img src="{{ asset('front-office/img/phone-mockup.png')}}" class="img-fluid img" alt="">
                        </div>
                        <div class="item">
                            <img src="{{ asset('front-office/img/phone-mockup-2.png')}}" class="img-fluid img" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @elseif(Request::segment(2) === 'about')
    <header class="header-sub">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="title">{{ __('About') }}</h1>
                </div>
            </div>
        </div>
    </header>
    @elseif(Request::segment(2) === 'teachers')
    <header class="header-sub">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="title">{{ __('Teachers') }}</h1>
                </div>
            </div>
        </div>
    </header>
    @elseif(Request::segment(2) === 'subjects')
    <header class="header-sub">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="title">{{ __('Subjects') }}</h1>
                </div>
            </div>
        </div>
    </header>
    @elseif(Request::segment(2) === 'contact')
    <header class="header-sub">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="title">{{ __('Contact Us') }}</h1>
                </div>
            </div>
        </div>
    </header>
    @elseif(Request::segment(2) === 'sign-in' || Request::segment(2) === 'sign-up')
    <header class="header-sub" style="padding-top: 25rem"> </header>
    @elseif(Request::segment(2) === 'teacher')
    <header class="header-sub">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="title">Teacher Profile</h1>
                </div>
            </div>
        </div>
    </header>
    @endif

    @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-3">
                    <div class="footer-about">
                        <img src="{{ asset('front-office/img/logo.png')}}" alt="logo" class="img-fluid mb-4">
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                            there live the blind texts.</p>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="footer-list">
                        <h5 class="title-footer">{{ __('Platforms')}}</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#!" class="nav-link"> {{ __('Web') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="#!" class="nav-link">{{ __('Android App') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="#!" class="nav-link">{{ __('IOS App') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="footer-list">
                        <h5 class="title-footer">{{ __('Links')}}</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="index.html" class="nav-link">{{ __('Home')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="about.html" class="nav-link">{{ __('About')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="teacher.html" class="nav-link">{{ __('Teachers')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="subject.html" class="nav-link">{{ __('Subjects')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="Contact.html" class="nav-link">{{ __('Contact Us')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-list">
                        <ul class="nav flex-column mb-3">
                            <li class="nav-item">
                                <a href="#!" class="nav-link"> <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ __('Doha, Qatar') }}</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#!" class="nav-link"> <i class="fas fa-phone"></i>
                                    <span>50853357</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#!" class="nav-link"> <i class="far fa-envelope"></i>
                                    <span>info@yourdomain.com</span></a>
                            </li>
                        </ul>
                        <ul class="nav social-media">
                            <li>
                                <a href="#!"> <i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="#!"> <i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#!"> <i class="fab fa-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-12 text-center">
                    <p>{{ __('Copyright') }} &copy; {{ __('2020 All rights reserved') }}</p>
                </div>
            </div>
        </div>
    </footer>

    <a href="https://api.whatsapp.com/send?phone=51955081075" class="float" target="_blank">
        <i class="fab fa-whatsapp my-float"></i>
    </a>

    {{--<div class="scroll-to-top"><i class="fas fa-angle-up"></i></div>--}}

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script src="{{ asset('front-office/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('front-office/js/custom.js')}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <style>
        .noUi-connect {
            background: #32384C;
        }
    </style>
</body>

</html>