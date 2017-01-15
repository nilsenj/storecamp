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
        @include('admin.roles.form')
    </div>
@endsection
