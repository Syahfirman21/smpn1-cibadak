@extends('admin.themes.theme')

@section('title', 'Edit Siswa - SMPN 1 Cibadak')

@section('breadcrumbs')
    <h1>
        Edit Siswa
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit siswa</li>
      </ol>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Siswa</h3>
        </div>
        <div class="box-body">
          @if (session()->has('flash_notification.message'))
          <div class="alert alert-{{ session()->get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session()->get('flash_notification.message') !!}
          </div>
          @endif
          {!! Form::open(array('url'=>route('admin.siswa.update', $siswa->id), 'method'=>'PATCH', 'class'=>'form-horizontal')) !!}
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-1 control-label">Nama</label>
              <div class="col-sm-11">
                <input type="text" name="nama" value="{{ $siswa->nama }}" class="form-control">
              </div>
            </div>
            <div class="form-group">
               <label for="inputEmail3" class="col-sm-1 control-label">NIS</label>
              <div class="col-sm-11">
                <input type="text" name="nis" value="{{ $siswa->nis }}" class="form-control">
              </div>
            </div>
            <div class="form-group">
               <label for="inputEmail3" class="col-sm-1 control-label">Gender</label>
              <div class="col-sm-11">
                <select name="gender" class="form-control">
                  <option>Pilih jenis kelamin</option>
                  <option value="L">Laki - laki</option>
                  <option value="P">Perempuan</option>
                </select>
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
                <button class="btn btn-primary">Simpan</button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>  
      </div>
@stop