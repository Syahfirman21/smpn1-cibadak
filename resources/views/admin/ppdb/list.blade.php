@extends('admin.themes.theme')

@section('title', 'DATA PPDB SMPN 1 Cibadak')

@section('script-header')
  @parent
  <link href="{{ asset('resource/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet">
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <style>
    .column-hide { display: none; }
    .sorting_1 {
      width: 20px;
    }
    .dt-buttons, .dataTables_length, .dataTables_filter{
      width: 50%;
      float: left;
    }
    .dt-buttons {
      display: none;
    }
    .export_dt {
      margin-left: 10px;
    }
    /*toggle button */
    .toggle.btn {
        float:left;
        margin-right:10px;
        width: 38px !important;
        min-width: 38px !important;
        min-height: 30px !important;
        height: 30px !important;
    }

    .toggle-on.btn,
    .toggle-off.btn {
        padding: 4px !important;
    }

    .toggle-handle{
        display:none;
    }

    .dt-action {
        min-width:120px;
    }
  </style>
  <!-- <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet"> -->
@endsection

@section('breadcrumbs')
    <h1>
        PPDB
        <small>lihat list Peserta yang telah terdaftar jalur</small>
        {{ request()->segment(3) == "reguler" ? "Reguler" : "Khusus/Prestasi" }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Peserta PPDB</li>
      </ol>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List data Peserta PPDB</h3>
          <a href="javascript:void(0)" class="export_dt btn-sm pull-right btn btn-primary"><i class="fa fa-file-excel-o fa-fw"></i> Export Data</a>
          <a href="{{ route('admin.ppdb.import') }}" class="btn-sm pull-right btn btn-success"><i class="fa fa-file-excel-o fa-fw"></i> Import Data</a>
        </div>
        <div class="box-body">
          @if (session()->has('flash_notification.message'))
          <div class="alert alert-{{ session()->get('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session()->get('flash_notification.message') !!}
          </div>
          @endif
          {{ csrf_field() }}
          {!! $html->table(['class'=>'table table-bordered table-hover dataTable']) !!}
      </div>
      </div>
@endsection

@section('script-footer')
@parent
<script src="{{ asset('resource/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('resource/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
(function($) {
  $('#dataTableBuilder').on("change",".update-status-ajax",function () {
      let url = $(this).attr("data-url");
      let status = $(this).is(":checked") ? "1" : "2";
      statusMessage = $(this).parent().parent().parent().find("td.dt-row-status");
      statusMessage.html(status=="1" ? "Diterima" : "Tidak Diterima");
      $.ajax({
          type: 'post',
          url: url,
          data: {
              '_token': $('input[name=_token]').val(),
              'status': status
          },
          success: function (resp) {
              console.log("berhasil dikonfirmasi");
          },
          fail: function () {
              console.log("Kesalahan Teknis");
          }
      });
  });
  $(document).on("click",".export_dt", function() {
    $('button.buttons-excel').trigger('click');
  });
})(jQuery);
</script>
{!! $html->scripts() !!}
@stop