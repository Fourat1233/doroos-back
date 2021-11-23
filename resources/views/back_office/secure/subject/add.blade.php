@extends('back_office.layouts.app')
@section('content')
    <style>
        .bootstrap-tagsinput input {
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
            width: 100%;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            font-size: 14px;
            border-color: #ebedf2;
            padding: .6rem 1rem;
            height: inherit !important;
        }
    </style>
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">New Subject</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('back.secure.subject.home') }}">Subjects</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Subject</div>
                        </div>
                        <form method="POST" action="{{ route('back.secure.subject.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="name" placeholder="Enter Name">
                                            @error('name')
                                                <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label for="ar_name">Arabic Name</label>
                                            <input type="text" name="ar_name" class="form-control" value="{{ old('ar_name') }}" id="ar_name" placeholder="Enter the arabic name">
                                            @error('ar_name')
                                            <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label for="subject_tags d-flex">Tags</label><br>
                                            <input type="text" name="subject_tags" class="form-control" value="{{ old('subject_tags') }}"  id="subject_tags"  data-role="tagsinput" >
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label for="category">Subject Category</label>
                                            <select name="category" class="form-control" id="category">
                                                <option value="" selected>Choose category</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                            <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <div class="input-file input-file-image">
                                                <img class="img-upload-preview" width="150" src="http://placehold.it/150x150" alt="preview">
                                                <input type="file" class="form-control form-control-file" id="uploadImg2" name="file" accept="image/*">
                                                <label for="uploadImg2" class="  label-input-file btn btn-black btn-round">
                                                        <span class="btn-label">
                                                            <i class="fa fa-file-image"></i>
                                                        </span>
                                                    Upload a Image
                                                </label>
                                                @error('file')
                                                <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
