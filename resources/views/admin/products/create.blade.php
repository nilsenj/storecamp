@extends('admin/app')
<h1>
    @section('contentheader_title')
        Add New Product
        &middot;
    @endsection
    @section('contentheader_description')
        <b>{!! link_to_route('admin::products::index', 'Back') !!}</b>
    @endsection
</h1>
@section('main-content')
    <div>
        @include('admin.products.form', [$categories, $chosenCategory])
    </div>
@endsection