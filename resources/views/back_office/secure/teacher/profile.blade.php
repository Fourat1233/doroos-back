@extends('back_office.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner ">
            <div class="col-md-12">
                <div class="card card-post card-round">
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="https://themekita.com/demo-atlantis-lite-bootstrap/livepreview/examples/assets/img/profile2.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="info-post ml-2">
                                    <p class="username">{{$teacher->user->full_name}}</p>
                                    <p class="date text-muted">{{$teacher->user->created_at->format('D d-m-Y')}}</p>
                                </div>
                            </div>
                            @if(!$teacher->is_trusted)
                            <div class="ml-md-auto py-2 py-md-0">
                                <div class="ml-md-auto py-2 py-md-0">
                                    <a href="{{ route('back.secure.teacher.validation', $teacher->id )}}" type="button" class="btn btn-primary">
                                        {{-- <i class="fa fa-exclamation-circle"></i> --}}
                                        Validate Account
                                    </a>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#reviewAccount">
                                        {{-- <i class="fa fa-exclamation-circle"></i> --}}
                                        Send Review
                                    </button>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="separator-solid"></div>
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body ">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <img src="{{ asset('back-office/img/profile_icons/1.png') }}" alt="..." class="avatar-img">
                                            </div>
                                            <div class="col col-stats ml-3 ml-sm-0">
                                                <div class="numbers">
                                                    <h4 class="card-title">Resume</h4>
                                                    <p class="card-category">Resume</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <img src="{{ asset('back-office/img/profile_icons/2.png') }}" alt="..." class="avatar-img">
                                            </div>
                                            <div class="col col-stats ml-3 ml-sm-0">
                                                <div class="numbers">
                                                    <h4 class="card-title">Degrees</h4>
                                                    <p class="card-category">Degrees</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <img src="{{ asset('back-office/img/profile_icons/3.png') }}" alt="..." class="avatar-img">
                                            </div>
                                            <div class="col col-stats ml-3 ml-sm-0">
                                                <div class="numbers">
                                                    <h4 class="card-title">Certificates</h4>
                                                    <p class="card-category">Certificates</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <img src="{{ asset('back-office/img/profile_icons/4.png') }}" alt="..." class="avatar-img">
                                            </div>
                                            <div class="col col-stats ml-3 ml-sm-0">
                                                <div class="numbers">
                                                    <h4 class="card-title">Experiences</h4>
                                                    <p class="card-category">Experiences</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-home text-info"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">State</p>
                                                    <h4 class="card-title">{{ $teacher->state }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-home text-info"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">City</p>
                                                    <h4 class="card-title">{{ $teacher->city }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-calendar text-info"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Years of experience</p>
                                                    <h4 class="card-title">{{ $teacher->years_of_experience }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="flaticon-coins text-info"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Pricing</p>
                                                    <h4 class="card-title">{{ $teacher->pricing }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-info card-annoucement card-round">
                            <div class="card-body">
                                <div class="card-opening">About {{ $teacher->user_full_name }}</div>
                                <div class="card-desc">
                                    {{ $teacher->about }}
                                </div>
                            </div>
                        </div>
                        {{-- ----------------------------------
                            
                            <div class="row mt--2">
                <div class="col-md-12">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">Overall statistics</div>
                            <div class="card-category">Information about statistics in system</div>
                            <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div style="width: 100px; height: 100px; border-radius: 50px; border: 5px solid #8E68AD; position: relative">
                                        <h1 style="position: absolute; top: 30%; bottom: 0; left: 0; right: 0">10</h1>
                                    </div>
                                    <h6 class="fw-bold mt-3 mb-0">Subjects</h6>
                                </div>
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div style="width: 100px; height: 100px; border-radius: 50px; border: 5px solid #8E68AD; position: relative">
                                        <h1 style="position: absolute; top: 30%; bottom: 0; left: 0; right: 0">25</h1>
                                    </div>
                                    <h6 class="fw-bold mt-3 mb-0">Teachers</h6>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                            
                            
                            
                            --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    Review --}}
    <div class="modal fade" id="reviewAccount" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Review teacher account </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('back.secure.teacher.review', $teacher->id) }}" id="form-category">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea type="text" name="message" class="form-control" value="{{ old('message') }}" id="message" rows="10" required>
                                </textarea>
                                @error('message')
                                <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="pl-2">
                            <button type="reset" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="submit">
                                Send Review
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
