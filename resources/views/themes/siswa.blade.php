<?php
	function kelas($string) {
		$rombel = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
		return $rombel[$string-1];
	}
?>
@extends('themes.guest.page')

@section('title', 'Siswa - SMPN 1 Cibadak')

@section('header-script')
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/css/table.css') }}">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endsection

@section('container')
	    <div class="profil_title" style="text-align:center;margin-bottom:0px !important;margin-top:0 !important;">
			<h2>Data Siswa</h2>
		</div>
		<div class="table_post">
			<table>
				<thead>
					<tr>
						<th class="small">No</th>
						<th class="one">Nama</th>
						<th class="one">NIS</th>
						<th class="small">Gender</th>
						<th class="small">Kelas</th>
					</tr>
				</thead>
				<tbody>
					<?php $x = 1; ?>
					@foreach($siswa as $murid)
					<tr>
						<td>{{ $x++ }}</td>
						<td>{{ $murid->nama }}</td>
						<td>{{ $murid->nis }}</td>
						<td>{{ $murid->gender }}</td>
						<td>{{ $murid->kelas }} {{ kelas($murid->class_id) }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
@stop