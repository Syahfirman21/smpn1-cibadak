@extends('admin.themes.theme')

@section('title', 'Edit Berita - SMPN 1 Cibadak')

@section('script-header')
  <link rel="stylesheet" href="{{ asset('resource/plugins/datepicker/datepicker3.css') }}">
  <link rel="stylesheet" href="{{ asset('resource/plugins/timepicker/bootstrap-timepicker.min.css') }}">
@endsection

@section('breadcrumbs')
	  <h1>
        Agenda
        <small>publish agenda baru</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah agenda</li>
      </ol>
@endsection

@section('content')
	         <div class="row">
            {!! Form::model($agendaEdit, ['url' => route('admin.agenda.update', $agendaEdit->id),'method'=>'put', 'files'=>true]) !!}
            <div class="col-md-9">
              <div class="box box-default">
                <div class="box-body">
                @if (session()->has('flash_notification.message'))
                <!-- alert start -->
                <div class="alert alert-{{ session()->get('flash_notification.level') }} alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Published!</h4>
                  {!! session()->get('flash_notification.message') !!}
                </div>
                <!-- alert end -->
                @endif
                @if(isset($errors))
                <div class="form-space">
                  {!! Html::ul($errors->all()) !!}
                </div>
                @endif
                <div class="form-group">
                  <input type="text" name="titleAgenda" placeholder="Post Title" class="form-control" value="{{ $agendaEdit->titleAgenda }}">
                </div>
                <div class="form-group">
                  <textarea name="descAgenda" style="min-height: 300px;">{{ $agendaEdit->descAgenda }}</textarea>
                </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            <div class="col-md-3">
              <div class="form-group"><button class="btn btn-lg btn-primary btn-block" name="publish" type="submit"><i class="fa fa-pencil fa-fw"></i> Publish</button></div>
              <div class="form-group">
                <span class="label label-danger"></span>
              </div>
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Image</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                    <input type="file" name="thumbAgenda" class="form-control">
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Tempat</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                    <input type="text" name="tempat" class="form-control" value="{{ $agendaEdit->tempat }}">
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Waktu Mulai</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                    <label>Tanggal:</label>
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" name="tglMulai" value="{{ $agendaEdit->tglMulai }}">
                        <div class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </div>
                    </div>
                  </div>
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>Waktu:</label>
                      <div class="input-group">
                        <input type="text" class="form-control timepicker" name="jamMulai" value="{{ $agendaEdit->jamMulai }}">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Waktu Akhir</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                    <label>Tanggal:</label>
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" name="tglAkhir" value="{{ $agendaEdit->tglAkhir }}">
                        <div class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </div>
                    </div>
                  </div>
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>Waktu:</label>
                      <div class="input-group">
                        <input type="text" class="form-control timepicker" name="jamSelesai" value="{{ $agendaEdit->jamSelesai }}">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            {!! Form::close() !!}
          </div>
@endsection

@section('script-footer')
<script src="{{ asset('resource/plugins/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('resource/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('resource/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script>
  tinymce.init({
    selector: 'textarea',  // change this value according to your HTML
    plugins : 'advlist autolink link image lists charmap print preview code table preview',
    plugin_preview_height: 500
  });
  //Timepicker
  $(".timepicker").timepicker({
    showInputs: false
  });
</script>
@stop