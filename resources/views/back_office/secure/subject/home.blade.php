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
        @include('back_office.partials.flash')
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Subjects</h2>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="{{ route('back.secure.subject.create') }}" class="btn btn-white btn-border btn-round mr-2">Add new subject</a>
                        <button type="button" class="btn btn-white btn-border btn-round mr-2" id="add-category"  data-toggle="modal" data-target="#addCategory">
                            Add category
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row" id="subjects">
                @foreach ($subjects as $subject)
                    <div class="col-sm-6 col-lg-4">
                        <div class="card p-3">
                            <div class="row pl-3 pr-3">
                               <div class="d-flex align-items-center flex-grow-1">
                                   <img src="{{ asset('uploads/subjects/' . $subject->icon_url) }}" style="height: 60px; width: 60px; margin-right: 10px;"/>
                                   <div>
                                       <h5><b><a href="#">{{ $subject->name }}</a></b></h5>
                                       <small class="text-muted">{{ $subject->category->name }}</small>
                                   </div>
                               </div>
                                <div class=" pt-3 pl-2">
                                    <div>
                                        <button data-id="{{ $subject->id  }}" type="button" class="btn btn-danger btn-rounded btn-sm" id="delete-subject" data-toggle="modal" data-target="#deleteModel">
                                            <i class="fas fa-trash-alt delete"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3 align-items-center">
                                <b>Tags :</b>
                                @foreach($subject->tags as $tag)
                                    <a href="#" class="btn btn-primary btn-rounded btn-sm ml-1 mt-1">{{ $tag->name }}</a>
                                @endforeach
                                @if(count($subject->tags) !== 0)
                                    <button type="button" class="btn btn-secondary btn-rounded btn-sm ml-1 mt-1" id="add-tags" data-subjectId={{ $subject->id }} data-toggle="modal" data-target="#addTags">
                                        Add
                                    </button>
                                @endif
                                @if(count($subject->tags) === 0)
                                    <button type="button" class="btn btn-light btn-rounded btn-sm ml-1 mt-1" id="add-tags" data-subjectId={{ $subject->id }} data-toggle="modal" data-target="#addTags">
                                        No tags press to add
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{--    Delete subject modal--}}
        <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Confirmation {{$subject->id}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Do you really want to delete this subject ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <form id='delete-form' class="actions mb-0" action="{{route('back.secure.subject.delete', ['id' => 1])}}" method="post">
                            {{method_field('DELETE')}}
                            <input type="hidden" name="subject_id" id="subject_id" value="">
                            @csrf
                            <div class="pl-2">
                                <button class="btn btn-danger" type="submit">
                                    Delete
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{--    Add category Modal--}}
        <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add new category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('back.secure.subject.category.store') }}" id="form-category">
                        @csrf
                        <div class="modal-body">
                            <div class="col-md-6 col-lg-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="name" placeholder="Enter Name" required>
                                    @error('name')
                                    <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-12">
                                <div class="form-group">
                                    <label for="ar_name">Arabic Name</label>
                                    <input type="text" name="ar_name" class="form-control" value="{{ old('ar_name') }}" id="ar_name" placeholder="Enter Arabic Name" required>
                                    @error('ar_name')
                                    <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="pl-2">
                                <button type="reset" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{--    Add tags modal--}}
        <div class="modal fade" id="addTags" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add tags to category </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('back.secure.subject.tags.store') }}">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="subject_id" id="subject_id" value="{{ $subject->id }}">
                            <div class="col-md-6 col-lg-12">
                                <div class="form-group">
                                    <label for="subject_tags d-flex">Tags</label><br>
                                    <input type="text" name="subject_tags" class="form-control"  id="subject_tags"  data-role="tagsinput" required>
                                    @error('subject_tags')
                                    <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="pl-2">
                                <button type="reset" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="{{ asset('back-office/js/core/jquery.3.2.1.min.js') }}"></script>

        <script>
            $(document).ready(function () {
                $('#addCategory');
                    $('#subjects > div').each(function( ) {
                        $(this).find('#delete-subject').each(function(){
                            $(this).click(function(e) {
                                var id = e.target.dataset.id
                                var action = $('#delete-form').attr('action')
                                var newAction = action.slice(0, action.length-1)
                                $('#delete-form').attr('action', newAction + id)
                            })
                        });
                    });
            })
        </script>

        @error('subject_tags')
            <script>
                $(document).ready(function(e){
                    e.preventDefault();
                    $('#addTags').modal({show: true});
                })
            </script>
        @enderror
        @error('name')
            <script>
                $(window).load(function() {
                    $('#addCategory').modal('show');
                });
            </script>
        @enderror
        @error('ar_name')
        <script>
            $(document).ready(function(e){
                //e.preventDefault();
                //$('#addCategory').modal({show: true});
            })
        </script>
        @enderror
    </div>
@endsection
