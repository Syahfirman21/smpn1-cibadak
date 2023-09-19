@extends('admin.themes.theme')

@section('title', 'Edit Guru - SMPN 1 Cibadak')

@section('breadcrumbs')
    <h1>
        Edit Guru
        <small>edit data guru</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Guru</li>
      </ol>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Guru : {{ $guru->nama }}</h3>
        </div>
        <div class="box-body">
          {!! Form::model($guru, ['url' => route('admin.guru.update', $guru->id),'method'=>'put', 'files'=>true, 'class'=>'form-horizontal']) !!}
            <div class="form-group">
               <label for="inputEmail3" class="col-sm-1 control-label">Nama</label>
              <div class="col-sm-11">
                <input type="text" class="form-control" name="nama" value="{{ $guru->nama }}">
              </div>
            </div>
            <div class="form-group">
               <label for="inputEmail3" class="col-sm-1 control-label">Foto</label>
              <div class="col-sm-11">
                <input type="file" class="form-control" name="thumbnail">
              </div>
            </div>
            <div class="form-group">
               <label for="inputEmail3" class="col-sm-1 control-label">NIP</label>
              <div class="col-sm-11">
                <input type="text" class="form-control" name="nip" value="{{ $guru->nip }}">
              </div>
            </div>
            <div class="form-group">
               <label for="inputEmail3" class="col-sm-1 control-label">Pelajaran</label>
              <div class="col-sm-11">
                <input type="text" class="form-control" name="mapel" value="{{ $guru->mapel }}">
              </div>
            </div>
            @if(count($errors->all) > 0)
            <div class="form-group">
               <label for="inputEmail3" class="col-sm-1 control-label"></label>
              <div class="col-sm-11">
                {!! Html::ul($errors->all()) !!}
              </div>
            </div>
            @endif
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-1 control-label"></label>
              <div class="col-sm-11">
                <button class="btn btn-primary">Edit <i class="fa fa-edit"></i></button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>  
      </div>
@stop