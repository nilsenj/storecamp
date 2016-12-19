<div class="form-group">
    {!! Form::label('name', 'Name of Privilege:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('display_name', 'Alias of Privilege:') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('display_name', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::submit(isset($model) ? 'Renew' : 'Save', ['class' => 'btn btn-primary']) !!}
</div>