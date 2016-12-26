@extends('admin/app')

<h1>
@section('contentheader_title')
        Edit Category        &middot;
    @endsection
    @section('contentheader_description')

    <b>{!! link_to_route('admin::categories::index', 'Back') !!}</b>
@endsection
</h1>

@section('main-content')
     {{--@if(isset($category))--}}

            {{--{!! Form::model($category, ['method' => 'PUT','files' => true, 'action' => ['CategoriesController@update', $category->slug]]) !!}--}}
        {{--@else--}}
            {{--{!! Form::open(['files' => true, 'route' => 'admin::categories::store']) !!}--}}
        {{--@endif--}}

            {!! Form::model($category, ['route' => ['admin::categories::update', $category->id], 'method' => 'PUT', 'class' => '']) !!}
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
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('parent_id', 'Parent', ['class' => 'col-sm-2 control-label']) !!}
                    <select name="parent_id" class="form-control">
                        <option value="" selected disabled style="display:none">choose parent category</option>
                        @foreach ($categories as $category)
                            @foreach ($category->children as $child)
                                <option value="{{ $category->id }}" >{{ $child->name }}</option>
                            @endforeach
                        @endforeach
                    </select>
            </div>
            <div class="form-group">
                {!! Form::label('slug', 'Slug', ['class' => 'col-sm-2 control-label']) !!}
                    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'eg category-name']) !!}
            </div>
           @include('partials.description')
            <div class="form-group">
                    {!! Form::submit('Update', ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
            {!! Form::close() !!}
@endsection
