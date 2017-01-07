<div class="col-xs-9 col-md-9 files">
    <div class="play-status"><i class="fa fa-play"></i></div>
    <?php $tag = isset($tag) ? $tag : null; ?>
@foreach(array_chunk($media->all(), 4) as $row)
        <div class="row file-list">
            @foreach($row as $file)
                {{--{!! dd($file) !!}--}}
                @if($file->aggregate_type == "video")
                    <li class="col-xs-6 col-md-3 file-item media-plyr-item" style="margin-bottom: 10px">
                        <a class="delete-file text-danger btn btn-default btn-xs" type="delete" role="button"
                           href="{{route("admin::media::get.delete", $file->id)}}">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                        <span class="mailbox-attachment-icon has-img">
                            <video controls>
                                <source src="{{$file->getUrl()}}"
                                        type="video/mp4">
                                <source src="{{$file->getUrl()}}"
                                        type="video/webm">
                            </video>
                        </span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i
                                        class="fa  fa-video-camera"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                            {!! formatBytes($file->size)!!}
                                <a class="pull-right btn btn-default btn-xs" data-rename-file="{!! $file->filename !!}"
                                   data-rename-path="{!! $file->id !!}" data-toggle="modal" type="rename" role="button"
                                   href="#renameFile-modal">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                <a class="pull-right btn btn-info btn-xs" type="download" role="button"
                                   href="{{route("admin::media::download", [$file->id, $folder->id])}}"><i
                                            class="fa fa-cloud-download"
                                            aria-hidden="true"></i></a>
                            </span>
                        </div>
                    </li>
                @elseif($file->aggregate_type == "image")
                    <li class="col-xs-6 col-md-3 file-item" style="margin-bottom: 10px">
                        <a class="delete-file text-danger btn btn-default btn-xs" type="delete" role="button"
                           href="{{route("admin::media::get.delete", $file->id)}}"><i class="fa fa-times"
                                                                                      aria-hidden="true"></i></a>
                        <span class="mailbox-attachment-icon has-img">
                            <img src="{{$file->getUrl()}}" width="266"
                                 height="150" alt="{{$file->filename}}">
                        </span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                          {!! formatBytes($file->size)!!}
                                <a class="pull-right btn btn-default btn-xs" data-rename-file="{!! $file->filename !!}"
                                   data-rename-path="{!! $file->id !!}" data-toggle="modal" type="rename" role="button"
                                   href="#renameFile-modal">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                <a class="pull-right btn btn-info btn-xs" type="download" role="button"
                                   href="{{route("admin::media::download", [$file->id, $folder->id])}}"><i
                                            class="fa fa-cloud-download"
                                            aria-hidden="true"></i></a>
                        </span>
                        </div>
                    </li>

                @elseif($file->aggregate_type == 'audio')

                    <li class="col-xs-6 col-md-3 file-item media-plyr-item" style="margin-bottom: 10px">
                        <a class="delete-file text-danger btn btn-default btn-xs" type="delete" role="button"
                           href="{{route("admin::media::get.delete", $file->id)}}"><i class="fa fa-times"
                                                                                      aria-hidden="true"></i></a>
                        <span class="mailbox-attachment-icon has-img">
                           <audio controls title="{{$file->filename}}">
                            <source src="{{$file->getUrl()}}"
                                    type="audio/mp3">
                            <source src="{{$file->getUrl()}}"
                                    type="audio/ogg">
                           </audio>
                        </span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i class="fa fa-music"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                          {!! formatBytes($file->size)!!}
                                <a class="pull-right btn btn-default btn-xs" data-rename-file="{!! $file->filename !!}"
                                   data-rename-path="{!! $file->id !!}" data-toggle="modal" type="rename" role="button"
                                   href="#renameFile-modal">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                <a class="pull-right btn btn-info btn-xs" type="download" role="button"
                                   href="{{route("admin::media::download", [$file->id, $folder->id])}}"><i
                                            class="fa fa-cloud-download"
                                            aria-hidden="true"></i></a>

                        </span>
                        </div>
                    </li>
                @elseif($file->aggregate_type == 'archive')
                    <li class="col-xs-6 col-md-3 file-item" style="margin-bottom: 10px">
                        <a class="delete-file text-danger btn btn-default btn-xs" type="delete" role="button"
                           href="{{route("admin::media::get.delete", $file->id)}}"><i class="fa fa-times"
                                                                                      aria-hidden="true"></i></a>
                        <span class="mailbox-attachment-icon has-img">
                            <i class="item-icon fa fa-archive"></i>
                        </span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i
                                        class="fa fa-paperclip"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                          {!! formatBytes($file->size)!!}
                                <a class="pull-right btn btn-default btn-xs" data-rename-file="{!! $file->filename !!}"
                                   data-rename-path="{!! $file->id !!}" data-toggle="modal" type="rename" role="button"
                                   href="#renameFile-modal">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                <a class="pull-right btn btn-info btn-xs" type="download" role="button"
                                   href="{{route("admin::media::download", [$file->id, $folder->id])}}"><i
                                            class="fa fa-cloud-download"
                                            aria-hidden="true"></i></a>
                        </span>
                        </div>
                    </li>

                @elseif($file->aggregate_type == 'document')

                    <li class="col-xs-6 col-md-3 file-item" style="margin-bottom: 10px">
                        <a class="delete-file text-danger btn btn-default btn-xs" type="delete" role="button"
                           href="{{route("admin::media::get.delete", $file->id)}}">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                        <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i
                                        class="fa fa-paperclip"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                          {!! formatBytes($file->size)!!}
                                <a class="pull-right btn btn-default btn-xs" data-rename-file="{!! $file->filename !!}"
                                   data-rename-path="{!! $file->id !!}" data-toggle="modal" type="rename" role="button"
                                   href="#renameFile-modal">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                <a class="pull-right btn btn-info btn-xs" type="download" role="button"
                                   href="{{route("admin::media::download", [$file->id, $folder->id])}}"><i
                                            class="fa fa-cloud-download"
                                            aria-hidden="true"></i></a>
                        </span>
                        </div>
                    </li>
                @elseif($file->aggregate_type == 'pdf')

                    <li class="col-xs-6 col-md-3 file-item" style="margin-bottom: 10px">
                        <a class="delete-file text-danger btn btn-default btn-xs" type="delete" role="button"
                           href="{{route("admin::media::get.delete", $file->id)}}">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                        <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i
                                        class="fa fa-paperclip"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                          {!! formatBytes($file->size)!!}
                                <a class="pull-right btn btn-default btn-xs" data-rename-file="{!! $file->filename !!}"
                                   data-rename-path="{!! $file->id !!}" data-toggle="modal" type="rename" role="button"
                                   href="#renameFile-modal">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                <a class="pull-right btn btn-info btn-xs" type="download" role="button"
                                   href="{{route("admin::media::download", [$file->id, $folder->id])}}"><i
                                            class="fa fa-cloud-download"
                                            aria-hidden="true"></i></a>
                        </span>
                        </div>
                    </li>
                @endif
            @endforeach
        </div>
        @if($media->count() == 0)
            <h3 class="text-warning">No Files found</h3>
        @endif
    @endforeach
