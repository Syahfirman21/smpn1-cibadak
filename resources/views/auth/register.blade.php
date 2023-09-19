<!DOCTYPE html>
<html>
<head>
    <title>Register To Panel</title>
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
            <form method="POST" action="{{ route('register') }}">
                @csrf <!-- Untuk proteksi CSRF -->

                <div class="input-group">
                    <span class="email"></span><input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                </div>

                <div class="input-group">
                    <span class="email"></span><input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                </div>

                <div class="input-group">
                    <span class="password"></span><input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="input-group">
                    <span class="password"></span><input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                </div>

                <button name="submit" class="register-button">Register</button>
            </form>
        </div>
    </div>
</body>
</html>
