@extends('admin/app')

<h1>
    @section('contentheader_title')
        Add New Role
        &middot;
    @endsection

    @section('contentheader_description')

        <b>{!! link_to_route('admin::roles::index', 'Back') !!}</b>

    @endsection
</h1>
@section('main-content')

    <div>
        @if(isset($model))

            {!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin::roles::update', $model->slug]]) !!}
        @else
            {!! Form::open(['files' => true, 'route' => 'admin::roles::store']) !!}
        @endif
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#general" data-toggle="tab">General</a></li>
                {{--<li><a href="#extra" data-toggle="tab">Extra</a></li>--}}
            </ul>
            <div class="tab-content">
                @include('admin.roles.form')
            </div>
            {!! Form::close() !!}
        </div>
@endsection
