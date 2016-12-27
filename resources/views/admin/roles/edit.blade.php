@extends('admin/app')
<h1>
    @section('contentheader_title')
        Edit Role
        &middot;
    @endsection
    @section('contentheader_description')

        <b>{!! link_to_route('admin::roles::index', 'Back') !!}</b>
    @endsection
</h1>
@section('main-content')
    <div>
        @if(isset($role))
            {!! Form::model($role, ['route' => ['admin::roles::update', $role->id], 'method' => 'PUT', 'files' => true]) !!}
        @else
            {!! Form::open(['files' => true, 'route' => 'admin::roles::store']) !!}
        @endif
        @include('admin.roles.form')
        {!! Form::close() !!}
    </div>
@endsection
