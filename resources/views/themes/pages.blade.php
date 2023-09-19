@extends('themes.guest.page')

@section('title', $pageRole->title.' - SMPN 1 Cibadak')

@section('container')
		<div class="profil_title" style="text-align:center;margin-bottom:15px;">
			<h2>{{ $pageRole->title }} SMP Negeri 1 Cibadak</h2>
		</div>
		<div style="margin:15px 0;">
			<div class="top-description-about">
				@if ($pageRole->role == "sambutan" && isset($fotoKepala->thumbnail))
					<div class="thumb-kepala">
						<img src="{{ url('upload/'.$fotoKepala->thumbnail) }}" alt="" />
					</div>
				@elseif($pageRole->role == "jadwalPelajaran")
					<style media="screen">
						iframe.iframe-rate {
							width: 100%;
						}
					</style>
					<script language="javascript" type="text/javascript">
					  function resizeIframe(obj) {
					    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
					  }
					</script>
					<iframe src="{{ url('pure/index.html') }}" class="iframe-rate" scrolling="no" frameborder="0" onload="resizeIframe(this)"></iframe>
				@endif
				{!! $pageRole->description !!}
			</div>
		</div>
@stop
