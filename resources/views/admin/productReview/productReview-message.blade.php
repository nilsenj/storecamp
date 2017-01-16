<div class="panel-heading">
    <!-- show on expand -->
    <div class="panel-control mt-2x pull-right show-on-expand">
        <div class="dropdown">
            <a href="#" class="btn btn-icon btn-default btn-xs dropdow-toggle"
               data-toggle="dropdown"><i class="fa fa-bars"></i></a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#">Reply</a></li>
                <li><a href="#">Forward</a></li>
                <li><a href="#">Move to</a></li>
                <li class="divider"></li>
                <li><a href="#">Print</a></li>
                <li class="divider"></li>
                <li><a href="#">Delete</a></li>
            </ul>
        </div>
    </div>

    <div class="box box-default collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <strong>{{$fb->user->name}}</strong>
                - {{$fb->product}} <span class="text-info">|</span>
                @if($fb->getThread()->isUnread($currentUserId))
                    <span class="feedback-item-status label label-warning">not read</span>
                @else
                    <span class="feedback-item-status label label-default">read</span>
                @endif
                <small><span class="fa fa-circle-o text-teal mr-1x"></span> <span
                            class="hidden-xs">{{$fb->created_at->diffForHumans()}}</span>
                </small>
            </h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  read or reply reviews
                </button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <h1>{!! $fb->getThread()->subject !!}</h1>

            @foreach($fb->getThread()->messages as $message)
                <div class="media">
                    <div class="media-left">
                        {{--<a href="{!! route('admin::users::show', $message->user->id) !!}"--}}
                           {{--class="kit-avatar kit-avatar-42 no-border">--}}
                            {{--<img class="media-object" src="#" alt="{!! $message->user->name !!}">--}}
                        {{--</a>--}}
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading">{!! $message->user->name !!}</h5>
                        <p>{!! $message->body !!}</p>
                        <div class="text-muted">
                            <small>Posted {!! $message->created_at->diffForHumans() !!}</small>
                            <small> | Regards, <b>{{$message->user->name}}</b></small>

                        </div>
                    </div>
                </div>
            @endforeach

            <h2>Reply review</h2>
            {!! Form::open(['route' => ['admin::reviews::reply', $fb->id], 'method' => 'PUT', "role" => "form", ]) !!}
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
</div>

