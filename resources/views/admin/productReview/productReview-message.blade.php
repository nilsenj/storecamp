 <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">
                <strong>
                    <span class="text-muted">user - </span>
                    <a href="{!! route("admin::users::show", $productReview->user->id) !!}">
                        {{$productReview->user->name}}
                    </a>
                </strong>
                <span class="text-info">|</span>
                <strong>
                    <span class="text-muted">product - </span>
                    <a href="{!! route("admin::products::show", $productReview->product->id) !!}">
                        {{str_limit($productReview->product->title, 25)}}
                    </a>
                </strong>
                <span class="text-info">|</span>
                @if($productReview->thread->first()->isUnread($currentUserId))
                    <span class="review-item-status label label-warning">not read</span>
                @else
                    <span class="review-item-status label label-default">read</span>
                @endif
                @if($productReview->hidden)
                    <span class="review-item-status label label-info"> hidden </span>
                @else
                    <span class="review-item-status label label-info"> visible</span>
                @endif

            </h3>

            <div class="box-tools pull-right">
                <a class="btn btn-warning btn-xs text-warning"
                   href="{!! route('admin::reviews::visibility', $productReview->id) !!}"
                   title="Toggle Visibility">
                    @if($productReview->hidden)
                        make visible
                    @else
                        make hidden
                    @endif
                </a>
                <a class="btn btn-danger btn-xs text-danger"
                   href="{!! route('admin::reviews::get.delete', $productReview->id) !!}"
                   title="Are you sure you want to delete?">
                    delete
                </a>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: block;">
            <div class="media">
                <div class="media-left">
                    {{--<a href="{!! route('admin::users::show', $message->user->id) !!}"--}}
                    {{--class="kit-avatar kit-avatar-42 no-border">--}}
                    {{--<img class="media-object" src="#" alt="{!! $message->user->name !!}">--}}
                    {{--</a>--}}

                </div>
                <div class="media-body">

                    <h2 class="text-info"> Product Review and Replies</h2>
                    <strong>
                        <span class="text-muted">author - </span>
                        <a href="{!! route("admin::users::show", $productReview->user->id) !!}">
                            {{$productReview->user->name}}
                        </a>
                    </strong>
                    <span class="text-info">|</span>
                    <strong>
                        <span class="text-muted">product - </span>
                        <a href="{!! route("admin::products::show", $productReview->product->id) !!}">
                            {{str_limit($productReview->product->title, 25)}}
                        </a>
                    </strong>
                    <h4>{{ $productReview->review }}</h4>
                    <div class="text-muted">
                        <small>Posted {!! $productReview->created_at->diffForHumans() !!}</small>
                    </div>
                    <h3 class="text-muted"><b>Product review point</b></h3>
                    <div class="col-md-6">
                        <input id="input-id" name="input-name" type="number" class="rating"
                               value="{{$productReview->rating}}" disabled="disabled" min=1 max=5 step=1 data-size="xs"
                               data-rtl="false">
                    </div>

                </div>

            </div>
            <hr>
            <div class="box-footer box-comments" style="display: block;">
                <b class="text-muted">comments:</b>
                @foreach($productReview->thread->first()->messages as $message)
                    <div class="box-comment">
                        <div class="media-left">
                            {{--<a href="{!! route('admin::users::show', $message->user->id) !!}"--}}
                            {{--class="kit-avatar kit-avatar-42 no-border">--}}
                            {{--<img class="media-object" src="#" alt="{!! $message->user->name !!}">--}}
                            {{--</a>--}}
                        </div>
                        <div class="comment-text">
                         <span class="username">
                             <a href="{!! route("admin::users::show", $message->user->id) !!}">
                            {{$message->user->name}}
                             </a>
                        <span class="text-muted pull-right">Posted {!! $message->created_at->diffForHumans() !!}</span>
                      </span>
                            <p class="comment-text">{!! $message->body !!}</p>
                            <div class="text-muted">
                                <small>Posted {!! $message->created_at->diffForHumans() !!}</small>
                                <small> | Regards, <b>{{$message->user->name}}</b></small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="clearfix"></div>
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
        </div>
        <!-- /.box-body -->
    </div>
@push("scripts-add_on")
<script>
    $("#input-id").rating({min: 1, max: 5, step: 1, size: 'xs'});
</script>
@endpush