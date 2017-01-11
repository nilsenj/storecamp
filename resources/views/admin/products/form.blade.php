<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#general" data-toggle="tab">General</a></li>
        <li><a href="#extra" data-toggle="tab">Extra</a></li>
        <li><a href="#image" data-toggle="tab">Image</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="general">

            @if(isset($product))
                {!! Form::model($product, ['method' => 'PUT', 'files' => false, 'route' => ['admin::products::update', $product->id]]) !!}
            @else
                {!! Form::model(new \App\Core\Models\Product(), ['files' => false, 'route' => 'admin::products::store']) !!}
            @endif
            <div class="form-group">
                {!! Form::label('title', 'Title:') !!}
                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                {!! $errors->first('title', '<div class="text-danger">:message</div>') !!}
            </div>
            <div class="form-group">
                <label class="control-label" for="input-price">Price</label>
                {!! Form::text('price', null, ["id" => "input-price", "placeholder" => "Price", "class" => "form-control"]) !!}
                {!! $errors->first('price', '<div class="text-danger">:message</div>') !!}

            </div>
            <div class="clearfix"></div>
            @include('admin.products.category_chooser_modal', [$categories, $chosenCategory])
            @include('admin.components.description-form', [$property_name='body'])
            <div class="form-group">
                <label class="control-label" for="input-status">Availability</label>
                {!! Form::select('availability', [1 => "Enabled", 0 => "Disabled"], null, ["id" => "input-availability", 'class' => 'form-control']) !!}
                {!! $errors->first('availability', '<div class="text-danger">:message</div>') !!}
            </div>

        </div>
        <div class="tab-pane" id="extra">
            <div class="form-group required">
                <label class="control-label" for="input-model">Model</label>
                {!! Form::text('model', null, ["id" => "input-model", "placeholder" => "Model", "class" => "form-control"]) !!}
                {!! $errors->first('model', '<div class="text-danger">:message</div>') !!}

            </div>
            <div class="form-group">
                <label class="control-label" for="input-sku"><span data-toggle="tooltip" title=""
                                                                   data-original-title="Stock Keeping Unit">SKU</span></label>
                {!! Form::text('sku', null, ["id" => "input-sku", "placeholder" => "SKU", "class" => "form-control"]) !!}
                {!! $errors->first('sku', '<div class="text-danger">:message</div>') !!}

            </div>
            <div class="form-group">
                <label class="control-label" for="input-upc"><span data-toggle="tooltip" title=""
                                                                   data-original-title="Universal Product Code">UPC</span></label>
                {!! Form::text('upc', null, ["id" => "input-upc", "placeholder" => "UPC", "class" => "form-control"]) !!}
                {!! $errors->first('upc', '<div class="text-danger">:message</div>') !!}

            </div>
            <div class="form-group">
                <label class="control-label" for="input-ean"><span data-toggle="tooltip" title=""
                                                                   data-original-title="European Article Number">EAN</span></label>
                {!! Form::text('ean', null, ["id" => "input-ean", "placeholder" => "EAN", "class" => "form-control"]) !!}
                {!! $errors->first('ean', '<div class="text-danger">:message</div>') !!}

            </div>
            <div class="form-group">
                <label class="control-label" for="input-jan"><span data-toggle="tooltip" title=""
                                                                   data-original-title="Japanese Article Number">JAN</span></label>
                {!! Form::text('jan', null, ["id" => "input-jan", "placeholder" => "JAN", "class" => "form-control"]) !!}
                {!! $errors->first('jan', '<div class="text-danger">:message</div>') !!}

            </div>
            <div class="form-group">
                <label class="control-label" for="input-isbn"><span data-toggle="tooltip" title=""
                                                                    data-original-title="International Standard Book Number">ISBN</span></label>
                {!! Form::text('isbn', null, ["id" => "input-isbn", "placeholder" => "ISBN", "class" => "form-control"]) !!}
                {!! $errors->first('isbn', '<div class="text-danger">:message</div>') !!}

            </div>
            <div class="form-group">
                <label class="control-label" for="input-mpn"><span data-toggle="tooltip" title=""
                                                                   data-original-title="Manufacturer Part Number">MPN</span></label>
                {!! Form::text('mpn', null, ["id" => "input-mpn", "placeholder" => "MPN", "class" => "form-control"]) !!}
                {!! $errors->first('mpn', '<div class="text-danger">:message</div>') !!}

            </div>

            <div class="form-group">
                <label class="control-label" for="input-quantity">Quantity</label>
                {!! Form::text('quantity', isset($product) ? $product->quantity ? $product->quantity : 990 : 990, ["id" => "input-quantity", "placeholder" => "Quantity", "class" => "form-control"]) !!}
                {!! $errors->first('quantity', '<div class="text-danger">:message</div>') !!}

            </div>

            <div class="form-group">
                <label class="control-label" for="input-stock-status"><span data-toggle="tooltip" title=""
                                                                            data-original-title="Status shown when a product is out of stock">Out Of Stock Status</span></label>
                {!! Form::select('stock_status', config('stock-statuses'), null, ["id" => "input-stock-status", "class" => "form-control"]) !!}
                {!! $errors->first('quantity', '<div class="text-danger">:message</div>') !!}
            </div>

            <div class="form-group">
                <label class="control-label" for="input-date-available">Date Available</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    {!! Form::text('date_available', null, ["id" => "input-date_available", "placeholder" => "Date Available", "data-date-format" => "yyyy-mm-dd", "class" => "form-control simple_date"]) !!}
                    {!! $errors->first('date_available', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="input-length">Dimensions (L x W x H) <b>cm</b></label>
                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::text('length', null, ["id" => "input-length", "placeholder" => "Length", "class" => "form-control"]) !!}
                        {!! $errors->first('length', '<div class="text-danger">:message</div>') !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::text('width', null, ["id" => "input-width", "placeholder" => "Width", "class" => "form-control"]) !!}
                        {!! $errors->first('width', '<div class="text-danger">:message</div>') !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::text('height', null, ["id" => "input-height", "placeholder" => "Height", "class" => "form-control"]) !!}
                        {!! $errors->first('height', '<div class="text-danger">:message</div>') !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="input-weight">Weight <b>(Kg)</b></label>
                {!! Form::text('weight', null, ["id" => "input-weight", "placeholder" => "Weight", "class" => "form-control"]) !!}
                {!! $errors->first('weight', '<div class="text-danger">:message</div>') !!}
            </div>
            <div class="form-group">
                <label class="control-label" for="input-sort-order">Sort Order</label>
                {!! Form::text('sort_order', null, ["id" => "input-sort_order", "placeholder" => "Sort Order", "class" => "form-control"]) !!}
                {!! $errors->first('sort_order', '<div class="text-danger">:message</div>') !!}
            </div>
        </div>
        <!-- /.tab-content -->
        <div class="tab-pane" id="image">

        </div>
        <div class="form-group">
            {!! Form::submit(isset($product) ? 'Edit' : 'Save', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@section('scripts-add')
@endsection