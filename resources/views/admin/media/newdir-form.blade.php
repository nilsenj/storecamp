{!! Form::open(['files' => false, 'route' => 'admin::media::make.directory']) !!}

<div class="form-group">
    {!! Form::label('path', 'Path:') !!}

    <div class="input-group margin">
        <div class="input-group-btn">
            <button type="button" class="btn btn-info disabled">{!! $path ? '../'.$path : '../' !!}</button>
        </div>
        <!-- /btn-group -->
        {!! Form::text('new_path', null, ['class' => 'form-control']) !!}
        {!! $errors->first('new_path', '<div class="text-danger">:message</div>') !!}
        {!! Form::text('path', $path, ['class' => 'form-control hidden']) !!}    </div>
</div>
{!! Form::submit('confirm folder creation', ['class' => "btn btn-default"]) !!}

{!! Form::close() !!}