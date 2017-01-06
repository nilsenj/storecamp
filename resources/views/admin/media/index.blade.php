@extends('admin/app')
<h1>
    @section('breadcrumb')
        {{--{!! Breadcrumbs::render('admin') !!}--}}

        {!! Breadcrumbs::render('media', 'media') !!}
    @endsection
    @section('contentheader_title')
        Amount of Media Files
        &middot; {{$count}}
    @endsection
    @section('contentheader_description')
        @if($folder)
            <p>Folder
                <b style="font-size: 20px; text-decoration: underline;" class="text-info">
                    <a class="" href="{{route('admin::media::index')}}" style="margin-left: 10px">
                        {!! "../" !!}
                    </a>
                    <a class="" href="{{route('admin::media::index', $folder->id)}}" style="margin-left: 10px">
                        {!! $path !!}
                    </a>
                </b>
            </p>
        @endif
    @endsection
</h1>
@section('main-content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List of Media Files

                    </h3>

                    <div class="box-tools">

                        <div class="form-group">
                            @if(!$folder)
                                <a class="btn btn-md btn-default" href="{{route('admin::media::index')}}"
                                   style="margin-left: 10px">
                                    back
                                </a>
                            @else
                                <a class="btn btn-md btn-default" href="{{url()->previous()}}"
                                   style="margin-left: 10px">
                                    back
                                </a>
                            @endif
                            <a data-toggle="modal"
                               href="#upload-modal"
                               class="btn btn-md btn-default" style="margin-left: 10px">
                                upload
                            </a>
                            <a data-toggle="modal"
                               href="#newdir-modal"
                               class="btn btn-md btn-default" style="margin-left: 10px">
                                create directory
                            </a>

                            <form action="#" method="get" class="input-group pull-right"
                                  style="width: 200px; margin-left: 10px">
                                <input type="text" name="q" class="form-control pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-info" style="padding: 9px;"><i
                                                class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="clearifx"></div>
                    <span class="text-muted">only: </span>
                    <a href="{{url('admin/media/'.$folder->id)}}" class="btn btn-xs btn-icon" style="margin-left: 10px">
                        - all
                    </a>
                    <a href="{{url('admin/media/'.$folder->id."?tag=video")}}" class="btn btn-xs btn-icon"
                       style="margin-left: 10px">
                        <i class="fa fa-video-camera"></i> - video
                    </a>
                    <a href="{{url('admin/media/'.$folder->id."?tag=audio")}}" class="btn btn-xs btn-icon"
                       style="margin-left: 10px">
                        <i class="fa fa-music"></i> - audio
                    </a>
                    <a href="{{url('admin/media/'.$folder->id."?tag=image")}}" class="btn btn-xs btn-icon"
                       style="margin-left: 10px">
                        <i class="fa fa-image"></i> - image
                    </a>
                    <a href="{{url('admin/media/'.$folder->id."?tag=pdf")}}" class="btn btn-xs btn-icon"
                       style="margin-left: 10px">
                        <i class="fa fa-file-pdf-o"></i> - pdf
                    </a>
                    <a href="{{url('admin/media/'.$folder->id."?tag=archive")}}" class="btn btn-xs btn-icon"
                       style="margin-left: 10px">
                        <i class="fa fa-file-archive-o"></i> - archive
                    </a>
                    <a href="{{url('admin/media/'.$folder->id."?tag=document")}}" class="btn btn-xs btn-icon"
                       style="margin-left: 10px">
                        <i class="fa fa-file-archive-o"></i> - document
                    </a>
                </div><!-- /.box-header -->
                {!! Form::open(['files' => true, 'route' => 'admin::media::upload',  'id' => 'my-awesome-dropzone-body', 'class' => 'dropzone box-body folder-body']) !!}
                <input type="hidden" name="folder" value="{{$folder->id}}">
                @include('admin.media.index-body_part')
                {!! Form::close() !!}
            </div><!-- /.box -->
        </div>
    </div>
@endsection
@section('scripts_add')
    <link rel="stylesheet" href="{{asset('plugins/dropzone/dropzone.css')}}">
    <script src="{{ asset('/plugins/dropzone/dropzone.js') }}" type="text/javascript"></script>
    <script>
        Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 1024, // MB
            acceptedFiles: ".mp4,.mkv,.avi, image/*,application/pdf,.psd,.docx,.doc,.aac,.ogg,.oga,.mp3,.wav, .zip",
            accept: function (file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, Are you kidding(");
                }
                else {
                    done();
                }
            },
            init: function () {
                this.on("success", function (file, messageOrDataFromServer, myEvent) {
                    var folderBody = $("#folder-body");
                    $.ajax({
                        url: "{{route('admin::media::get.index', [$folder->id])}}",
                        type: 'GET',
                        success: function (data) {
                            folderBody.html(data);
                            plyr.setup();

                        },
                        error: function (xhr, textStatus, errorThrown) {
                            folderBody.html("<b class='text-warning'>" + xhr.responseJSON + "</b>" + "<br><code class='text-warning'>" + 'code - ' + xhr.status + ' statusText - ' + xhr.statusText + "</code>");
                            console.error(xhr);
                        }
                    });
                    return false;
                });
            }
        };
        Dropzone.options.myAwesomeDropzoneBody = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 1024, // MB
            acceptedFiles: ".mp4,.mkv,.avi, image/*,application/pdf,.psd,.docx,.doc,.aac,.ogg,.oga,.mp3,.wav, .zip",
            accept: function (file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, Are you kidding(");
                }
                else {
                    done();
                }
            },
            init: function () {
                this.on("success", function (file, messageOrDataFromServer, myEvent) {
                    var folderBody = $("#folder-body");
                    $.ajax({
                        url: "{{route('admin::media::get.index', [$folder->id])}}",
                        type: 'GET',
                        success: function (data) {
                            folderBody.html(data);
                            plyr.setup();

                        },
                        error: function (xhr, textStatus, errorThrown) {
                            folderBody.html("<b class='text-warning'>" + xhr.responseJSON + "</b>" + "<br><code class='text-warning'>" + 'code - ' + xhr.status + ' statusText - ' + xhr.statusText + "</code>");
                            console.error(xhr);
                        }
                    });
                    return false;
                });
            }
        };
        //                Dropzone.myAwesomeDropzone.autoDiscover = false;
    </script>
@endsection
@include('admin.media.upload-modal')
@include('admin.media.newdir-modal')
@include('admin.media.rename-dir-modal')
@include('admin.media.rename-file-modal')
