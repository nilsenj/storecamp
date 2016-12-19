@extends('admin/app')
<h1>
    @section('breadcrumb')
        {{--{!! Breadcrumbs::render('admin') !!}--}}
        {!! Breadcrumbs::render('users', 'Users') !!}
    @endsection
    @section('contentheader_title')
        Edit User
    @endsection
    @section('contentheader_description')
        &middot;
        <b>{!! link_to_route('admin::users::index', 'Back') !!}</b>
    @endsection
</h1>
@section('main-content')
    <div>
        @include('admin.users.form', array('model' => $user) + compact('role'))
        {{--@include('admin.users.form')--}}
    </div>
@endsection