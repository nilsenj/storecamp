@extends('admin/app')

<h1>
    @section('contentheader_title')
        Edit product
        &middot;
    @endsection

    @section('contentheader_description')

        <b>{!! link_to_route('admin::products::index', 'Назад') !!}</b>

    @endsection
</h1>
@section('main-content')

    <div>

        @include('admin.products.form')

    </div>
@endsection
@stop