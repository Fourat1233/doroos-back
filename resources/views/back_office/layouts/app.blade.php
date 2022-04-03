<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Doroos Admin Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('back-office/img/icon.ico') }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ asset('back-office/js/plugin/webfont/webfont.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.0.0/dist/tf.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/body-pix@1.0.0"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["{{ asset('back-office/css/fonts.min.css') }}"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('back-office/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('back-office/css/atlantis.css') }}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('back-office/css/demo.css') }}">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">

				<a href="index-2.html" class="logo">
					<img src="{{ asset('back-office/img/logo.png') }}" style="width: 100px; margin-left: 35px;" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="https://themekita.com/demo-atlantis-bootstrap/livepreview/examples/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="https://themekita.com/demo-atlantis-bootstrap/livepreview/examples/assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>{{ Auth::user()->email }}</h4>
												<p class="text-muted">Connected</p>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="" data-toggle="modal" data-target="#editPassword" >Change password</a>
										<div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('back.secure.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('back.secure.logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="https://themekita.com/demo-atlantis-bootstrap/livepreview/examples/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<span class="user-level">Administrator</span>
                                    {{ Auth::user()->email }}
								</span>
							</a>
							<div class="clearfix"></div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item {{ !Request::segment(3)  ? 'active' : null }}">
							<a href="{{ route('back.secure.home') }}">
								<i class="flaticon-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Management</h4>
						</li>
						<li class="nav-item {{ Request::segment(3) === 'subjects' ? 'active' : null }}">
							<a href="{{ route('back.secure.subject.home') }}">
								<i class="flaticon-agenda-1"></i>
								<p>Subjects</p>
							</a>
						</li>
						<li class="nav-item {{ Request::segment(3) === 'teachers' ? 'active' : null }}">
							<a href="{{ route('back.secure.teacher.home') }}">
								<i class="flaticon-profile"></i>
								<p>Teachers</p>
							</a>
						</li>
						<li class="nav-item {{ Request::segment(3) === 'students' ? 'active' : null }}">
							<a href="{{ route('back.secure.student.home') }}">
								<i class="flaticon-users"></i>
								<p>Students</p>
							</a>
						</li>
						<li class="nav-item {{ Request::segment(3) === 'stats' ? 'active' : null }}">
							<a href="{{ route('back.secure.stats.home') }}">
								<i class="flaticon-users"></i>
								<p>Stats</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->
		<div class="main-panel">
            @yield('content')
		<footer class="footer">
			<div class="container-fluid">
				<div class="copyright ml-auto">
					2021, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.facebook.com/codexjuniorentreprise/">Codex Junior Entreprise</a>
				</div>
			</div>
		</footer>
		</div>
	</div>

    {{-- Edit Password --}}
    <div class="modal fade" id="editPassword" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('back.secure.change.password') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group">
                                <label for="old_password">Old password</label>
                                <input type="pasword" name="old_password" class="form-control"  id="old_password" placeholder="Enter Old Password">
                                @error('old_password')
                                <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group">
                                <label for="new_password">New password</label>
                                <input type="text" name="password" class="form-control"  id="new_password" placeholder="Enter New Password">
                                @error('password')
                                <small id="emailHelp2" class="form-text text-danger text-muted">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group">
                                <label for="confirm_password">Confirm password</label>
                                <input type="text" name="password_" class="form-control"  id="confirm_password" placeholder="Enter Confirm Password">
                                @error('password_')
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
    {{-- Edit Password--}}

    @error('old_password')
    <script>
        $(document).ready(function(){
            $('#editPassword').modal({show: true});
        })
    </script>
    @enderror
    @error('password')
    <script>
        $(document).ready(function(){
            $('#editPassword').modal({show: true});
        })
    </script>
    @enderror
    @error('password_')
    <script>
        $(document).ready(function(){
            $('#editPassword').modal({show: true});
        })
    </script>
    @enderror

	<!--   Core JS Files   -->
	<script src="{{ asset('back-office/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('back-office/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('back-office/js/core/bootstrap.min.js') }}"></script>

	<!-- jQuery UI -->
	<script src="{{ asset('back-office/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('back-office/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ asset('back-office/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

	<!-- Moment JS -->
	<script src="{{ asset('back-office/js/plugin/moment/moment.min.js') }}"></script>

	<!-- Chart JS -->
	<script src="{{ asset('back-office/js/plugin/chart.js/chart.min.js') }}"></script>

	<!-- jQuery Sparkline -->
	<script src="{{ asset('back-office/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

	<!-- Chart Circle -->
	<script src="{{ asset('back-office/js/plugin/chart-circle/circles.min.js') }}"></script>

	<!-- Datatables -->
	<script src="{{ asset('back-office/js/plugin/datatables/datatables.min.js') }}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{ asset('back-office/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

	<!-- Bootstrap Toggle -->
	<!-- <script src="{{ asset('back-office/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script> -->

	<!-- jQuery Vector Maps -->
	<script src="{{ asset('back-office/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
	<script src="{{ asset('back-office/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

	<!-- Google Maps Plugin -->
	<script src="{{ asset('back-office/js/plugin/gmaps/gmaps.js') }}"></script>

	<!-- Dropzone -->
	<script src="{{ asset('back-office/js/plugin/dropzone/dropzone.min.js') }}"></script>

	<!-- Fullcalendar -->
	<script src="{{ asset('back-office/js/plugin/fullcalendar/fullcalendar.min.js') }}"></script>

	<!-- DateTimePicker -->
	<script src="{{ asset('back-office/js/plugin/datepicker/bootstrap-datetimepicker.min.js') }}"></script>

	<!-- Bootstrap Tagsinput -->
	<script src="{{ asset('back-office/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

	<!-- Bootstrap Wizard -->
	<script src="{{ asset('back-office/js/plugin/bootstrap-wizard/bootstrapwizard.js') }}"></script>

	<!-- jQuery Validation -->
	<script src="{{ asset('back-office/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>

	<!-- Summernote -->
	<script src="{{ asset('back-office/js/plugin/summernote/summernote-bs4.min.js') }}"></script>

	<!-- Select2 -->
	<script src="{{ asset('back-office/js/plugin/select2/select2.full.min.js') }}"></script>

	<!-- Sweet Alert -->
	<script src="{{ asset('back-office/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

	<!-- Owl Carousel -->
	<script src="{{ asset('back-office/js/plugin/owl-carousel/owl.carousel.min.js') }}"></script>

	<!-- Magnific Popup -->
	<script src="{{ asset('back-office/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>

	<!-- Atlantis JS -->
	<script src="{{ asset('back-office/js/atlantis.min.js') }}"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="{{ asset('back-office/js/setting-demo.js') }}"></script>
	<script src="{{ asset('back-office/js/demo.js') }}"></script>

    <script src="{{ asset('back-office/js/core/jquery.3.2.1.min.js') }}"></script>


</body>
</html>
