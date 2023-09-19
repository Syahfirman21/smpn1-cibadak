@extends('admin.themes.theme')

@section('title', 'Pengaturan - SMPN 1 Cibadak')

@section('breadcrumbs')
    <h1>
        Pengaturan Situs
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengaturan</li>
      </ol>
@endsection

@section('content')
      @if (count($errors) > 0)
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Error!</h4>
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      @if (session()->has('flash_notification.message'))
      <!-- alert start -->
      <div class="alert alert-{{ session()->get('flash_notification.level') }} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-info-circle"></i> Keterangan!</h4>
        {!! session()->get('flash_notification.message') !!}
      </div>
      <!-- alert end -->
      @endif
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Social Link</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(array('url'=>route('admin.setting.updateLink'), 'method'=>'PATCH', 'class'=>'form-horizontal')) !!}
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-1 control-label"><i class="fa fa-facebook fa-fw"></i></label>
                  <div class="col-sm-11">
                    <input type="text" name="fblink" class="form-control" value="{{ $setting->fblink }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-1 control-label"><i class="fa fa-twitter fa-fw"></i></label>
                  <div class="col-sm-11">
                    <input type="text" name="twtlink" class="form-control" value="{{ $setting->twtlink }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-1 control-label"><i class="fa fa-google-plus fa-fw"></i></label>
                  <div class="col-sm-11">
                    <input type="text" name="gpluslink" class="form-control" value="{{ $setting->gpluslink }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-1 control-label"></label>
                  <div class="col-sm-11">
                    <button class="btn btn-primary">Simpan</button>
                  </div>
                </div>
              {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ganti Password</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(array('url'=>route('admin.setting.updatePass'), 'method'=>'PATCH', 'class'=>'form-horizontal')) !!}
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Password</label>
                  <div class="col-sm-9">
                    <input type="password" name="password" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">New Password</label>
                  <div class="col-sm-9">
                    <input type="password" name="newPassword" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Verify Password</label>
                  <div class="col-sm-9">
                    <input type="password"  name="newPassword_confirmation" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label"></label>
                  <div class="col-sm-9">
                    <button class="btn btn-primary">Ganti</button>
                  </div>
                </div>
              {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
@stop