</div>
<div class="modal" id="file-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" style="word-wrap: break-word;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@push('scripts-add_on')
<link rel="stylesheet" href="{{asset('plugins/plyr/plyr.css')}}">
<script src="{{ asset('/plugins/plyr/plyr.js') }}" type="text/javascript"></script>
<script>
    var players = plyr.setup();
    var playerStatus = $(".play-status");
    var counter = 0;
    players.forEach(function(player, i, arr){
        player.on('ready timeupdate pause ended playing', function(event) {
            counter++;
            switch(event.type) {
                case 'ready':
                    console.log(event.detail.plyr.getDuration());
                    break;
                case 'playing':
                    break;
                case 'timeupdate':
                    console.log(event.detail.plyr.getCurrentTime());
                    break;
                case 'ended':
                    if(arr.length - 1 > i) {
                        players[i+1].play();
                        playerStatus.toggle(2000);
                        playerStatus.html('<i class="fa  fa-step-forward"></i>')
                    } else {
                        players[0].play();
                        playerStatus.toggle(2000);
                        playerStatus.html('<i class="fa  fa-step-forward"></i>')
                    }
                    break;
                case 'pause':
                    console.log('fuck off');
                    playerStatus.toggle(2000);
                    playerStatus.html('<i class="fa fa-pause"></i>');
                    break;
            }
        });

    });

    var mediaItems = $(".media-plyr-item");

    [].forEach.call(mediaItems , function(item, i, arr) {
        $(item).attr('data-media-number', i);
    });

    mediaItems.find('.plyr__controls button[data-plyr="play"]').on("click", function(event){
        var audioItem = $(event.target).closest(".media-plyr-item").data('media-number');
        players.forEach(function(player, i, arr){
            player.stop();
            players[audioItem].play();
        });

    });
</script>
<script>
    $(function () {
        var descModal = $('#file-modal'),
            submitBtn = descModal.find('button[type=submit]'),
            modalTitle = descModal.find('.modal-title'),
            modalBody = descModal.find('.modal-body');

        descModal.on('shown.bs.modal', function (event) {
            var descTrigger = $(event.relatedTarget); // Button that triggered the modal
            $(this).modal('show');
            modalBody.html(null);
            modalTitle.html(null);
            $.ajax({
                url: descTrigger.data('desc-url'),
                type: 'GET',
                success: function (data) {
                    modalBody.html(data);
                    modalTitle.html('Media - ' + descTrigger.data('desc-name'));
                },
                error: function (xhr, textStatus, errorThrown) {
                    modalTitle.html("<p class='text-danger'>ERROR Appeared!</p>");
                    modalBody.html("<b class='text-warning'>" + xhr.responseJSON + "</b>" + "<br><code class='text-warning'>" + 'code - ' + xhr.status + ' statusText - ' + xhr.statusText + "</code>");
                    console.error(xhr);
                }
            });
            return false;
        });
    });

</script>

@endpush