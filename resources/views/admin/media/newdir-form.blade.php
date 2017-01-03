{!! Form::open(['files' => false, 'route' => 'admin::media::make.directory']) !!}

<div class="form-group">
    {!! Form::label('path', 'Path:') !!}
    {!! Form::text('new_path', null, ['class' => 'form-control']) !!}
    {!! $errors->first('new_path', '<div class="text-danger">:message</div>') !!}
    {!! Form::text('path', $path, ['class' => 'form-control hidden']) !!}
</div>
{!! Form::submit('confirm folder creation', ['class' => "btn btn-default"]) !!}

{!! Form::close() !!}