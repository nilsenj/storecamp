@extends('admin/app')
<h1>
    @section('contentheader_title')
        Add New Role
    @endsection
    @section('contentheader_description')
            @include('admin.partial._content-head_btns', [$routeName = "admin::roles::index", $createBtn = 'Back', $showFilters = false])
    @endsection
</h1>
@section('main-content')
    <div>
        @include('admin.roles.form')
    </div>
@endsection
