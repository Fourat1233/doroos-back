@extends('front_office.layouts.app')
@section('content')
    <section class="teacher-search-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <h4>{{__('BETTER EDUCATION FOR A BETTER')}}</h4>
                    <h2>{{__('EDUCATION IS THE KEY TO YOUR SUCCESS')}}</h2>
                    <div class="">
                        <a href="{{ route('front.teachers', app()->getLocale()) }}" class="btn btn-lg btn-light"  data-target="#advanced" type="button">{{__('ADVANCED SEARCH')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="rec-teachers">
            <div class="container">
                <div class="d-md-flex d-block justify-content-between title-section">
                    <h2>{{__('RECOMMENDED TEACHERS')}}</h2>
                    <a href="{{ route('front.teachers', app()->getLocale()) }}">{{__('SHOW ALL')}}</a>
                </div>
                <div class="row">
                    @foreach($teachers as $teacher)
                        <div class="col-lg-3 col-md-4 col-6">
                            <a href="{{ route('front.secure.profile', [app()->getLocale(), $teacher->user->id]) }}" style="text-decoration: none; color: #0b0b0b">
                                <div class="teacher-box">
                                    <div class="teacher-box-pic">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRrggIP1tphFNHqBURDu-6QY1TiSJVXQy0Uuw&usqp=CAU" class="img-fluid" alt="teacher-pic">
                                    </div>
                                    <div class="teacher-box-content">
                                        <h5>{{ $teacher->user->full_name }}</h5>
                                        <p>
                                            @foreach($teacher->subjects as $subject)
                                                {{ $subject->name }}
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="teacher-box-time">
                                        <p><i class="far fa-calendar mr-1"></i> MON - FRI</p>
                                        <p><i class="far fa-clock mr-1"></i> 09:00 - 16:00</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="container">
            <div class="d-md-flex d-block justify-content-between title-section">
                <h2>{{__('POPULAR SUBJECTS')}}</h2>
                <a href="{{ route('front.subjects', app()->getLocale()) }}">{{__('SHOW ALL')}}</a>
            </div>
            <div class="row">
                @foreach ($subjects as $subject)
                <div class="col-lg-3 col-md-4 col-6">
                    <a href="{{ route('front.teachers', [app()->getLocale(), 'subjects[]' => $subject->id]) }}" style="text-decoration: none; color: #0b0b0b">
                        <div class="subject-box">
                            <div class="subject-box-pic">
                                <img src="{{ asset('uploads/subjects/' . $subject->icon_url) }}" class="img-fluid" alt="subject-pic">
                            </div>
                            <div class="subject-box-content">
                            <h5>{{ app()->getLocale() === 'ar' ? $subject->ar_name : $subject->name }}, ({{ $subject->instructors_count }}) {{ __('Teachers') }}</h5>
                                <p>{{ app()->getLocale() === 'ar' ? $subject->category->ar_name : $subject->category->name }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
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
                        <h2>{{__('WHY')}} <br> DOROOS</h2>
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
