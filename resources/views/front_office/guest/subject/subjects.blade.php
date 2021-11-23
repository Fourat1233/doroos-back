@extends('front_office.layouts.app')
@section('content')
    <style>
        .category {
            background: #f3f3f3;
            box-shadow: 0 0px 6px 2px rgba(0, 0, 0, 0.100);
        }
        .search-box {
            padding: 10px;
            border-radius: 2px;

        }
        .search-box input {
            margin-top: 10px;
            height: 40px;
            border-radius: 0;
        }
        .search-box .btn {
            border-radius: 0;
            font-weight: 300;
            background: #6c757d;
        }
        .search-box .btn:hover {
            background: #32384C;
            color: #ffffff;
        }
        .category .nav {
            padding: 10px;
        }
        .category .nav .nav-link {
            border-radius: 0;
            font-weight: 500;
            border: 1.3px solid #ffffff;
            background: #6c757d;
            color: #ffffff;
        }
        .category .nav .nav-link:hover {
            background: #32384C;
        }
    </style>
    <section class="container">
        <div class="row card-cont">
            <div class="col-3 category">
                <div class="search-box">
                    <form action="{{ route('front.subjects', app()->getLocale()) }}" method="get">
                        <div class="form-group">
                            <input type="text" class="form-control" id="search" name="search" value="{{ $input ?? '' }}"  placeholder="{{ __('TAPE TO SEARCH') }}" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-search col-12">{{ __('SEARCH') }}</button>
                        </div>
                    </form>
                </div>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <form action="{{ route('front.subjects', app()->getLocale()) }}" method="get">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="search" name="category" value="all" autocomplete="off" required>
                            <button type="submit" class="nav-link col-12" >{{ __('All categories') }}</button>
                        </div>
                    </form>
                    @foreach ($categories as $category)
                        <form action="{{ route('front.subjects', app()->getLocale()) }}" method="get">
                            <input type="hidden" class="form-control" id="search" name="category" value="{{ $category->name  }}"  autocomplete="off" required>
                            <div class="form-group">
                                <button type="submit" class="nav-link col-12" >{{ app()->getLocale() === 'ar' ? $category->ar_name : $category->name }}</button>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
            <div class="col-9" style="padding-top: 20px">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="row justify-content-center">
                        @foreach ($subjects as $subject)
                            <div class="col-lg-3 col-md-4 col-6">
                                <a href="{{ route('front.teachers', [app()->getLocale(), 'subjects[]' => $subject->id]) }}" style="text-decoration: none; color: #0b0b0b">
                                    <div class="subject-box">
                                        <div class="subject-box-pic">
                                            <img src="{{ asset('uploads/subjects/' . $subject->icon_url) }}" class="img-fluid" alt="subject-pic">
                                        </div>
                                        <div class="subject-box-content">
                                            <h5>{{ app()->getLocale() === 'ar' ? $subject->ar_name : $subject->name }}</h5>
                                            <p>{{ app()->getLocale() === 'ar' ? $subject->category_ar_name : $subject->category_name }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <nav aria-label="Page navigation example" style="margin-bottom: 10px">
                        <ul class="pagination justify-content-end">
                            {!! $subjects->appends(Request::all())->links() !!}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
