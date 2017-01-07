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
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#general" data-toggle="tab">General</a></li>
                {{--<li><a href="#extra" data-toggle="tab">Extra</a></li>--}}
            </ul>
            <div class="tab-content">
        @include('admin.users.form', array('model' => $user) + compact('role'))
        {{--@include('admin.users.form')--}}
            </div>
            <!-- /.tab-content -->
        </div>
    </div>
@endsection