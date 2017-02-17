@extends("admin/app")
@section('breadcrumb')
    {!! Breadcrumbs::render('admin') !!}
@endsection

@section("main-content")

@include("admin.partial._dash")

@endsection
@section("scripts-add")
@endsection