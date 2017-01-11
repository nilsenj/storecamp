@extends('admin/app')
<h1>
    @section('breadcrumb')
        {{--{!! Breadcrumbs::render('admin') !!}--}}
        {!! Breadcrumbs::render('products', 'Products') !!}
    @endsection
    @section('contentheader_title')
        All products ({!! \App\Core\Models\Product::all()->count() !!})
        &middot;
    @endsection
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
                        <form action="#" method="get" class="input-group" style="width: 150px;">
                            <input type="text" name="q" class="form-control input-sm pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </form>

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
                                    {{ $product->getFirstCategory() ? $product->getFirstCategory()->name : "no category  provided"}}
                                </td>
                                <td>{!! $product->price ? $product->price : null !!}</td>
                                <td><div class="label bg-blue">{!! $product->quantity !!}</div></td>
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
                                <td>{!! $product->created_at !!}</td>
                                <td class="text-center">
                                    <a href="{!! route('admin::products::edit', $product->id) !!}">Edit</a>
                                    &middot;
                                    {{--@include('admin::partials.modal', ['data' => $product, 'name' => 'products'])--}}

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
        {{--{!! pagination_links($categories) !!}--}}
    </div>

@endsection