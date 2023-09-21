@extends('admin.themes.theme')

@section('title', 'Tambah Agenda - SMPN 1 Cibadak')

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


            <form action="{{ route('admin.agenda.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
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
                          @if($errors->any())
                          <div class="form-space">
                              <div class="alert alert-warning">
                                  <ul>
                                      @foreach($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                          </div>
                          @endif
                          <div class="form-group">
                              <input type="text" name="titleAgenda" value="{{ old('titleAgenda') }}" placeholder="Post Title" class="form-control">
                          </div>
                          <div class="form-group">
                              <textarea name="descAgenda" style="min-height: 300px;">{{ old('descAgenda') }}</textarea>
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
                              <input type="text" name="tempat" value="{{ old('tempat') }}" class="form-control">
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
                                  <input type="text" class="form-control" name="tglMulai" value="{{ old('tglMulai') }}">
                                  <div class="input-group-addon">
                                      <span class="fa fa-calendar"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="bootstrap-timepicker">
                              <div class="form-group">
                                  <label>Waktu:</label>
                                  <div class="input-group">
                                      <input type="text" class="form-control timepicker" name="jamMulai" value="{{ old('jamMulai') }}">
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
                                  <input type="text" class="form-control" name="tglAkhir" value="{{ old('tglAkhir') }}">
                                  <div class="input-group-addon">
                                      <span class="fa fa-calendar"></span>
                                  </div>
                              </div>
                          </div>
                          <div class="bootstrap-timepicker">
                              <div class="form-group">
                                  <label>Waktu:</label>
                                  <div class="input-group">
                                      <input type="text" class="form-control timepicker" name="jamSelesai" value="{{ old('jamSelesai') }}">
                                      <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                      </div>
                                  </div><!-- /.input group -->
                              </div>
                          </div>
                      </div><!-- /.box-body -->
                  </div><!-- /.box -->
              </div>
          </form>
          
            {{-- {!! Form::open(array('url' => route('admin.agenda.store'), 'files' => true, 'method' => 'post')) !!}
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
                @if(count($errors) > 0)
                <div class="form-space">
                  <div class="alert alert-warning">{!! Html::ul($errors->all()) !!}</div>
                </div>
                @endif
                <div class="form-group">
                  <input type="text" name="titleAgenda" value="{{ old('titleAgenda') }}" placeholder="Post Title" class="form-control">
                </div>
                <div class="form-group">
                  <textarea name="descAgenda" style="min-height: 300px;">{{ old('descAgenda') }}</textarea>
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
                    <input type="text" name="tempat" value="{{ old('tempat') }}" class="form-control">
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
                        <input type="text" class="form-control" name="tglMulai" value="{{ old('tglMulai') }}">
                        <div class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </div>
                    </div>
                  </div>
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>Waktu:</label>
                      <div class="input-group">
                        <input type="text" class="form-control timepicker" name="jamMulai" value="{{ old('jamMulai') }}">
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
                        <input type="text" class="form-control" name="tglAkhir" value="{{ old('tglAkhir') }}">
                        <div class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </div>
                    </div>
                  </div>
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>Waktu:</label>
                      <div class="input-group">
                        <input type="text" class="form-control timepicker" name="jamSelesai" value="{{ old('jamSelesai') }}">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            {!! Form::close() !!} --}}
          </div>
@endsection

@section('script-footer')
<script src="{{ asset('resource/plugins/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('resource/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('resource/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script type="text/javascript">

tinymce.init({
  selector: "textarea",

  // ===========================================
  // INCLUDE THE PLUGIN
  // ===========================================

  plugins: [
    "advlist autolink lists link image charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table contextmenu paste jbimages"
  ],
  plugin_preview_height: 500,

  // ===========================================
  // PUT PLUGIN'S BUTTON on the toolbar
  // ===========================================

  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",

  // ===========================================
  // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
  // ===========================================

  relative_urls: false

});
//Timepicker
$(".timepicker").timepicker({
  showInputs: false
});

</script>
@stop
