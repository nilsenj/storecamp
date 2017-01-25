{!! Form::open(['route' => ['admin::reviews::reply', $productReview->id], 'method' => 'PUT', "role" => "form", ]) !!}
<h2>Reply review</h2>
<!-- Message Form Input -->
<div class="form-group">
    {!! Form::textarea('reply_message', null, [
    'class' => 'form-control autogrow', "rows" => "3","placeholder"=>"Reply form here.."]) !!}
</div>
<div class="form-group text-right">
    <button class="btn btn-primary">Reply</button>
</div>
{!! Form::close() !!}