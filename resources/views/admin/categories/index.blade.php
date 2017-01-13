@extends('admin/app')
<h1>
    @section('breadcrumb')
        {!! Breadcrumbs::render('categories', 'Categories') !!}
    @endsection
    @include('admin.partial._contentheader_title', [$model = $categories, $message = "All Categories"])
    @section('contentheader_description')
        <b>{!! link_to_route('admin::categories::create', 'Add New Category') !!}</b>
    @endsection
</h1>
@section('main-content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List of categories</h3>
                    <div class="box-tools">
                        @include('admin.partial._box_search')
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Sort Order</th>
                        <th>Created</th>
                        <th class="text-center">Actions</th>
                        </thead>
                        <tbody>

                        @foreach ($categories as $category)
                            <?php $no++; ?>
                            @include('admin.categories.category', [$category, $no])
                        @endforeach
                        </tbody>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <div class="text-center">
        {!! $categories->links() !!}
    </div>
@endsection

@include('admin.components.modal-description')
@section('scripts-add')

@endsection