@extends('back_office.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Students</h4>
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
                        <a href="#">List</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="collapse" id="search-nav">
                                <form class="navbar-left navbar-form nav-search mr-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="submit" class="btn btn-search pr-1">
                                                <i class="fa fa-search search-icon"></i>
                                            </button>
                                        </div>
                                        <input type="text" placeholder="Search students ..." class="form-control" name="search" id="search">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-head-bg-primary">
                                <thead>
                                <tr>
                                    <th scope="col-sm">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Speciality</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone number</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @include('back_office.secure.teacher.pagination_data')
                                </tbody>
                            </table>
                            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('back-office/js/core/jquery.3.2.1.min.js') }}"></script>
        <script>
            $(document).ready(function(){

                function fetch_data(page, query)
                {
                    $.ajax({
                        url:"/back_office/secure/teachers/search?page="+page+"&query="+query,
                        success:function(data) {
                            $('tbody').html('');
                            $('tbody').html(data);
                        }
                    })
                }

                $(document).on('keyup', '#search', function() {
                    var query = $(this).val();
                    var page = $('#hidden_page').val();
                    fetch_data(page, query);
                });

                $(document).on('click', '.pagination a', function(event) {
                    event.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    $('#hidden_page').val(page);
                    var query = $('#search').val();

                    $('li').removeClass('active');
                    $(this).parent().addClass('active');
                    fetch_data(page, query);
                });

            });
        </script>
    </div>
@endsection
