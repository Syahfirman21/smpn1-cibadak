@extends('themes.guest.page')

@section('title', 'Guru - SMPN 1 Cibadak')

@section('header-script')
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/css/table.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/css/popup.css') }}">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endsection

@section('container')
		<div id="popup">
	    	<div class="window">
	        	
	        </div>
	    </div>
	    <div class="profil_title" style="text-align:center;margin-bottom:0px !important;margin-top:0 !important;">
			<h2>Data Guru</h2>
		</div>
		<div class="table_post">
			<table>
				<thead>
					<tr>
						<th class="small">No</th>
						<th class="small">Photo</th>
						<th class="one">Nama</th>
						<th class="one">NIP</th>
						<th>Pelajaran</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = ($teachers->currentPage()-1) * $teachers->perPage() + 1; ?>
					@foreach($teachers as $guru)
					<tr>
						<td>{{ $i++ }}</td>
						<td><a href="javascript:void(0)" data-target="#indomie" data-load="{{ url('guru/'.$guru->id) }}"><img src="{{ asset('upload/'.$guru->thumbnail) }}" alt="{{ $guru->nama }}" /></a></td>
						<td>{{ $guru->nama }}</td>
						<td>{{ $guru->nip }}</td>
						<td>{{ $guru->mapel }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@include('partials.pagination', ['paginator' => $teachers])
		</div>
@endsection
@section('footer-script')
<script>
	$(document).ready(function(){
		$("a[data-target=#indomie]").click(function(ev) {
		    ev.preventDefault();
		    var target = $(this).attr("data-load");

		    // load the url and show modal on success
		    $("#popup .window").html('<p align="center"><img src="{{ asset('asset/img/loader.gif') }}" width="150" style="padding:150px 0px; margin:0 auto;"/></p>');
		    $("#popup .window").load(target, function() { 
		        // $("#myModal").modal("show"); 
		        $('#popup').addClass('showmodal');
		    });
		});
	});
</script>
@stop