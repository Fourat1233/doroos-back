@extends('back_office.layouts.app')
@section('content')
<div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">
                <div class="col-md-12">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">Overall statistics</div>
                            <div class="card-category">Information about statistics in system</div>
                            <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div style="width: 100px; height: 100px; border-radius: 50px; border: 5px solid #8E68AD; position: relative">
                                        <h1 style="position: absolute; top: 30%; bottom: 0; left: 0; right: 0">{{ $subjects_count }}</h1>
                                    </div>
                                    <h6 class="fw-bold mt-3 mb-0">Subjects</h6>
                                </div>
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div style="width: 100px; height: 100px; border-radius: 50px; border: 5px solid #8E68AD; position: relative">
                                        <h1 style="position: absolute; top: 30%; bottom: 0; left: 0; right: 0">{{ $teachers_count }}</h1>
                                    </div>
                                    <h6 class="fw-bold mt-3 mb-0">Teachers</h6>
                                </div>
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div style="width: 100px; height: 100px; border-radius: 50px; border: 5px solid #8E68AD; position: relative">
                                        <h1 style="position: absolute; top: 30%; bottom: 0; left: 0; right: 0;">{{ $students_count }}</h1>
                                    </div>
                                    <h6 class="fw-bold mt-3 mb-0">Students</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title fw-mediumbold">Lasts registered teachers</div>
                            <div class="card-list">
                                @foreach ($teachers as $teacher)
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="https://themekita.com/demo-atlantis-bootstrap/livepreview/examples/assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle">
                                    </div>
                                    <div class="info-user ml-3">
                                        <div class="username">{{ $teacher->user->full_name }}</div>
                                        <div class="status">
                                            @foreach($teacher->subjects as $subject)
                                                {{ $subject->name }}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title fw-mediumbold">Lasts registered students</div>
                            <div class="card-list">
                                @foreach($students as $student)
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="https://themekita.com/demo-atlantis-bootstrap/livepreview/examples/assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle">
                                    </div>
                                    <div class="info-user ml-3">
                                        <div class="username">{{ $student->full_name }}</div>
                                        <div class="status">{{ $student->created_at->format('D d-m-Y') }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
