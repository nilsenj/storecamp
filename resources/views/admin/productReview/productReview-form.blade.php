<div class="col-md-4">
    <div class="form-group">
        <label for="inputReason">Reason</label>
        {!! Form::select('reason', ['reasons' => config('reasons')], null, ["class" => "form-control", "id"=>"inputReason", 'placeholder' => 'Pick a reason...']) !!}
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="inputProduct">Product</label>
        {!! Form::select('product', $lists, null, ["class" => "form-control", "id"=>"inputProduct", 'placeholder' => 'Select a product...']) !!}
    </div>
</div>

<div class="col-lg-12">
    <div class="form-group">
        <label for="inputTextarea">Product Message</label>
        {{Form::textarea('message', null, ['id' =>'inputTextarea', 'rows' => '4', 'class'=> 'form-control', 'placeholder'=>'productReview'])}}
    </div>
    <!-- /form-group -->
    <div class="clearfix"></div>

    {!! $errors->first('message', '<div class="text-danger">:message</div>') !!}
    <div class="form-group">
        <button type="submit" class="btn btn-default">Submit Feedback</button>
    </div>
    <!-- /form-group -->
</div>
@section('scripts-add')

@endsection