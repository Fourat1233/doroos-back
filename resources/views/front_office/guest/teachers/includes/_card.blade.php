<div class="col-lg-4 col-md-6" id="{{ $teacher->id }}">
    <a href="{{ route('front.secure.profile', [app()->getLocale(), 1]) }}"
        style="text-decoration: none; color: #0b0b0b">
        <div class="teacher-box">
            <div class="teacher-box-pic">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRrggIP1tphFNHqBURDu-6QY1TiSJVXQy0Uuw&usqp=CAU"
                    class="img-fluid" alt="teacher-pic">
            </div>
            <div class="teacher-box-content">
                <h5>{{ $teacher->full_name }}</h5>
                <h6 style="font-weight: 600" class="mt-1">{{ $teacher->user->gender == 'Male' ? __('Male') : __('Female')}}</h6>
                <p>
                    {{ $teacher->subjects->implode('name', ', ') }}
                </p>
                <h4 style="font-weight: 700">{{ $teacher->pricing }} {{ __('QR') }}</h4>
            </div>
            <div class="teacher-box-time">
                <p><i class="far fa-calendar mr-1"></i> MON - FRI</p>
                <p><i class="far fa-clock mr-1"></i> 09:00 - 16:00</p>
            </div>
        </div>
    </a>
</div>