@if( isset( $update_status) && isset($status) ) 
    <input type="checkbox" name="status" class="update-status-ajax" {{ $status==1 ? 'checked' : '' }} value="1" data-toggle="toggle" data-off="<i class='fa fa-check'></i>" data-width="40" data-on="<i class='fa fa-times'></i>" data-offstyle="success" data-onstyle="danger" data-url="{{$update_status}}">
@endif

@if( isset($hapus))
    {!! Form::open(array('method'=>'delete', 'url'=>$hapus)) !!}
    {!! Form::hidden('_delete', 'DELETE') !!}
    {!! Form::submit('Hapus', ['class'=>'btn btn-sm btn-danger','onclick'=>'return confirm(\'Apakah anda yakin akan menghapus data ini? Data yang sudah dihapus tidak dapat dikembalikan\');']) !!}
    @if( isset($view_data) && request()->segment(3) == "reguler")
        <a href="{{ $view_data }}" class="pull-right btn btn-sm btn-primary" target="_blank"><i class='fa fa-eye'></i></a>
    @endif
    {!! Form::close()!!}
@endif