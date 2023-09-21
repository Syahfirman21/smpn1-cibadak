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
				<form action="{{ route('berita.search-redirect') }}" method="POST">
					@csrf
					<input type="text" placeholder="Search..." name="keyword" autocomplete="off" />
					<button type="submit"></button>
				</form>
				
				
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
			{{---
			@if ($fotoKepala && $fotoKepala->thumbnail))
			<div class="thumb-kepala">
				<img src="{{ url('upload/'.$fotoKepala->thumbnail) }}" alt="" />
			</div>
			@endif
			<div class="welcome_title">
				<h2>Sambutan Kepala Sekolah<br />SMP Negeri 1 Cibadak</h2>
			</div>
			<p>
				{!! strip_tags(str_limit($sambutanKepala->description, 350)) !!}
			</p>
			<a href="{{ url('page/sambutan') }}" class="btn_read" style="width: 170px;padding:15px 0px;margin: 20px auto 0 auto">Lebih Lanjut</a>
			<p>
			
			<div style="padding-bottom:0; text-align:center">
				<h2>PPDB SMPN 1 CIBADAK</h2>
				<p style="padding:0; margin:10px auto">Berikut ini adalah, nama-nama siswa yang lolos seleksi PPDB SMPN 1 Cibadak tahap 1</p>
			</div>
			<div style="padding-bottom:25px; display:flex; gap:5px">
    			<a style="display:inline-block; margin-top:10px;" class="btn_read" target="_blank" href="{{ url('download/DATA-PESERTA-PPDB-YANG-DITERIMA-DI-SMPN-1-CIBADAK-TP-2022-2023.pdf') }}">
    			    PPDB Jalur Umum/Reguler
    		    </a>
    		    
    		    <a style="display:inline-block; margin-top:10px;" class="btn_read" target="_blank" href="{{ url('download/Data-Peserta-PPDB-yang-diterima-jalur-Zonasi.pdf') }}">
    			    PPDB Jalur Zonasi 
    		    </a>
		    </div>
		    ---}}
			<img src="/upload/banner-minified.jpeg" style="max-width:100%; margin:0 auto" />
			</p>
			{{-- <p>{{ $home->welcome }}
			</p> --}}
			<div class="welcome_kotak">
				<a href="{{ url('page/fasilitas') }}"><div class="welcome_litle fasilitas"></div>
				<h4>Fasilitas</h4></a>
			</div>
			<div class="welcome_kotak">
				<a href="#gallery"><div class="welcome_litle lokasi"></div>
				<h4>Lokasi</h4></a>
			</div>
			<div class="welcome_kotak">
				<a href="{{ url('page/about') }}"><div class="welcome_litle sejarah"></div>
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
				<a href="{{ url('blog/'.$news->id.'/'.$news->slug) }}">
				@if ($news->thumbnail)
					<img src=" {{ route('minimize.image', ['img'=>$news->thumbnail]) }}" alt="Paskibra" />
				@endif
				</a>
				<p>{{ Illuminate\Support\Str::limit(strip_tags($news->title), 40) }}</p>

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
					<a href="{{ url('/page/profil') }}" class="btn_read">Lebih Lanjut</a>
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
						<div class="thumbnail">
						@if($n->thumbAgenda)
							<a href="#"><img src=" {{ route('minimize.image', ['img'=>$n->thumbAgenda]) }}" alt="Pengumuman" /></a>
						@endif
						</div>
						<div class="agenda_title">
							<a href="{{ url('agenda/'.$n->id.'/'.$n->slug) }}"><h4>{{ $n->titleAgenda }}</h4></a>
						</div>
						<div class="text">
							<div class="text_kiri">
								<a href="javascript:void(0)">Pengumuman</a>
							</div>
							<div class="text_kanan">
								<a href="javascript:void(0)">{{ $n->tglMulai }}</a>
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
						<a><img src="{{ asset('upload/'.$galeri->img) }}" alt="" /></a>
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
				Copyright &copy; <a href="{{ url('/') }}">SMP Negeri 1 Cibadak</a>. All right Reserved. Hosting By <a href="https://idcloudhost.com/" target="_blank">IDCloudHost</a>
			</div>
			<div class="copy_right">
				Powered By <a href="http://itclub.smkn1cibadak.sch.id" target="_blank">IT Club SMKN 1 Cibadak</a>
			</div>
		</div>
	</div>
</body>
</html>
