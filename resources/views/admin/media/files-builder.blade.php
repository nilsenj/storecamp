<div class="col-xs-9 col-md-9 files">
    <?php $tag = isset($tag) ? $tag : null; ?>
    @foreach(array_chunk($media->all(), 4) as $row)
        <div class="row">
            @foreach($row as $file)
                {{--{!! dd($file) !!}--}}
                @if($file->aggregate_type == "video")
                    <li class="col-xs-3 col-md-3 file-item" style="margin-bottom: 10px">
                        <a class="delete-file text-danger btn btn-default btn-xs" type="delete" role="button"
                           href="{{route("admin::media::get.delete", $file->id)}}">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                        <span class="mailbox-attachment-icon has-img">
                            <video controls>
                                <source src="{{url('uploads/'.$path."/".$file->filename . "." .$file->extension)}}"
                                        type="video/mp4">
                                <source src="{{url('uploads/'.$path."/".$file->filename . "." .$file->extension)}}"
                                        type="video/webm">
                            </video>
                        </span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i class="fa  fa-video-camera"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                            {!! formatBytes($file->size)!!}
                                <a class="pull-right btn btn-info btn-xs" type="download" role="button"
                                   href="{{route("admin::media::download", $file->id)}}">
                                    <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                </a>
                            </span>
                        </div>
                    </li>
                @elseif($file->aggregate_type == "image")
                    <li class="col-xs-3 col-md-3 file-item" style="margin-bottom: 10px">
                        <a class="delete-file text-danger btn btn-default btn-xs" type="delete" role="button"
                           href="{{route("admin::media::get.delete", $file->id)}}"><i class="fa fa-times"
                                                                                      aria-hidden="true"></i></a>
                        <span class="mailbox-attachment-icon has-img">
                            <img src="{{url('uploads/'.$path."/".$file->filename . "." .$file->extension)}}" width="266"
                                 height="150" alt="{{$file->filename}}">
                        </span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                          {!! formatBytes($file->size)!!}
                                <a class="pull-right btn btn-info btn-xs" type="download" role="button"
                                   href="{{route("admin::media::download", $file->id)}}"><i class="fa fa-cloud-download"
                                                                                            aria-hidden="true"></i></a>
                        </span>
                        </div>
                    </li>

                @elseif($file->aggregate_type == 'audio')
                    <li class="col-xs-3 col-md-3 file-item" style="margin-bottom: 10px">
                        <a class="delete-file text-danger btn btn-default btn-xs" type="delete" role="button"
                           href="{{route("admin::media::get.delete", $file->id)}}"><i class="fa fa-times"
                                                                                      aria-hidden="true"></i></a>
                        <span class="mailbox-attachment-icon has-img">
                           <audio controls title="{{$file->filename}}">
                            <source src="{{url('uploads/'.$path."/".$file->filename . "." .$file->extension)}}"
                                    type="audio/mp3">
                            <source src="{{url('uploads/'.$path."/".$file->filename . "." .$file->extension)}}"
                                    type="audio/ogg">
                           </audio>
                        </span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i class="fa fa-music"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                          {!! formatBytes($file->size)!!}
                                <a class="pull-right btn btn-info btn-xs" type="download" role="button"
                                   href="{{route("admin::media::download", $file->id)}}"><i class="fa fa-cloud-download"
                                                                                            aria-hidden="true"></i></a>
                        </span>
                        </div>
                    </li>
                @elseif($file->aggregate_type == 'archive')
                    <li class="col-xs-3 col-md-3 file-item" style="margin-bottom: 10px">
                        <a class="delete-file text-danger btn btn-default btn-xs" type="delete" role="button"
                           href="{{route("admin::media::get.delete", $file->id)}}"><i class="fa fa-times"
                                                                                      aria-hidden="true"></i></a>
                        <span class="mailbox-attachment-icon has-img">
                            <i class="item-icon fa fa-archive"></i>
                        </span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                          {!! formatBytes($file->size)!!}
                                <a class="pull-right btn btn-info btn-xs" type="download" role="button"
                                   href="{{route("admin::media::download", $file->id)}}"><i class="fa fa-cloud-download"
                                                                                            aria-hidden="true"></i></a>
                        </span>
                        </div>
                    </li>

                @elseif($file->aggregate_type == 'document')

                    <li class="col-xs-3 col-md-3 file-item" style="margin-bottom: 10px">
                        <a class="delete-file text-danger btn btn-default btn-xs" type="delete" role="button"
                           href="{{route("admin::media::get.delete", $file->id)}}">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                        <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                          {!! formatBytes($file->size)!!}
                                <a class="pull-right btn btn-info btn-xs" type="download" role="button"
                                   href="{{route("admin::media::download", $file->id)}}"><i class="fa fa-cloud-download"
                                                                                            aria-hidden="true"></i></a>
                        </span>
                        </div>
                    </li>
                @elseif($file->aggregate_type == 'pdf')

                    <li class="col-xs-3 col-md-3 file-item" style="margin-bottom: 10px">
                        <a class="delete-file text-danger btn btn-default btn-xs" type="delete" role="button"
                           href="{{route("admin::media::get.delete", $file->id)}}">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                        <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                          {!! formatBytes($file->size)!!}
                                <a class="pull-right btn btn-info btn-xs" type="download" role="button"
                                   href="{{route("admin::media::download", $file->id)}}">
                                    <i class="fa fa-cloud-download" aria-hidden="true"></i></a>
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
<style>
    .files li {
        list-style-type: none;
    }

    .delete-file, .rename-file, .download-file, .tag-file {
        position: absolute;
        top: auto;
        right: 10px;
        display: none;
        padding: 3px;
    }

    .download-file {
        display: none;
        top: 30px;
        z-index: 9999;
    }
    .rename-file {
        display: none;
        top: 30px;
        z-index: 9999;
    }
    .file-item .item-icon {
        width: 100%;
        height: 150px;
        display: block;
        font-size: 120px;
        text-align: center;
        list-style-type: none !important;
    }

    .file-item:hover .delete-file, .file-item:hover .download-file, .directory-item:hover .delete-file, .directory-item:hover .rename-file {
        display: block;
        z-index: 9999;
    }
</style>
<link rel="stylesheet" href="{{asset('plugins/plyr/plyr.css')}}">
<script src="{{ asset('/plugins/plyr/plyr.js') }}" type="text/javascript"></script>
<script>plyr.setup();</script>
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