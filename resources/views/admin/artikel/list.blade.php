@extends('admin.themes.theme')

@section('title', 'List Berita - SMPN 1 Cibadak')

@section('script-header')
  <link rel="stylesheet" href="{{ asset('resource/plugins/datepicker/datepicker3.css') }}">
  <link href="{{ asset('resource/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet">
  <!-- <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet"> -->
@endsection

@section('breadcrumbs')
	  <h1>
        Berita
        <small>lihat list berita yang telah di publish</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List berita</li>
      </ol>
@endsection

@section('content')
	  <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Berita</h3>
        </div>
        <div class="box-body">
        	@if (session()->has('flash_notification.message'))
			<div class="alert alert-{{ session()->get('flash_notification.level') }}">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{!! session()->get('flash_notification.message') !!}
			</div>
			@endif
        	{!! $html->table(['class'=>'table table-bordered table-hover dataTable']) !!}
    	</div>
      </div>
@endsection

@section('script-footer')
<script src="{{ asset('resource/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('resource/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
{!! $html->scripts() !!}
@stop