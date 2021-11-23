@extends('front_office.layouts.app')
@section('content')
    <style>
        .btn-primary:hover {
            background: #32384C;
            color: #ffffff;
        }
        .form-row {
            border-bottom: 1px solid #32384C;
        }
    </style>
    <header class="header-sub">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="title">Advanced Search</h1>
                </div>
            </div>
            <div>
                <form class="teacher-search-box-form needs-validation" novalidate method="get" action="{{ route('front.search.home', app()->getLocale()) }}">
                    <div class="form-row align-items-center">
                        <div class="col-md-9">
                            <input class="form-control form-control-lg" type="text" placeholder="TAPE TO SEARCH">
                        </div>
                        <div class="col-md-3 col-6">
                            <button class="btn btn-lg btn-primary" type="submit">SEARCH</button>
                        </div>
                    </div>
                    <div class="row align-items-center " id="advanced">
                        <div class="col-md-12">
                            <div class=" p-3">
                                <h5 style="color: #0b0b0b"> Subject</h5>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" checked>
                                    <label class="custom-control-label" for="customCheck1">All</label>
                                </div>

                                @foreach($subjects as $subject)
                                    <div class="custom-control custom-checkbox custom-control-inline" style="margin-top: 5px">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2" value="{{ $subject->name }}" name="subjects[]" >
                                        <label class="custom-control-label" for="customCheck2">{{ $subject->name }}</label>
                                    </div>
                                @endforeach
                                <hr>

                                <h5 style="color: #0b0b0b"> Gender </h5>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="any" name="gender" value="Any" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="any">Any</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="male" name="gender" value="Male" class="custom-control-input" {{ $gender === 'Male' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="male">Male</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="female" name="gender" value="Female" class="custom-control-input" {{ $gender === 'Female' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </header>
    <section>
        <div class="container">
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
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    {!! $teachers->appends(Request::all())->links() !!}
                </ul>
            </nav>
        </div>
    </section>
@endsection
