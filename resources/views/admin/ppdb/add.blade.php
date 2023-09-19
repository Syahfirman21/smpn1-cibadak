@extends('admin.themes.theme')

@section('title', 'Import Data PPDB - SMPN 1 Cibadak')

@section('breadcrumbs')
    <h1>
        PPDB
        <small>Import data Peserta</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Import Data Peserta</li>
      </ol>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Import Data Peserta</h3>
        </div>
        <div class="box-body">
          {!! Form::open(array('url'=>route('admin.ppdb.store'), 'files'=>true, 'method'=>'post', 'class'=>'form-horizontal')) !!}
              <h4>Catatan Penting : (Wajib dibaca)</h4>
              <p>Buatlah file dalam bentuk excel dengan format header, <a href="{{asset('download/data_ppdb_sample.xlsx') }}">klik contoh formatnya disini </a>:</p>
              <ul>
                <li>Jalur: 1=EKTM/Afirmasi, 2=Prestasi akademik, 3=Prestasi non akademik/Kejuaraan, 4=Pindah tugas orangtua/guru, 5=Zonasi</li>
                <li>Nomor Peserta : Gunakan Kode P Untuk jalur prestasi/khusus, R untk jalur Reguler. Contoh: P1819001,R1819001 </li>
                <li>NISN</li>
                <li>Asal Sekolah</li>
                <li>Nama Lengkap</li>
                <li>Status Kelulusan : Gunakan kode 1 untuk siswa yang diterima dan 2 untuk siswa yang tidak diterima.</li>
              </ul>
            <div class="form-group">
               <label for="inputEmail3" class="col-sm-3 control-label">Upload File Excel</label>
              <div class="col-sm-9">
                <input type="file" class="form-control" name="uploadXls">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3">
                <button class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Import</button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
@stop
