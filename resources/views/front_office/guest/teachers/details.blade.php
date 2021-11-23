@extends('front_office.layouts.app')
@section('content')
    <style>
        .check::before, .rated::after{
            content:'\2605';
            font-size:30px;
            position:absolute;
            color:#d8d8d8;
            left:0;
            bottom:0;
            line-height: 50px;	
        }
        .share-icons ul li{
            list-style: none;
        }
        .share-icons span {
            font-size: 40px;
        }
        .share-icons ul {
            display: flex;
        }
        .share-icons ul li  {
            margin-left: 10px;
            margin-right: 10px;
        }

        .share-icons .fa-whatsapp {
            color: #26d366;
        }
        .share-icons .fa-linkedin {
            color: #0e76a8;
        }
        .share-icons .fa-twitter {
            color: #00acee;
        }
        .share-icons .fa-facebook-square {
            color: #3b5998;
        }
        .coralbg {
            background-color: #8E68AD;
        }

        .white {
            color: #fff!important;
        }
        #map {
            height: 400px;
            width: 100%;
        }

        div.user-menu-container {
            z-index: 10;
            background-color: #fff;
            margin-top: 20px;
            background-clip: padding-box;
            opacity: 0.97;
            filter: alpha(opacity=97);
            -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
        }

        div.user-menu-container .thumbnail {
            width:100%;
            min-height:200px;
            border: 0px!important;
            padding: 0px;
            border-radius: 0;
            border: 0px!important;
        }

        .user-pad {
            padding: 20px 25px;
        }

        .no-pad {
            padding-right: 0;
            padding-left: 0;
            padding-bottom: 0;
        }

        .user-details {
            background: #eee;
            min-height: 333px;
        }

        .user-image {
            max-height:200px;
            overflow:hidden;
        }

        .overview h3 {
            font-weight: 300;
            margin-top: 15px;
            margin: 10px 0 0 0;
        }

        .overview h4 {
            font-weight: bold!important;
            font-size: 40px;
            margin-top: 0;
        }

        .view p {
            margin-top: 20px;
            margin-bottom: 0;
        }

        /* -- media query for user profile image -- */
        @media (max-width: 767px) {
            .user-image {
                max-height: 400px;
            }
        }
    </style>
    <link href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet" media="screen">
    <div class="container" style="margin-bottom: 25px">
        <div class="row user-menu-container square">
            <div class="col-md-7 user-details">
                <div class="row coralbg white">
                    <div class="col-md-6 no-pad">
                        <div class="user-pad">
                            <h3> {{ $instructor->gender === 'Female' ? 'Ms.' : 'Mr.' }} {{ $instructor->full_name }}</h3>
                            <h4 class="white">{{ $instructor->city }}, {{ $instructor->state }}</h4>
                            <h4 class="white">{{ $instructor->subjects->implode('name', ', ') }}</h4>
                            <hr>
                            <h5>{{ __('Rating')}} : </h5>
                            <rating-element teacher-id={{ $instructor->user_id }} base-url={{ url('/') }}></rating-element>
                        </div>
                    </div>
                    <div class="col-md-6 no-pad">
                        <div class="user-image">
                            <img src="https://farm7.staticflickr.com/6163/6195546981_200e87ddaf_b.jpg" class="img-responsive thumbnail">
                        </div>
                    </div>
                </div>
                <div class="row overview">
                    <div class="col-md-6 user-pad text-center">
                    <h3 style="font-weight: bold; color: #1a2035">{{ __('Years of experience') }}</h3>
                        <h3>
                            {{ $instructor->years_of_experience }}
                        </h3>
                    </div>
                    <div class="col-md-6 user-pad text-center">
                        <h3 style="font-weight: bold; color: #1a2035">{{ __('Price/Hour') }}</h3>
                        <h3>
                            {{ $instructor->pricing }} {{ __('QR') }}
                        </h3>
                    </div>
                </div>
                <hr>
                <div class="row overview">
                    <div class="col-md-6 user-pad text-center">
                        <h3 style="font-weight: bold; color: #1a2035">{{ __('Teaching Type') }}</h3>
                        <h3>
                            @foreach (json_decode($instructor->teaching_type) as $type)
                                {{ $type }},
                            @endforeach
                        </h3>
                    </div>
                    <div class="col-md-6 user-pad text-center">
                        <h3 style="font-weight: bold; color: #1a2035">{{ __('Teaching Level') }}</h3>
                        <h3>
                            @foreach (json_decode($instructor->teaching_level) as $level)
                                {{ $level }},
                            @endforeach
                        </h3>
                    </div>
                </div>
                <hr>
                <div class="row overview">
                    <div class="col-md-6 user-pad text-center">
                        <img src="{{ asset('front-office/img/profile_icons/1.png') }}" alt="" style="width: 100px">
                        <h3>{{ __('Resume') }}</h3>
                    </div>
                    <div class="col-md-6 user-pad text-center">
                        <img src="{{ asset('front-office/img/profile_icons/2.png') }}" alt="" style="width: 100px">
                        <h3>{{ __('Degrees') }}</h3>
                    </div>
                </div>
                <hr>
                <div class="row overview">
                    <div class="col-md-6 user-pad text-center">
                        <img src="{{ asset('front-office/img/profile_icons/3.png') }}" alt="" style="width: 100px">
                        <h3>{{ __('Certificates') }}</h3>
                    </div>
                    <div class="col-md-6 user-pad text-center">
                        <img src="{{ asset('front-office/img/profile_icons/4.png') }}" alt="" style="width: 100px">
                        <h3>{{ __('Experiences') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 user-menu user-pad">
                <div class="user-menu-content active">
                    <h3>
                    {{ __('About Teacher') }}
                    </h3>
                    <p>{{ $instructor->about }}</p>
                    @auth
                        <h3>{{ __('Rating') }}</h3>
                        <div class="mt-4">
                            <rating-element></rating-element>
                        </div>
                    @endauth
                    <h3>{{ __('Share profile') }}</h3>
                    <div class="share-icons">
                        {!! Share::currentPage()
                                ->facebook()
                                ->twitter()
                                ->linkedin('Extra linkedin summary can be passed here')
                                ->whatsapp();
                        !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row user-menu-container square">
            <div id="map"></div>
        </div>
    </div>

    <script>
        // Initialize and add the map
        function initMap() {

            var Clng = {{ $instructor->longitude}}
            var Clat = {{ $instructor->latitude}}
            console.log(Clat, Clng)
            // The location of Uluru
            var uluru = {lat: Clat, lng: Clng};
            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 4, center: uluru});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: uluru, map: map});
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCThcrK5A3j4WNF-7nF4NUfa4HAMjev6b0&callback=initMap">
    </script>
@endsection
