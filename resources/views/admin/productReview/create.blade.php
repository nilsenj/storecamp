@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row" style="">
            <div class="panel-body">
                {!! Form::model( $ReviewInstance = new \App\Core\Models\ProductReview(), ['url' =>'productReview', 'class' => 'form-bordered', 'role'=>'form', 'id' => 'productReview', 'files' => true ] ) !!}
                @include('productReview.', ['submitButton' => trans('forms.create'), $feedback=null])
                <div class="clearfix"></div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
