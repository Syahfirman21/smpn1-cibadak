@extends('themes.guest.page')

@section('title', 'Gallery: '.$images->kategori.' - SMPN 1 Cibadak')

@section('header-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endsection

@section('container')
		<div class="profil_title" style="text-align:center;margin-bottom:15px;">
			<h2>Gallery : {{ $images->kategori }}</h2>
		</div>
		<div style="margin:15px 0;">
			@if(count($images->galleries) <= 0 | null)
				Belum ada image yang tersedia...
			@endif
			<?php
				$kategories = $images->galleries()->paginate(8);
			?>
			<div class="gal-row">
				@foreach ($kategories as $kategori)
				<div class="gal-list-cols">
					<div class="image-space">
						<img src="{{ url('upload/'.$kategori->img) }}" alt="">
					</div>
					<a href="javascript:void(0)" data-target="#indomie" data-load="{{ route('galeri.kategori.img', ['kategori'=>$kategori->galcategory_id, 'img'=>$kategori->img]) }}"><i class="fa fa-plus"></i></a>
				</div>
				@endforeach
				<div class="clear"></div>
			</div>
		</div>
		@include('partials.pagination', ['paginator' => $kategories])
		<div class="image-box" id="image-box">

    	</div>
@endsection

@section('footer-script')
<script>
	$(document).ready(function(){
		$("a[data-target=#indomie]").click(function(ev) {
		    ev.preventDefault();
		    var target = $(this).attr("data-load");

		    // load the url and show modal on success
		    $("#image-box").html('<p align="center"><img src="http://smpn1cibadak.sch.id/asset/img/loader.gif" width="150" style="padding:150px 0px; margin:0 auto;"/></p>');
		    $("#image-box").load(target, function() {
		        // $("#myModal").modal("show");
		        $('#image-box').addClass('image-noscale');
		    });
		});
	});
</script>

@stop