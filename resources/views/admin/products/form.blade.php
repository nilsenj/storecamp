<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#general" data-toggle="tab">General</a></li>
        <li><a href="#extra" data-toggle="tab">Extra</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="general">

            @if(isset($product))
                {!! Form::model($product, ['method' => 'PATCH', 'files' => true, 'route' => ['admin::products::update', $product->id]]) !!}
            @else
                {!! Form::open(['files' => true, 'route' => 'admin::products::store']) !!}
            @endif
            <div class="form-group">
                {!! Form::label('title', 'Title:') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                {!! $errors->first('title', '<div class="text-danger">:message</div>') !!}
            </div>
            <div class="clearfix"></div>
            {{--<div class="form-group">--}}
                {{--{!! Form::label('category_id', 'Category:') !!}--}}
                {{--{!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}--}}
                {{--{!! $errors->first('category_id', '<div class="text-danger">:message</div>') !!}--}}
            {{--</div>--}}
            @include('admin.products.category_chooser_modal', [$categories, $chosenCategory])

            @include('admin.components.description-form', [$property_name='body'])
            <div class="form-group">
                {!! Form::label('price', 'Price:') !!}
                {!! Form::text('price', null, ['class' => 'form-control']) !!}
                {!! $errors->first('price', '<div class="text-danger">:message</div>') !!}
            </div>

            <div class="form-group">
                {!! Form::label('availability', 'Available:') !!}
                {!! Form::select('availability', [ 1 => 'yes', 0 => "no"], null, ['class' => 'form-control']) !!}
                {!! $errors->first('availability', '<div class="text-danger">:message</div>') !!}
            </div>

            <div class="form-group">
                {!! Form::submit(isset($product) ? 'Edit' : 'Save', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="tab-pane active" id="extra">

        </div>
        <!-- /.tab-content -->
    </div>
</div>
@section('scripts-add')
@endsection