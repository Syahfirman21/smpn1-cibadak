<!DOCTYPE html>
<html>
<head>
    <title>Login To Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/login-form.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('asset/img/logo_sekolah.png') }}">
</head>
<body>
    <div class="login">
        <div class="logo">
            <img src="{{ asset('asset/img/logo_sekolah.png') }}">
            <div class="clear"></div>
        </div>
		<div class="form">
			<form method="POST" action="{{ route('login') }}">
				@csrf
		
				<div class="form-group row">
					<div class="col-md-8 offset-md-2"> <!-- Menambah offset untuk menjaga pesan di tengah -->
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
		
						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
		
				<div class="form-group row">
					<div class="col-md-8 offset-md-2"> <!-- Menambah offset untuk menjaga pesan di tengah -->
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
		
						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
		
				<div class="form-group row mb-0">
					<div class="col-md-8 offset-md-2"> <!-- Menambah offset untuk menjaga pesan di tengah -->
						<button type="submit" class="btn btn-primary">
							{{ __('Login') }}
						</button>
		
						@if (Route::has('password.request'))
							<a class="btn btn-link" href="{{ route('password.request') }}">
								{{ __('Forgot Your Password?') }}
							</a>
						@endif
					</div>
				</div>
			</form>
		
			<!-- Menambahkan pesan kesalahan di bawah form login -->
			@if(session('error'))
				<div class="alert alert-danger mt-3 text-center"> <!-- Menambahkan class text-center untuk pesan di tengah -->
					{{ session('error') }}
				</div>
			@endif
		</div>
		
    </div>
</body>
</html>
