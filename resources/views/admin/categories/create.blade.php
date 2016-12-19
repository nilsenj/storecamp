@extends('admin/app')

<h1>
@section('contentheader_title')
        Create new Category
        &middot;
    @endsection

    @section('contentheader_description')

        <b>{!! link_to_route('admin::categories::index', 'Back') !!}</b>

    @endsection
</h1>
@section('main-content')

    <div>
        @if(isset($category))
            {!! Form::model($category, ['method' => 'PUT', 'files' => true, 'route' => ['admin::categories::update', $category->id]]) !!}
        @else
            {!! Form::open(['files' => true, 'route' => 'admin::categories::store']) !!}
        @endif
        @include('admin.categories.form')
            {!! Form::close() !!}
    </div>
@endsection