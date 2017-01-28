<div class="col-xs-7 col-sm-7 col-md-8 col-lg-9 files">
    <?php $tag = isset($tag) ? $tag : null; ?>

    @foreach(array_chunk($media->all(), 3) as $row)
        <div class="row file-list">
            @foreach($row as $file)
                @if($file->aggregate_type == "video")
                    <li class="col-xs-12 col-md-12 col-lg-4 file-item media-plyr-item"
                        style="margin-bottom: 10px">
                        <a class="select-file text-danger btn btn-default btn-xs"
                           type="select"
                           role="checkbox"
                           data-file-id="{!! $file->id !!}"
                           href="{{$file->getUrl()}}">
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
                            </span>
                        </div>
                    </li>
                @elseif($file->aggregate_type == "image")
                    <li role="checkbox"
                        data-disk="{!! $disk !!}"
                        data-file-id="{!! $file->id !!}"
                        data-href="{{$file->getUrl()}}"
                        class="col-xs-12 col-md-12 col-lg-4 file-item"
                        style="margin-bottom: 10px">

                        <span class="mailbox-attachment-icon has-img">
                            <img src="{{$file->getUrl()}}" width="266"
                                 height="150" alt="{{$file->filename}}">
                        </span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i
                                        class="fa fa-camera"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                                            {!! formatBytes($file->size)!!}
                            </span>
                            <input class="pull-right selectedFile" type="checkbox" name="selectedFile[]">
                        </div>
                    </li>

                @elseif($file->aggregate_type == 'audio')
                    <li role="checkbox"
                        data-disk="{!! $disk !!}"
                        data-file-id="{!! $file->id !!}"
                        data-href="{{$file->getUrl()}}"
                        class="col-xs-12 col-md-12 col-lg-4 file-item media-plyr-item"
                        style="margin-bottom: 10px">
                        <span class="mailbox-attachment-icon has-img">
                           <audio controls title="{{$file->filename}}">
                            <source src="{{$file->getUrl()}}"
                                    type="audio/mp3">
                            <source src="{{$file->getUrl()}}"
                                    type="audio/ogg">
                           </audio>
                        </span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i
                                        class="fa fa-music"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                                {!! formatBytes($file->size)!!}
                            </span>
                            <input class="pull-right selectedFile" type="checkbox" name="selectedFile[]">
                        </div>
                    </li>
                @elseif($file->aggregate_type == 'archive')
                    <li role="checkbox"
                        data-disk="{!! $disk !!}"
                        data-file-id="{!! $file->id !!}"
                        data-href="{{$file->getUrl()}}"
                        class="col-xs-12 col-md-12 col-lg-4 file-item"
                        style="margin-bottom: 10px">
                        <span class="mailbox-attachment-icon has-img">
                                            <i class="item-icon fa fa-archive"></i>
                                        </span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i
                                        class="fa fa-paperclip"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                                {!! formatBytes($file->size)!!}
                            </span>
                            <input class="pull-right selectedFile" type="checkbox" name="selectedFile[]">
                        </div>
                    </li>

                @elseif($file->aggregate_type == 'document')
                    <li role="checkbox"
                        data-disk="{!! $disk !!}"
                        data-file-id="{!! $file->id !!}"
                        data-href="{{$file->getUrl()}}"
                        class="col-xs-12 col-md-12 col-lg-4 file-item"
                        style="margin-bottom: 10px">
                        <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i
                                        class="fa fa-paperclip"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                                {!! formatBytes($file->size)!!}
                            </span>
                            <input class="pull-right selectedFile" type="checkbox" name="selectedFile[]">
                        </div>
                    </li>
                @elseif($file->aggregate_type == 'pdf')
                    <li role="checkbox"
                        data-disk="{!! $disk !!}"
                        data-file-id="{!! $file->id !!}"
                        data-href="{{$file->getUrl()}}"
                        class="col-xs-12 col-md-12 col-lg-4 file-item"
                        style="margin-bottom: 10px">
                        <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                        <div class="mailbox-attachment-info">
                            <a href="#" class="mailbox-attachment-name"><i
                                        class="fa fa-paperclip"></i> {{$file->filename}}
                            </a>
                            <span class="mailbox-attachment-size">
                                {!! formatBytes($file->size)!!}
                            </span>
                            <input class="pull-right selectedFile" type="checkbox" name="selectedFile[]">
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
<div class="col-xs-5 col-sm-5 col-md-4 col-lg-3 directories">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Folders</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                            class="fa fa-plus"></i>
                </button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: block;">

            @foreach($directories as $directory)
                <div class="col-xs-12 col-md-6 directory-item">
                    <a
                            class="btn btn-app select-folder"
                            type="select"
                            role="checkbox"
                            data-file-id="{{route('admin::media::index', [$disk, $directory->unique_id]) }}"
                    ><i class='fa fa-file'></i>
                        <span>{{str_limit($directory['name'], 15)}}</span>
                        @if($directory->locked)
                            <span rel="tooltip" title="Folder Locked" data-toggle="tooltip"
                                  data-container="body"
                                  class="locked-file text-info btn-xs" role="button">
                                <span class="fa fa-key" aria-hidden="true"></span>
                            </span>
                        @endif
                    </a>
                </div>
            @endforeach
            @if($directories->count() == 0)
                <h3 class="text-warning">No folders found</h3>
            @endif
        </div>
        <!-- /.box-body -->
    </div>
</div>
<div class="clearfix"></div>
