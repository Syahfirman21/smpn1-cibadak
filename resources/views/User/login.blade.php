<!DOCTYPE html>
<html>
<head>
	<title>Login To Panel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="asset/css/style.css">
	<link rel="stylesheet" type="text/css" href="asset/css/login-form.css">
	<link rel="shortcut icon" type="image/x-icon" href="asset/img/logo_sekolah.png">
</head>
<body>
	<div class="login">
		<div class="logo">
			<img src="asset/img/logo_sekolah.png">
			<div class="clear"></div>
		</div>
		<div class="form">
			<form action="admin/login" method="post">
				<span class="email"></span><input type="text" name="email" placeholder="Email" required>
				<span class="password"></span><input type="password" name="password" placeholder="Password" required><br />
				<ul></ul>
				<button type="submit" name="submit">Login</button>
			</form>
		</div>
	</div>
</body>
</html>
