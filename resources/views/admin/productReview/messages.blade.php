@foreach($messages as $message)
    <div class="box-comment">
        <div class="media-left">
            {{--<a href="{{ route('admin::users::show', $message->user->id) }}"--}}
            {{--class="kit-avatar kit-avatar-42 no-border">--}}
            {{--<img class="media-object" src="#" alt="{{ $message->user->name }}">--}}
            {{--</a>--}}
        </div>
        <div class="comment-text">
                         <span class="username">
                             <a href="{{ route("admin::users::show", $message->user->id) }}">
                            {{$message->user->name}}
                             </a>
                        <a style="margin: auto 10px; text-decoration: underline" data-href="{{route('admin::reviews::editMessage', [$message->id])}}" data-message-block="{{$message->id}}" class="text-info editMessage pull-right">Edit</a>
                        <span class="text-muted pull-right">Posted {{ $message->created_at->diffForHumans() }}</span>
                      </span>
            <p class="comment-text" id="{{$message->id}}">{{ $message->body }}</p>
            <div class="text-muted">
                <small>Posted {{ $message->created_at->diffForHumans() }}</small>
                <small> | Regards, <b>{{ $message->user->name }}</b></small>
            </div>
        </div>
    </div>
@endforeach