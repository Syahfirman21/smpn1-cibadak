@extends('admin.themes.theme')

@section('title', 'Tambah Siswa - SMPN 1 Cibadak')

@section('breadcrumbs')
	  <h1>
        Siswa
        <small>tambah daftar siswa</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah siswa</li>
      </ol>
@endsection

@section('content')
          <div class="box box-default">
            <div class="box-body">
              {!! Form::open(array('url'=>route('admin.siswa.createAdvanced'), 'method'=>'post', 'class'=>'form-horizontal')) !!}
              <div class="form-group">
                 <label for="inputEmail3" class="col-sm-1 control-label">Kelas</label>
                <div class="col-sm-11">
                  <select name="kelas" class="form-control">
                    <option>Pilih Kelas</option>
                    <option value="VII">VII</option>
                    <option value="VIII">VIII</option>
                    <option value="IX">IX</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                 <label for="inputEmail3" class="col-sm-1 control-label">Rombel</label>
                <div class="col-sm-11">
                  <select name="id" class="form-control">
                    <option>Pilih Rombel</option>
                    <option value="1">A</option>
                    <option value="2">B</option>
                    <option value="3">C</option>
                    <option value="4">D</option>
                    <option value="5">E</option>
                    <option value="6">F</option>
                    <option value="7">G</option>
                    <option value="8">H</option>
                    <option value="9">I</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                 <label for="inputEmail3" class="col-sm-1 control-label">Jumlah Siswa</label>
                <div class="col-sm-11">
                  <input type="text" class="form-control" name="jumlahSiswa">
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
                  <button class="btn btn-primary">Next</button>
                </div>
              </div>
            {!! Form::close() !!}
            </div><!-- /.box-body -->
          </div><!-- /.box -->
@stop