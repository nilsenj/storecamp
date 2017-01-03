{!! Form::open(['files' => true, 'route' => 'admin::media::upload',  'id' => 'my-awesome-dropzone', 'class' => 'dropzone']) !!}
<input type="hidden" name="path" value="{{$path}}">
{!! Form::close() !!}