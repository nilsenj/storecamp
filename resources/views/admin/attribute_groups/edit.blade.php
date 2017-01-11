@extends('admin/app')
<h1>
    @section('breadcrumb')
        {{--{!! Breadcrumbs::render('admin') !!}--}}
        {!! Breadcrumbs::render('attribute groups', 'Attribute Groups') !!}
    @endsection
    @section('contentheader_title')
        Edit Group Attribute
    @endsection
    @section('contentheader_description')
        &middot;
            <b>{!! link_to_route('admin::attribute_groups::index', 'Back') !!}</b>
    @endsection
</h1>
@section('main-content')
    <div>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#general" data-toggle="tab">General</a></li>
            </ul>
            <div class="tab-content">
        @include('admin.attribute_groups.form', array('model' => $groupAttribute))
            </div>
            <!-- /.tab-content -->
        </div>
    </div>
@endsection