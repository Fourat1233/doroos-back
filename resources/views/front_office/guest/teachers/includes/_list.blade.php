@foreach($teachers as $teacher)
    @include('front_office.guest.teachers.includes._card', [ 'teacher' => $teacher ])
@endforeach