{!! Form::open(['files' => false, 'route' => 'admin::media::rename.directory']) !!}

<div class="form-group">
    {!! Form::label('path', 'Path:') !!}

    <div class="input-group margin">
        <div class="input-group-btn">
            <button type="button" class="btn btn-info disabled">{!! $path ? $path : "../" !!}</button>
        </div>
        <!-- /btn-group -->
        {!! Form::text('new_name', null, ['class' => 'form-control new_name']) !!}
        {!! $errors->first('new_name', '<div class="text-danger">:message</div>') !!}
        {!! Form::text('folder', null, ['class' => 'form-control rename-id hidden']) !!}
    </div>
</div>
{!! Form::submit('confirm folder rename', ['class' => "btn btn-default"]) !!}

{!! Form::close() !!}