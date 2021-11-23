@extends('front_office.layouts.app')
@section('content')
<section>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-12 text-center mb-4">
                <img src="{{ asset('front-office/img/contact.jpg')}}" class="img-fluid" alt="contact">
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-lg-3 col-md-4">
                <div class="contact-box">
                    <div class="contact-box-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-box-content">
                        <h4 class="title">{{ __('Address') }}</h4>
                        <p class="description">{{ __('Doha, Qatar') }}</p>
                    </div>
                </div>
                <div class="contact-box">
                    <div class="contact-box-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="contact-box-content">
                        <h4 class="title">{{ __('Phone') }}</h4>
                        <p class="description">55757979</p>
                    </div>
                </div>
                <div class="contact-box">
                    <div class="contact-box-icon">
                        <i class="far fa-envelope"></i>
                    </div>
                    <div class="contact-box-content">
                        <h4 class="title">{{ __('Support') }}</h4>
                        <p class="description">support@doroos.qa</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <form class="form needs-validation" action="#!" method="POST" novalidate="">
                    <div class="form-group row">
                        <div class="col-md-6 mb-md-0 mb-4">
                            <input type="text" class="form-control" placeholder="{{ __('Full name') }}" required="">
                            <div class="invalid-feedback">Full Name is required</div>
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control" placeholder="{{ __('Email') }}" required="">
                            <div class="invalid-feedback">Email is required </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea rows="8" class="form-control" placeholder="{{ __('Messages details ...') }}"
                            required=""></textarea>
                        <div class="invalid-feedback">Messages details is required</div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115443.09541820473!2d51.58203668085407!3d25.284147788602137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e45c534ffdce87f%3A0x44d9319f78cfd4b1!2z2KfZhNiv2YjYrdip2Iwg2YLYt9ix!5e0!3m2!1sar!2s!4v1593004833081!5m2!1sar!2s"
    width="100%" height="550" frameborder="0" style="border:0; margin-bottom: -10px;" allowfullscreen=""
    aria-hidden="false" tabindex="0"></iframe>

@endsection