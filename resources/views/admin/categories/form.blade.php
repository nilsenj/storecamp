<div class="tab-pane active" id="general">
    <div class="form-group">
        {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
    </div>
    @include('admin.components.modal-category_chooser', [$category, $parent])
    @include('admin.components.description-form', [$property_name='description'])
    <div class="form-group">
        {!! Form::label('meta_tag_title', 'Meta Tag Title', ['class' => 'control-label']) !!}
        {!! Form::text('meta_tag_title', null, ['class' => 'form-control']) !!}
        {!! $errors->first('meta_tag_title', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group">
        {!! Form::label('meta_tag_description', 'Meta Tag Description', ['class' => 'control-label']) !!}
        {!! Form::textarea('meta_tag_description', null, ['class' => 'form-control']) !!}
        {!! $errors->first('meta_tag_description', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group">
        {!! Form::label('meta_tag_keywords', 'Meta Tag Keywords', ['class' => 'control-label']) !!}
        {!! Form::text('meta_tag_keywords', null, ['class' => 'form-control']) !!}
        {!! $errors->first('meta_tag_keywords', '<div class="text-danger">:message</div>') !!}
    </div>
</div>
<!-- /.tab-pane -->
<div class="tab-pane" id="extra">
    <div class="form-group">
        {!! Form::label('image_link', 'Category Image', ['class' => 'control-label']) !!}
        {!! Form::text('image_link', null, ['class' => 'form-control category-image hidden']) !!}
        <img src="{{asset('img/image-not-found.gif')}}" alt="" class="img-responsive" width="150" height="100">
        {!! $errors->first('image_link', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group">
        {!! Form::label('top', 'Place to top navigation', ['class' => 'control-label']) !!}
        <label>
            {!! Form::checkbox('top', null, null, ['class' => 'minimal']) !!}
            {!! $errors->first('top', '<div class="text-danger">:message</div>') !!}
        </label>
    </div>
    <div class="form-group">
        {!! Form::label('sort_order', 'Sorting Order', ['class' => 'control-label']) !!}
        {!! Form::input('number', 'sort_order', null, ['class' => 'form-control']) !!}
        {!! $errors->first('sort_order', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group">
        {!! Form::label('status', 'Active Status(Visible on page)', ['class' => 'control-label']) !!}
        {!! Form::select('status', [1 => "Enabled", 0 => "Disabled"], null, ['class' => 'form-control']) !!}
        {!! $errors->first('status', '<div class="text-danger">:message</div>') !!}
    </div>

</div>
<div class="form-group">
    {!! Form::submit(isset($category) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
</div>