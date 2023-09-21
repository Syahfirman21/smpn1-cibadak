@extends('admin.themes.theme')

@section('title', 'Pilih Kelas - SMPN 1 Cibadak')

@section('breadcrumbs')
    <h1>
        Pilih Kelas
        <small>pilih kelas yang akan di tampilkan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pilih kelas</li>
      </ol>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Pilih Kelas</h3>
          <div class="action pull-right">
            <a href="{{ route('admin.siswa.importIndex') }}" class="btn btn-primary btn-md">Import Data</a>
          </div>
        </div>
        <div class="box-body">


          <form action="{{ route('admin.siswa-redirect') }}" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group">
                <label for="kelas" class="col-sm-1 control-label">Kelas</label>
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
                <label for="id" class="col-sm-1 control-label">Rombel</label>
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
            @if(count($errors->all()) > 0)
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
                    <button class="btn btn-primary">Select (<i class="fa fa-plus"></i>)</button>
                </div>
            </div>
        </form>
        
          {{-- {!! Form::open(array('url'=>route('admin.siswa-redirect'), 'method'=>'post', 'class'=>'form-horizontal')) !!}
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
                <button class="btn btn-primary">Select (<i class="fa fa-plus"></i>)</button>
              </div>
            </div>
          {!! Form::close() !!} --}}
        </div>  
      </div>
@stop