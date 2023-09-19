@extends('admin.themes.theme')

@section('title', 'List Siswa - SMPN 1 Cibadak')

@section('script-header')
  <link rel="stylesheet" href="{{ asset('resource/plugins/datepicker/datepicker3.css') }}">
  <link href="{{ asset('resource/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet">
  <!-- <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet"> -->
  <style>
    .dataTables_filter {
      display: none;
    }
  </style>
@endsection

@section('breadcrumbs')
	  <h1>
        Siswa
        <small>lihat list siswa yang telah di terdaftar</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List siswa</li>
      </ol>
@endsection

@section('content')
	  <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Siswa : {{ $kelasAtas }}</h3>
          <div class="action pull-right">
            {!! Form::open(array('url'=>route('admin.siswa.destroyAll', ['id'=>$id, 'kelas'=>$kelas]), 'method'=>'delete', 'style'=>'display:inline-block')) !!}
            <button class="btn btn-danger btn-md" type="submit">Hapus Semua</button>
            {!! Form::close() !!}
          </div>
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