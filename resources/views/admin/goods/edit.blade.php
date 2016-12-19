@extends('admin/app')

<h1>
    @section('contentheader_title')
        Edit good
        &middot;
    @endsection

    @section('contentheader_description')

        <b>{!! link_to_route('admin::goods::index', 'Назад') !!}</b>

    @endsection
</h1>
@section('main-content')

    <div>

        @include('admin.goods.form')

    </div>
@endsection
@stop