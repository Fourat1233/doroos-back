@extends('front_office.layouts.app')
@section('content')
    <section>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <img src="{{ asset('front-office/img/about.jpg')}}" class="img-fluid img-rounde" alt="about">
                </div>
                <div class="col-lg-6">
                    <h2 class="h1">Welcome to Doroos</h2>
                    <h2>Let’s do study with expert teachers</h2>
                    <p class="text-muted">Aelltes port lacus quis enim var sed efficitur turpis gilla sed sit Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                    <p class="text-muted">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of lorem ipsum amet finibus eros. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.</p>
                    <p class="text-muted">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of lorem ipsum.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="video">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="video-content">
                        <h2 class="video-title">Doroos one &amp; only <br>
                            mission is to extend <br>
                            your knowledge base
                        </h2>
                    </div>
                </div>
                <div class="col-lg-5 d-flex justify-content-lg-end justify-content-sm-start">
                    <div class="my-auto">
                        <a href="#" class="video-popup"><i class="fa fa-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class=" feature">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img src="{{ asset('front-office/img/phone-mockup.png')}}" class="img-fluid" alt="phone-mockup">
                </div>
                <div class="col-lg-7">
                    <div class="title-section">
                        <h2>WHY <br> DOROOS</h2>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="feature-box">
                                <i class="far fa-lightbulb"></i>
                                <h4 class="title">UNIQUE DESIGN</h4>
                                <p class="description">Sed ut perspiciatis unde omnis iste natus error sit volup tatem usantium dolore.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="feature-box">
                                <i class="fas fa-shield-alt"></i>
                                <h4 class="title">MORE SECURE</h4>
                                <p class="description">Sed ut perspiciatis unde omnis iste natus error sit volup tatem usantium dolore.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="feature-box">
                                <i class="fas fa-headphones-alt"></i>
                                <h4 class="title">AWESOME SUPPORT</h4>
                                <p class="description">Sed ut perspiciatis unde omnis iste natus error sit volup tatem usantium dolore.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="feature-box">
                                <i class="fas fa-heart"></i>
                                <h4 class="title">EASY TO USE</h4>
                                <p class="description">Sed ut perspiciatis unde omnis iste natus error sit volup tatem usantium dolore.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
