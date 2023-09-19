@extends('themes.guest.page')

@section('title', 'Agenda - SMPN 1 Cibadak')

@section('container')
		<div class="main_post_list">
			<div class="post_list">
				<div class="post_entry_list" style="display:none;">
				</div>
				<div class="post_entry_list" style="display:block">
					<div class="post_title">
						<h4>{{ $agendas->titleAgenda }}</h4>
					</div>
					<div class="post_breadcrumb">
						Home / Agenda / {{ $agendas->titleAgenda }}
					</div>
					<div class="post_thumb">
						<img src="{{ asset('upload/'.$agendas->thumbAgenda) }}" />
					</div>
					<div class="post_description">
						{!! $agendas->descAgenda !!}
					</div>
				</div>
			</div>
			<div class="sidebar">
				<div class="sidebar_box">
					<div class="sidebar_title"><h4>Info Agenda</h4></div>
					<div class="sidebar_content agenda-info">
						<ul>
							<li>
								<span class="agenda-title"><i class="fa fa-clock-o"></i>Waktu Mulai</span>
								<span class="isi"><i class="fa fa-clock-o"></i>{{ $agendas->jamMulai }}</span>
								<span class="isi"><i class="fa fa-clock-o"></i>{{ $agendas->tglMulai }}</span>
							</li>
							<li>
								<span class="agenda-title"><i class="fa fa-flag"></i>Waktu Selesai</span>
								<span class="isi"><i class="fa fa-clock-o"></i>{{ $agendas->jamSelesai }}</span>
								<span class="isi"><i class="fa fa-clock-o"></i>{{ $agendas->tglAkhir }}</span>
							</li>
							<li>
								<span class="agenda-title"><i class="fa fa-map-marker"></i>Tempat</span>
								<span class="isi"><i class="fa fa-clock-o"></i>{{ $agendas->tempat }}</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="sidebar_box">
					<div class="sidebar_content">
						<div class="sidebar_content">
						<div class="fb-page" data-href="https://www.facebook.com/SMPN-1-CIBADAK-STOENDAK-109390909145006" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
@stop