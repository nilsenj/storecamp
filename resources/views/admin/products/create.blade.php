@extends('admin/app')
<h1>
    @section('contentheader_title')
        Add New Product
    @endsection
    @section('contentheader_description')
        @include('admin.partial._content-head_btns', [$routeName = "admin::products::index", $createBtn = 'Back', $showFilters = false])
    @endsection
</h1>
@section('main-content')
    <div>
        @include('admin.products.form', [$categories, $chosenCategory])
    </div>
@endsection