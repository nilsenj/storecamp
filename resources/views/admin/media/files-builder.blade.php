<div class="col-xs-8 col-md-9 files">
    <?php $tag = isset($tag) ? $tag : null; ?>

    @foreach(array_chunk($media->all(), 3) as $row)
        <div class="row file-list">
            @foreach($row as $file)
            @if($file->aggregate_type == "video")
                    <li class="col-xs-12 col-md-12 col-lg-4 file-item media-plyr-item" style="margin-bottom: 10px">
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
                    <li class="col-xs-12 col-md-12 col-lg-4 file-item" style="margin-bottom: 10px">
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
                    <li class="col-xs-12 col-md-12 col-lg-4 file-item media-plyr-item" style="margin-bottom: 10px">
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
                    <li class="col-xs-12 col-md-12 col-lg-4 file-item" style="margin-bottom: 10px">
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

                    <li class="col-xs-12 col-md-12 col-lg-4 file-item" style="margin-bottom: 10px">
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

                    <li class="col-xs-12 col-md-12 col-lg-4 file-item" style="margin-bottom: 10px">
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