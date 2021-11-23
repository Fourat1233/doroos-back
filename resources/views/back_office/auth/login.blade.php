
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('back-office/img/icon.ico') }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ asset('back-office/js/plugin/webfont/webfont.min.js') }}"></script>
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('back-office/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('back-office/css/atlantis.css') }}">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
	
		<div class="container container-login animated fadeIn">
			<h3 class="text-center">Sign In To Admin</h3>
			<form method="POST" action="{{ route('back.login') }}">
				@csrf
				<div class="login-form">
					<div class="form-group">
						<label for="email" class="placeholder"><b>{{ __('E-Mail Address') }}</b></label>
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="form-group">
						<label for="password" class="placeholder"><b>{{ __('Password') }}</b></label>
						<a href="#" class="link float-right">Forget Password ?</a>
						<div class="position-relative">
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
							<div class="show-password">
								<i class="icon-eye"></i>
							</div>
						</div>
					</div>
					<div class="form-group form-action-d-flex mb-3">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="rememberme">
							<label class="custom-control-label m-0" for="rememberme">Remember Me</label>
						</div>
						<button type="submit" class="btn btn-primary col-md-5 float-right mt-3 mt-sm-0 fw-bold">
							{{ __('Login') }}
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script src="{{ asset('back-office/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('back-office/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('back-office/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('back-office/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('back-office/js/atlantis.min.js') }}"></script>
</body>
</html>