@extends('admin/app')

<h1>
@section('contentheader_title')
        Изменить Категорию
        &middot;
    @endsection
    @section('contentheader_description')

    <b>{!! link_to_route('admin::categories::index', 'Назад') !!}</b>
@endsection
</h1>

@section('main-content')

    <div>
        {{--@if(isset($category))--}}

            {{--{!! Form::model($category, ['method' => 'PUT','files' => true, 'action' => ['CategoriesController@update', $category->slug]]) !!}--}}
        {{--@else--}}
            {{--{!! Form::open(['files' => true, 'route' => 'admin::categories::store']) !!}--}}
        {{--@endif--}}

            {!! Form::model($category, ['route' => ['admin::categories::update', $category->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert"aria-hidden="true">
                        &times;
                    </button>
                    {{ session('message') }}
                </div>
            @endif
            <div class="form-group">
                {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('parent_id', 'Parent', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    <select name="parent_id" class="form-control">
                        <option value="" selected disabled style="display:none">choose parent category</option>
                        @foreach ($categories as $category)
                            @foreach ($category->children as $child)
                                <option value="{{ $category->id }}" placeholder="choose parent category">{{ $child->name }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('slug', 'Slug', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'eg category-name']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Description', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {!! Form::submit('Update', ['class' => 'btn btn-lg btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}

    </div>
@endsection
