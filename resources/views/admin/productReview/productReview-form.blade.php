<div class="col-md-4">
    <div class="form-group">
        {!! Form::input('product_id', null, ["class" => "hidden", "id"=>"inputProduct", 'placeholder' => 'Select a product...']) !!}
    </div>
</div>

<div class="col-lg-12">
    <div class="form-group">
        <label for="inputTextarea">Product Review</label>
        {{Form::textarea('message', null, ['id' =>'inputTextarea', 'rows' => '4', 'class'=> 'form-control', 'placeholder'=>'Product Review'])}}
    </div>
    <!-- /form-group -->
    <div class="clearfix"></div>

    {!! $errors->first('message', '<div class="text-danger">:message</div>') !!}
    <div class="form-group">
        <button type="submit" class="btn btn-default">Submit Review</button>
    </div>
    <!-- /form-group -->
</div>
@section('scripts-add')

@endsection