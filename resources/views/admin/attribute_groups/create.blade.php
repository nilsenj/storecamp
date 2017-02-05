@extends('admin/app')
<h1>
    @section('breadcrumb')
        {{--{!! Breadcrumbs::render('admin') !!}--}}
        {!! Breadcrumbs::render('attribute groups', 'Attribute Groups') !!}
    @endsection
    @section('contentheader_title')
        Create Group Attribute
        @endsection
        @section('contentheader_description')
        &middot;
            @include('admin.partial._content-head_btns', [$routeName = "admin::attribute_groups::index", $createBtn = 'Back', $showFilters = false])
        @endsection
</h1>
@section('main-content')
    <div>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#general" data-toggle="tab">General</a></li>
            </ul>
            <div class="tab-content">
                @include('admin.attribute_groups.form')
            </div>
        </div>
@endsection
