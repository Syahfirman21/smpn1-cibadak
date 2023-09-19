<?php 
function excerpt($string) {
	$string = substr($string, 0, 40);
	return $string.' ...';
}
 ?>
<!DOCTYPE html>
<!-- Coding and Design By IT Club SMKN 1 Cibadak -->
<html>
<head>
	<title>SMP Negeri 1 Cibadak</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/css/responsive.css') }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('asset/img/logo_sekolah.png') }}">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
</head>
<body>
	<div id="top">
		<div class="container">
			<!-- untuk bg -->
			<div class="nav">
			<!-- untuk logo -->
			<div class="logo">
				<img src="{{ asset('asset/img/logo_sekolah.png') }}" alt="SMP Negeri 1 Cibadak" title="SMP Negeri 1 Cibadak" />
			</div>
			<!-- untuk menu -->
			<div class="menu">
				<input type="checkbox"/>
				<label for="nav"></label>
				@include('partials._menus')
			</div>
			<!-- search -->
			<div class="search">
				{!! Form::open(array('url'=>route('berita.search-redirect'), 'method'=>'POST')) !!}
				<input type="text" placeholder="Search..." name="keyword" />
				<button></button>
				{!! Form::close() !!}
			</div>
			</div>
			<div class="clear"></div>
			<!-- Bagian Detail Sekolah -->
			<div class="top_detail">
				<div class="top_title2">
					<h3>Motto</h3>
					<p>
					{{ $home->profile }}
					</p>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div id="welcome">
		<div class="container">
			<div class="welcome_title">
				<h2>Sambutan Kepala Sekolah<br />SMP Negeri 1 Cibadak</h2>
			</div>
			<p>{{ $home->welcome }}
			</p>
			<div class="welcome_kotak">
				<a href="{{ url('page/fasilitas') }}"><div class="welcome_litle fasilitas"></div>
				<h4>Fasilitas</h4></a>
			</div>
			<div class="welcome_kotak">
				<a href="#gallery"><div class="welcome_litle lokasi"></div>
				<h4>Lokasi</h4></a>
			</div>
			<div class="welcome_kotak">
				<a href="{{ url('about') }}"><div class="welcome_litle sejarah"></div>
				<h4>Sejarah</h4></a>
			</div>
			<div class="welcome_kotak">
				<a href="{{ url('page/prestasi') }}"><div class="welcome_litle prestasi"></div>
				<h4>Prestasi</h4></a>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div id="news">
		<div class="container">
			<div class="news_title" style="margin:0px 0px 1% 1%;">
				<h2>BERITA</h2>
			</div>
			@foreach($berita as $news)
			<div class="kotak_news">
				<a href="{{ url('blog/'.$news->id.'/'.$news->slug) }}"><img src="
				{{ route('minimize.image', ['img'=>$news->thumbnail]) }}" alt="Paskibra" /></a>
				<p><?= strip_tags(excerpt($news->isiBerita)) ?>
				</p>
				<a href="{{ url('blog/'.$news->id.'/'.$news->slug) }}"><img src="{{ asset('asset/img/icon_read.png') }}" class="read"></a>
			</div>
			@endforeach
			<div class="clear"></div>
		</div>
	</div>
	<!-- Profil + Agenda -->
	<div id="profil">
		<div class="container">
			<div class="profil_sekolah">
				<div class="profil_title">
					<h2>PROFIL SEKOLAH</h2>
				</div>
				<div class="embed_video">
					{!! $home->embed !!}
				</div>
				<div class="deskripsi">
					<p>
						{{ $home->profileSekolah }}
					</p>
					<a href="{{ url('/page/about') }}" class="btn_read">Lebih Lanjut</a>
				</div>
				<div class="clear"></div>
			</div>
			<div class="agenda">
				<div class="profil_title">
					<h2>AGENDA</h2>
				</div>
				<div class="konten_agenda">
					@foreach($agenda as $n)
					<div class="agenda_konten">
						<div class="thumbnail"><a href="#"><img src="
						{{ route('minimize.image', ['img'=>$n->thumbAgenda]) }}" alt="Pengumuman" /></a></div>
						<div class="agenda_title">
							<a href="{{ url('agenda/'.$n->id.'/'.$n->slug) }}"><h4>{{ $n->titleAgenda }}</h4></a>
						</div>
						<div class="text">
							<div class="text_kiri">
								<a href="#">Pengumuman</a>
							</div>
							<div class="text_kanan">
								<a href="#">{{ $n->tglMulai }}</a>
							</div>
						</div>
						<div class="clear"></div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<!-- Bagian Gallery Foto -->
	<div id="gallery">
		<div class="container">
			<div class="gallery">
				<div class="profil_title">
					<h2>GALLERY</h2>
				</div>
					@foreach($galleries as $galeri)
					<div class="kotak_gallery">
						<a href="#"><img src="{{ asset('upload/'.$galeri->img) }}" alt="" /></a>
					</div>
					@endforeach
					<div class="clear"></div>
			</div>
			<div class="map">
				<div class="profil_title">
					<h2>ALAMAT</h2>
				</div>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.970535243761!2d106.79250619999999!3d-6.8941278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68316af442641b%3A0x96edb366f22211d5!2sSMP+NEGERI+1+CIBADAK!5e0!3m2!1sid!2s!4v1443026643046" width="100%" height="300px" frameborder="0" style="border:0" allowfullscreen=""></iframe>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="container">
		@include('partials._footer')
	</div>
	<div class="copyright">
		<div class="container">
			<div class="copy_left">
				Copyright &copy; <a href="#">SMP Negeri 1 Cibadak</a>. Server by <a href="http://idcloudhost.com/">IDCloudHost</a> 4 School
			</div>
			<div class="copy_right">
				Powered By <a href="http://itclub.smkn1cibadak.sch.id" target="_blank">IT Club SMKN 1 Cibadak</a>
			</div>
		</div>
	</div>
</body>
</html>