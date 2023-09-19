@extends('admin.themes.theme')

@section('title', 'Tambah Berita - SMPN 1 Cibadak')

@section('script-header')
  <link rel="stylesheet" href="{{ asset('resource/plugins/datepicker/datepicker3.css') }}">
@endsection

@section('breadcrumbs')
	  <h1>
        Berita
        <small>tambah post berita</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah berita</li>
      </ol>
@endsection

@section('content')
	  {!! Form::open(array('url' => route('admin.berita.store'), 'files' => true, 'method' => 'post')) !!}
	  <div class="row">
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
            @if(count($errors) >0)
            <div class="form-space">
              <div class="alert alert-warning">{!! Html::ul($errors->all()) !!}</div>
            </div>
            @endif
            <div class="form-group">
              <input type="text" name="title" placeholder="Post Title" class="form-control" value="{{ old('title') }}">
            </div>
            <div class="form-group">
              <textarea name="isiBerita" style="min-height: 300px;">{{ old('isiBerita') }}</textarea>
            </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
        <div class="col-md-3">
          <div class="form-group"><button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-pencil fa-fw"></i> Publish</button></div>
          <div class="form-group">
            <span class="label label-danger"></span>
          </div>
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Image</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <input type="file" name="thumbnail" class="form-control">
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Kategori</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <input type="text" name="lable" class="form-control" value="{{ old('lable') }}">
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Tanggal</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <div class="input-group date" data-provide="datepicker">
                  <input type="text" class="form-control" name="postedAt" value="{{ old('postedAt') }}">
                  <div class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                  </div>
                </div>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
      </div>
      {!! Form::close() !!}
@endsection

@section('script-footer')
<script src="{{ asset('resource/plugins/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('resource/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
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
