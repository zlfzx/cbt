<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Register</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('assets/img/icon.ico') }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['{{ asset("assets/css/fonts.css") }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/azzara.min.css') }}">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-signup animated fadeIn">
			<h3 class="text-center">Sign Up</h3>
			<div class="login-form">
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div class="form-group">
            <label for="fullname" class="placeholder">Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="email" class="placeholder">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="passwordsignin" class="placeholder">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="confirmpassword" class="placeholder">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">            
          </div>
          <div class="form-group">
            <label for="roles">Roles</label><br>
            <div class="custom-control custom-checkbox mr-3">
              <input type="checkbox" name="roles[]" value="admin" id="role-admin" class="custom-control-input">
              <label for="role-admin" class="custom-control-label">Admin</label>
            </div>
            <div class="custom-control custom-checkbox mr-3">
              <input type="checkbox" name="roles[]" value="petugas_soal" id="role-petugas-soal" class="custom-control-input">
              <label for="role-petugas-soal" class="custom-control-label">Petugas Soal</label>
            </div>
            <div class="custom-control custom-checkbox mr-3">
              <input type="checkbox" name="roles[]" value="petugas_ujian" id="role-petugas-ujian" class="custom-control-input">
              <label for="role-petugas-ujian" class="custom-control-label">Petugas Ujian</label>
            </div>
          </div>
          <div class="form-action">
            {{-- <a href="#" id="show-signin" class="btn btn-danger btn-rounded btn-login mr-3">Cancel</a> --}}
            <button type="submit" class="btn btn-primary btn-rounded btn-login">Sign Up</button>
          </div>
        </form>
			</div>
		</div>
	</div>
	<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/ready.js') }}"></script>
</body>
</html>