@extends('admin.themes.theme')

@section('title', 'Edit Home Page - SMPN 1 Cibadak')

@section('breadcrumbs')
    <h1>
        Edit Home Page
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Home</li>
      </ol>
@endsection

@section('content')
      <div class="box box-primary">
        {!! Form::open(array('url'=>route('admin.home.update', $home->id), 'method'=>'PATCH')) !!}
        <div class="box-header with-border">
          <button class="btn btn-primary">Simpan</button>
        </div>
        <div class="box-body">
          @if (session()->has('flash_notification.message'))
          <div class="alert alert-{{ session()->get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session()->get('flash_notification.message') !!}
          </div>
          @endif
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">MOTTO Sekolah</h3>
            </div>
            <div class="panel-body">
              <textarea name="profile" id="" cols="30" rows="3" class="form-control">{{ $home->profile }}</textarea>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Profile Video Embed</h3>
            </div>
            <div class="panel-body">
              <textarea name="embed" id="" cols="30" rows="3" class="form-control">{{ $home->embed }}</textarea>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Konten Profile</h3>
            </div>
            <div class="panel-body">
              <textarea name="profileSekolah" id="" cols="30" rows="3" class="form-control">{{ $home->profileSekolah }}</textarea>
            </div>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
@stop
