@extends('admin.themes.theme')

@section('title', 'List Gallery - SMPN 1 Cibadak')

@section('breadcrumbs')
	  <h1>
        Galeri
        <small>lihat list Galeri yang telah di publish</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List galeri</li>
      </ol>
@endsection

@section('script-header')
  <style>
    .gallery{margin:20px 0}.list-gallery{position:relative;height:250px;text-align:center;line-height:250px;border:1px solid #c3c3c3;margin-bottom:30px}.list-gallery button{line-height:normal;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:rgba(255,255,255,.3);color:#fff;border:none;border-radius:3px;width:60px;height:60px;transition:all .3s ease}.list-gallery button:hover{background:rgba(255,255,255,1);color:#333}.list-gallery:hover .action{visibility:visible;opacity:1}.list-gallery img{width:80%;max-height:210px}.list-gallery a{color:#dd4b39}.list-gallery .action{position:absolute;background:rgba(0,0,0,.3);top:0;bottom:0;right:0;left:0;visibility:hidden;opacity:0;transition:all .2s ease}.list-gallery .action i{font-size:40px}
  </style>
@endsection

@section('content')
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Galeri</h3>
          <a href="#add-category" class="btn btn-primary btn-sm pull-right" data-toggle="modal">Tambah Kategori</a>
        </div>
        <div class="box-body">
          {!! Form::open(array('url'=>route('admin.gallery.store'), 'files'=>true, 'method'=>'post')) !!}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <select name="category" class="form-control">
                    <option value="0">Select Category</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->kategori }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <input type="file" class="form-control" name="img">
                  <span class="input-group-btn">
                    <button class="btn btn-primary btn-flat" type="submit">Upload</button>
                  </span>
                </div><!-- /input-group -->
              </div>
            </div>
          {!! Form::close() !!}
          @if (session()->has('flash_notification.message'))
          <!-- alert start -->
          <div class="alert alert-{{ session()->get('flash_notification.level') }} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Uploaded!</h4>
            {!! session()->get('flash_notification.message') !!}
          </div>
          <!-- alert end -->
          @endif

          @if(count($errors) > 0)
          <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Error</strong>
            <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
            </ul>
          </div>
          @endif
          <div class="gallery">
            <div class="row">
            @foreach($galleryData as $n)
              <div class="col-md-4">
                <div class="list-gallery">
                  <div class="action">
                   {!! Form::open(array('url'=>route('admin.gallery.destroy', $n->id), 'method'=>'delete')) !!}
                    <button><i class="fa fa-trash"></i></button>
                   {!! Form::close() !!}
                  </div>
                  <img src="{{ asset('upload/'.$n->img) }}" alt="">
                </div>
              </div>
            @endforeach
            </div>
          </div>
          {{ $galleryData->render() }}
        </div>
      </div>
      <div class="modal fade" id="add-category">
        <div class="modal-dialog">
          <div class="modal-content">
            {!! Form::open(['url'=> route('admin.gallery.addCategory'), 'method'=>'post']) !!}
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Tambah Kategori</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label class="label-control">Kategori</label>
                {!! Form::text('kategori', null, ['class'=>'form-control']) !!}
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Tambah Kategori</button>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
@stop
