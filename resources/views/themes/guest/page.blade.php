<!DOCTYPE html>
<!-- Coding and Design By IT Club SMKN 1 Cibadak -->
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/css/responsive.css') }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('asset/img/logo_sekolah.png') }}">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	@yield('header-script')
</head>
<body>
	<div class="container">
		<div class="nav" style="margin:50px 0px 25px 0px;">
			<!-- untuk logo -->
			<div class="logo">
				<img src="{{ asset('asset/img/logo_sekolah.png') }}">
			</div>
			<!-- untuk menu -->
			<div class="menu">
				<input type="checkbox"/>
				<label for="nav"></label>
				@include('partials._menus')
			</div>
			<!-- search -->
			<div class="search">
				<form action="{{ route('berita.search-redirect') }}" method="POST">
					@csrf
					<input type="text" placeholder="Search..." name="keyword" autocomplete="off" />
					<button type="submit"></button>
				</form>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="container">
		@yield('container')
	</div>
	<div class="container">
		@include('partials._footer')
	</div>
	<div class="copyright">
		<div class="container">
			<div class="copy_left">
				Copyright &copy; <a href="{{ url('/') }}">SMP Negeri 1 Cibadak</a>. All right Reserved. Hosting By <a href="https://idcloudhost.com/" target="_blank">IDCloudHost</a>
			</div>
			<div class="copy_right">
				Powered By <a href="http://itclub.smkn1cibadak.sch.id" target="_blank">IT Club SMKN 1 Cibadak</a>
			</div>
		</div>
	</div>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.5&appId=1510859499181861";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
@yield('footer-script')
</body>
</html>