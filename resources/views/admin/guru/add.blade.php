@extends('admin.themes.theme')

@section('title', 'Tambah Guru - SMPN 1 Cibadak')

@section('breadcrumbs')
    <h1>
        Guru
        <small>tambahkan data guru</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Guru</li>
      </ol>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Guru</h3>
        </div>
        <div class="box-body">


          <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
    @csrf
    <div class="form-group">
        <label for="nama" class="col-sm-1 control-label">Nama</label>
        <div class="col-sm-11">
            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" id="nama">
        </div>
    </div>
    <div class="form-group">
        <label for="thumbnail" class="col-sm-1 control-label">Foto</label>
        <div class="col-sm-11">
            <input type="file" class="form-control" name="thumbnail" id="thumbnail">
        </div>
    </div>
    <div class="form-group">
        <label for="nip" class="col-sm-1 control-label">NIP</label>
        <div class="col-sm-11">
            <input type="text" class="form-control" name="nip" value="{{ old('nip') }}" id="nip">
        </div>
    </div>
    <div class="form-group">
        <label for="mapel" class="col-sm-1 control-label">Pelajaran</label>
        <div class="col-sm-11">
            <input type="text" class="form-control" name="mapel" value="{{ old('mapel') }}" id="mapel">
        </div>
    </div>
    @if($errors->any())
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label"></label>
        <div class="col-sm-11">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label"></label>
        <div class="col-sm-11">
            <button class="btn btn-primary">Tambah (<i class="fa fa-plus"></i>)</button>
        </div>
    </div>
</form>

          {{-- {!! Form::open(array('url'=>route('admin.guru.store'), 'files'=>true, 'method'=>'post', 'class'=>'form-horizontal')) !!}
            <div class="form-group">
               <label for="inputEmail3" class="col-sm-1 control-label">Nama</label>
              <div class="col-sm-11">
                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
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
                <input type="text" class="form-control" name="nip" value="{{ old('nip') }}">
              </div>
            </div>
            <div class="form-group">
               <label for="inputEmail3" class="col-sm-1 control-label">Pelajaran</label>
              <div class="col-sm-11">
                <input type="text" class="form-control" name="mapel" value="{{ old('mapel') }}">
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
                <button class="btn btn-primary">Tambah (<i class="fa fa-plus"></i>)</button>
              </div>
            </div>
          {!! Form::close() !!} --}}
        </div>
      </div>
@stop
