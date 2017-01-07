@extends('admin/app')

<h1>
    @section('contentheader_title')
        Create new Category
        &middot;
    @endsection

    @section('contentheader_description')

        <b>{!! link_to_route('admin::categories::index', 'Back') !!}</b>

    @endsection
</h1>
@section('main-content')

    <div>
        {!! Form::open(['files' => true, 'route' => 'admin::categories::store']) !!}
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#general" data-toggle="tab">General</a></li>
                <li><a href="#extra" data-toggle="tab">Extra</a></li>
            </ul>
            <div class="tab-content">
                @include('admin.categories.form', [$category=null])
            </div>
            <!-- /.tab-content -->
        </div>
        {!! Form::close() !!}
    </div>
@endsection