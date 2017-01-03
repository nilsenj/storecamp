@extends('admin/app')
<h1>
    @section('breadcrumb')
        {{--{!! Breadcrumbs::render('admin') !!}--}}
        {!! Breadcrumbs::render('media', 'Media') !!}
    @endsection
    @section('contentheader_title')
        Edit Media
    @endsection
    @section('contentheader_description')
        &middot;
        <b>{!! link_to_route('admin::media::index', 'Back') !!}</b>
    @endsection
</h1>
@section('main-content')
    <div>
        @include('admin.media.upload-form')
        {{--@include('admin.users.form')--}}
    </div>
@endsection