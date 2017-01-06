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
                                    <button type="button" class="btn btn-info" style="padding: 9px;"><i
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
                <div class="box-body">
                    {!! $media !!}
                    <div class="col-xs-3">
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
                                        <a class="delete-file text-danger btn btn-default btn-xs" type="delete"
                                           role="button"
                                           href="{{route("admin::media::get.folder.delete", [$directory->id])}}"><i
                                                    class="fa fa-times" aria-hidden="true"></i></a>
                                        <a class="rename-file text-danger btn btn-default btn-xs" data-toggle="modal"
                                           href="#renameDir-modal" data-new_name="{{$path.$directory->name}}"
                                           data-rename-id="{{$directory->id}}" type="rename" role="button"><i
                                                    class="fa fa-edit" aria-hidden="true"></i></a>
                                        <a href="{{ route('admin::media::index', [$directory->id]) }}"
                                           class="btn btn-app"><i class='fa fa-file'></i>
                                            <span>{{$directory['name']}}</span></a>
                                    </div>
                                @endforeach
                                @if(empty($directories))
                                    <h3 class="text-warning">No folders found</h3>
                                @endif
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
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
            }
        };
    </script>
@endsection
@include('admin.media.upload-modal')
@include('admin.media.newdir-modal')
@include('admin.media.rename-dir-modal')
@include('admin.media.rename-file-modal')
