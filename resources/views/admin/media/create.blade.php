@extends('admin/app')
<h1>
    @section('breadcrumb')
        {{--{!! Breadcrumbs::render('admin') !!}--}}
        {!! Breadcrumbs::render('media', 'Media') !!}
    @endsection
    @section('contentheader_title')
       Upload Media File
    @endsection
    @section('contentheader_description')
    &middot;
            <b>{!! link_to_route('admin::media::index', 'Back') !!}</b>
    @endsection
</h1>
@section('main-content')
    <div>
        @include('admin.media.upload-form')
    </div>
@endsection
