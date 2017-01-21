@extends('admin/app')
<h1>
    @section('breadcrumb')
        {!! Breadcrumbs::render('products', 'Products') !!}
    @endsection
    @include('admin.partial._contentheader_title', [$model = $products, $message = "All Products"])
    @section('contentheader_description')
        <b>{!! link_to_route('admin::products::create', 'Add new product') !!}</b>
    @endsection
</h1>
@section('main-content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List of products</h3>
                    <div class="box-tools">
                        @include('admin.partial._box_search')
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <th>No</th>
                        <th>Product Title</th>
                        <th>Model</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Availability</th>
                        <th>Stock Status</th>
                        <th>Db Activity</th>
                        <th>Created At</th>
                        <th class="text-center">Actions</th>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{!! $no !!}</td>
                                <td>{!! $product->title !!}</td>
                                <td>{!! $product->model !!}</td>
                                <td>
                                    {{ $product->categories ? $product->categories->first()->name : "no category  provided"}}
                                </td>
                                <td>{!! $product->price ? $product->price : null !!}</td>
                                <td>
                                    <div class="label bg-blue">{!! $product->quantity !!}</div>
                                </td>
                                @if($product->availability)
                                    <td>
                                        <div class="label bg-green">enabled</div>
                                    </td>
                                @else
                                    <td>
                                        <div class="label bg-warning">disabled</div>
                                    </td>
                                @endif
                                <td>{!! $product->stock_status !!}</td>
                                <td>
                                    <a data-toggle="modal" href="#activity-modal"
                                       class="btn btn-xs btn-info"
                                       data-desc-url="{{route('admin::audits::show', ["product", $product->id])}}"
                                       data-desc-id="{{ $product->id }}"
                                       data-desc-name="{{ $product->title }}">
                                        show db activity
                                    </a>
                                </td>
                                <td>{!! $product->created_at !!}</td>
                                <td class="text-center">
                                    <a class="edit" href="{!! route('admin::products::edit', $product->unique_id) !!}"
                                       title="Edit">
                                        <i class="fa fa-pencil-square-o"></i></a>
                                    <a class="delete text-warning"
                                       href="{!! route('admin::products::get::delete', $product->unique_id) !!}"
                                       title="Are you sure you want to delete?"><i class="fa fa-trash-o"></i></a>

                                </td>
                            </tr>
                            <?php $no++;?>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <div class="text-center">
        {!! $products->links() !!}
    </div>
@endsection
@include('admin.components.modal-description', [$attrName = "activity" ])
