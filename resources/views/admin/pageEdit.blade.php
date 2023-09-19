@extends('admin.themes.theme')

@section('title', 'Edit Page '.$pageMode->title.' - SMPN 1 Cibadak')

@section('breadcrumbs')
	  <h1>
        Edit Page : {{ $pageMode->title }}
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{ $pageMode->title }}</li>
      </ol>
@endsection

@section('content')
	         <div class="row">
            {!! Form::open(array('url' => route('admin.pages.update', ['pages'=>$pageMode->role]), 'files' => true, 'method' => 'patch')) !!}
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
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                  <textarea name="description" style="min-height: 300px;">{{ $pageMode->description }}</textarea>
                </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            <div class="col-md-3">
              <div class="form-group"><button class="btn btn-lg btn-primary btn-block" name="publish" type="submit"><i class="fa fa-pencil fa-fw"></i> Simpan</button></div>
              <div class="form-group">
                <span class="help-block">Terkahir update pada: <b>{{ date('d-M-Y H:i:s', strtotime($pageMode->updated_at)) }}</b></span>
              </div>
            </div>
            {!! Form::close() !!}
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