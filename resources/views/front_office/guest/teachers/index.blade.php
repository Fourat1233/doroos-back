@extends('front_office.layouts.app')
@section('content')
<div class="container mt-4 mb-4 js-filter-container">
    <div class="row">
        <div class="col-md-3 p-4" style="background: #f3f3f3; box-shadow: 0 0px 6px 2px rgba(0, 0, 0, 0.100);">
            @include('front_office.guest.teachers.includes._filter', [ 'form' => $form, 'min' => $min, 'max' => $max ])
        </div>
        <div class="col-md-9 ">
            {{-- <div class="row justify-content-end">
                <div class="mb-2 js-filter-sorting">
                    @include('front_office.guest.teachers.includes._sorting')
                </div>
            </div> --}}
            <div class="row js-filter-items">
                @include('front_office.guest.teachers.includes._list', [ 'teachers' => $teachers ])
            </div>
        </div>
    </div>
    <div class="pagination justify-content-end js-filter-pagination">
        @include('front_office.guest.teachers.includes._pagination', [ 'teachers' => $teachers ])
    </div>
</div>
@endsection