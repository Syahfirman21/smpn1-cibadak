{!! Form::open(array('method'=>'delete', 'url'=>$hapus)) !!}
{!! Form::hidden('_delete', 'DELETE') !!}
<a href="{{ $edit }}" class="btn btn-primary btn-xs">Edit</a>
{!! Form::submit('Hapus', ['class'=>'btn btn-xs btn-danger']) !!}
{!! Form::close()!!}