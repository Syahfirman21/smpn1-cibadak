@extends('admin.themes.theme')

@section('title', 'Guru - SMPN 1 Cibadak')

@section('script-header')
  <style>
    .thumb-guru {
      width: 80px;
      max-height: 80px;
      overflow: hidden;
    }
    .thumb-guru img {
      width: 100%;
      height: auto; 
    }
    .sorting_1 {
      width: 20px;
    }
  </style>
  <link href="{{ asset('resource/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet">
  <!-- <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet"> -->
@endsection

@section('breadcrumbs')
    <h1>
        Guru
        <small>lihat list guru yang telah terdaftar</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Guru</li>
      </ol>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Guru</h3>
          <a href="{{ route('admin.guru.create') }}" class="btn-sm pull-right btn btn-primary">Tambah (<i class="fa fa-plus fa-fw"></i>)</a>
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