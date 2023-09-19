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
              {!! Form::open(array('url'=>route('admin.siswa.store'), 'method'=>'post', 'class'=>'form-horizontal')) !!}
              <div class="table-responsive">
                <table class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>NIS</th>
                      <th>Jenis Kelamin</th>
                      <th>Kelas</th>
                      <th>Rombel</th>
                    </tr>
                  </thead>
                  <tbody>
                    @for ($i = 0; $i < $siswa; $i++)                
                    <tr>
                      <td>{{ $i+1 }}</td>
                      <td><input type="text" class="form-control" name="nama{{ $i }}"></td>
                      <td><input type="text" class="form-control" name="nis{{ $i }}"></td>
                      <td>
                        <select name="gender{{ $i }}" class="form-control">
                          <option>Pilih</option>
                          <option value="L">Laki-laki</option>
                          <option value="P">Perempuan</option>
                        </select>
                      </td>
                      <td>
                        <input type="text" name="kelas" value="{{ $kelas }}" disabled>
                      </td>
                      <td>
                        <input type="text" name="class_id" value="{{ $id }}" disabled>
                      </td>
                    </tr>
                    @endfor
                  </tbody>
                  <input type="hidden" value="{{ $siswa }}" name="jumlah">
                </table>
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
                  <button class="btn btn-primary">Tambah Siswa</button>
                </div>
              </div>
            {!! Form::close() !!}
            </div><!-- /.box-body -->
          </div><!-- /.box -->
@stop