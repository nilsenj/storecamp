{!! Form::open(['files' => false, 'route' => 'admin::media::rename.directory']) !!}

<div class="form-group">
    {!! Form::label('path', 'Path:') !!}

    <div class="input-group margin">
        <div class="input-group-btn">
            <button type="button" class="btn btn-info disabled">{!! $path ? '../'.implode("/", explode("_",$path)): '../' !!}</button>
        </div>
        <!-- /btn-group -->
        {!! Form::text('new_path', null, ['class' => 'form-control rename-dir']) !!}
        {!! $errors->first('new_path', '<div class="text-danger">:message</div>') !!}
        {!! Form::text('path', $path, ['class' => 'form-control hidden']) !!}
        {!! Form::text('selected_path', null, ['class' => 'selected-dir form-control hidden']) !!}
    </div>
</div>
{!! Form::submit('confirm folder rename', ['class' => "btn btn-default"]) !!}

{!! Form::close() !!}