{!! Form::open(['files' => true, 'route' => 'admin::media::upload',  'id' => 'my-awesome-dropzone', 'class' => 'dropzone']) !!}
<input type="hidden" name="folder" value="{{$folder->id}}">
{!! Form::close() !!}