@extends('themes.guest.page')

@section('title', 'Gallery - SMPN 1 Cibadak')

@section('container')
		<div class="profil_title" style="text-align:center;margin-bottom:15px;">
			<h2>Gallery SMP Negeri 1 Cibadak</h2>
		</div>
		<div style="margin:15px 0;">
			<div class="gal-row">
				@foreach ($galcategories as $category)
				<div class="gal-list-col">
					<a href="{{ route('galeri.kategori', ['kategori'=>$category->kategori]) }}">
						@if ($category->galleries()->first() == null)
							<span>{{ $category->kategori }}</span>
						@else
							<img src="{{ url('upload') }}/{{ $category->galleries()->first()->img }}" alt="" />
							<span>{{ $category->kategori }}</span>
						@endif
					</a>
				</div>
				@endforeach
				<div class="clear"></div>
			</div>
			@include('partials.pagination', ['paginator' => $galcategories])
		</div>
@stop
