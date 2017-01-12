<div class="tab-pane active" id="general">

    <div class="form-group">
        {!! Form::label('name', 'Name of role:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
    </div>

    <div class="form-group">
        {!! Form::label('display_name', 'Alias of role:') !!}
        {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('display_name', '<div class="text-danger">:message</div>') !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Description:') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<div class="text-danger">:message</div>') !!}
    </div>
    {!! buildSelect(route('admin::roles::permissions::json'), 'permissions[]', true, $permissions, $selectedPerms, "selector", "please choose your role") !!}


    <div class="form-group">
        {!! Form::submit(isset($model) ? 'Renew' : 'Update', ['class' => 'btn btn-primary']) !!}
    </div>
</div>