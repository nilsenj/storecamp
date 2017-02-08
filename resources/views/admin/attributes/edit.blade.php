@extends('admin/app')
<h1>
    @section('breadcrumb')
        {{--{{ Breadcrumbs::render('admin') }}--}}
        {!! Breadcrumbs::render('attributes', 'Attributes') !!}
    @endsection
    @section('contentheader_title')
        Edit Attribute
    @endsection
    @section('contentheader_description')
        @include('admin.partial._content-head_btns', [$routeName = "admin::attributes::index", $createBtn = 'Back', $showFilters = false])
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
                @include('admin.attributes.form', array('model' => $groupDescription))
        {{--@include('admin.users.form')--}}
            </div>
            <!-- /.tab-content -->
        </div>
    </div>
@endsection