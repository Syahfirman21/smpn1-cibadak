@extends('admin.themes.theme')

@section('title', 'Tambah Siswa - SMPN 1 Cibadak')

@section('breadcrumbs')
	  <h1>
        Import Data Siswa
        <small>import daftar siswa sekaligus melalui excel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Import siswa</li>
      </ol>
@endsection

@section('content')
          <div class="modal fade" id="modal-id">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Cara Setting CSV</h4>
                </div>
                <div class="modal-body">
                  <ol>
                    <li>Buat sebuah file baru di excel</li>
                    <li>Buat urutan seperti berikut<br />
                    <img src="{{ asset('upload/contohExcel.png') }}" alt="" style="width:60%">
                    </li>
                    <li>Isi baris selanjutnya pada bagian nama dengan nama siswa</li>
                    <li>Pada bagian nis isi dengan NIS siswa</li>
                    <li>Pada bagian gender isi L/P</li>
                    <li>Pada bagian kelas isi VII/VIII/IX</li>
                    <li>Pada bagian class_id isi angka 1-9
                      <blockquote>
                        Class_id dimana urutan angka 1-9 adalah urutan rombel, seperti berikut <br>
                        A = 1 <br>
                        B = 2 <br>
                        dan selanjutnya...
                      </blockquote>
                    </li>
                    <li>Hingga akhirnya seperti ini <br>
                      <img src="{{ asset('upload/contohExcel2.png') }}" alt="" style="width:60%">
                    </li>
                    <li>Jumlah baris siswa tidak terbatas, bisa diisi berapapun</li>
                  </ol>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <div class="box box-default">
            <div class="box-header">
              <h3>Import Data Siswa</h3>
            </div>
            <div class="box-body">
              @if (session()->has('flash_notification.message'))
              <div class="alert alert-{{ session()->get('flash_notification.level') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {!! session()->get('flash_notification.message') !!}
              </div>
              @endif
              {!! Form::open(array('url'=>route('admin.siswa.import'), 'method'=>'post', 'class'=>'form-horizontal', 'files'=>true)) !!}
              <div class="form-group">
                 <label for="inputEmail3" class="col-sm-1 control-label">File</label>
                <div class="col-sm-11">
                  <input type="file" name="dataSiswa">
                </div>
              </div>
              <div class="form-group">
                 <label for="inputEmail3" class="col-sm-1 control-label">Note</label>
                <div class="col-sm-11">
                  <div class="well well-sm">
                    <ul>
                      <li>File harus berformat (.csv)</li>
                      <li>Susun siswa dalam file secara benar, ikuti <a data-toggle="modal" href='#modal-id'>Tutorial</a></li>
                    </ul>
                  </div>
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
                  <button class="btn btn-primary">Import</button>
                </div>
              </div>
            {!! Form::close() !!}
            </div><!-- /.box-body -->
          </div><!-- /.box -->
@stop