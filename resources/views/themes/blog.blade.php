@extends('themes.guest.page')

@section('title', 'Berita - SMPN 1 Cibadak')

@section('container')
		<div class="profil_title" style="text-align:center;margin-bottom:15px;">
			<h2>Berita</h2>
		</div>
		<div class="main_post_list">
			<div class="post_list">
				@foreach($berita as $n)
				<div class="post_entry_list">
					<div class="post_title">
						<h4>{{ $n->title }}</h4>
					</div>
					<div class="post_thumb">
						<img src="
						{{ route('minimize.image', ['img'=>$n->thumbnail]) }}" alt="Post1" />
					</div>
					<div class="post_description">
						<p>{!! Illuminate\Support\Str::limit(strip_tags($n->isiBerita), 300) !!}</p>

					</div>
					<div class="post_action">
						<div class="action_left">
							<a href="javascript:void(0)">{{ date('d M Y', strtotime($n->postedAt)) }}</a>
							<a href="javascript:void(0)">0 Comments</a>
						</div>
						<div class="action_right">
							<a href="{{ url('blog/'.$n->id.'/'.$n->slug) }}" class="read_more_btn">More</a>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				@endforeach
				{{ $berita->render() }}
			</div>
			<div class="sidebar">
				<div class="sidebar_box gallery2">
					<div class="sidebar_title"><h4>Gallery</h4></div>
					<div class="sidebar_content">
						@foreach($galleries as $galeri)
						<div class="gallery-kotak">
						<img src="{{ asset('upload/'.$galeri->img) }}" />
						</div>
						@endforeach
						<div class="clear"></div>
					</div>
				</div>
				<div class="sidebar_box">
					<div class="sidebar_title"><h4>Recent Post</h4></div>
					<div class="sidebar_content">
						<ul>
							@foreach($recent as $a)
							<li><a href="{{ url('blog/'.$a->id.'/'.$a->slug) }}">{{ $a->title }}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="sidebar_box">
					<div class="sidebar_content">
						<div class="fb-page" data-href="https://www.facebook.com/SMPN-1-CIBADAK-STOENDAK-109390909145006" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>
					</div>
				</div>
				<div class="sidebar_box">
					<div class="sidebar_content">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.970535243761!2d106.79250619999999!3d-6.8941278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68316af442641b%3A0x96edb366f22211d5!2sSMP+NEGERI+1+CIBADAK!5e0!3m2!1sid!2s!4v1443026643046" width="100%" height="300px" frameborder="0" style="border:0" allowfullscreen=""></iframe>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>

@stop