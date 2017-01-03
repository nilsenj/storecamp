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
        @if($path) <p>Folder <b style="font-size: 20px; text-decoration: underline;" class="text-success">{!! $path !!} </b></p> @endif
    @endsection
</h1>
@section('main-content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List of Media Files
                        @if(!$path)
                            <a class="btn btn-md btn-default" href="{{route('admin::media::index')}}" style="margin-left: 10px">
                                back
                            </a>
                        @else
                            <a class="btn btn-md btn-default" href="{{url()->previous()}}" style="margin-left: 10px">
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
                    </h3>

                    <div class="box-tools">
                        <form action="#" method="get" class="input-group" style="width: 150px;">
                            <input type="text" name="q" class="form-control input-sm pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
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
                                    <div class="col-xs-6 col-md-6">
                                        <a href="{{ route('admin::media::index', [$path ? $path.'_'.pathinfo($directory)['filename'] : pathinfo($directory)['filename']]) }}"
                                           class="btn btn-app"><i class='fa fa-file'></i>
                                            <span>{{pathinfo($directory)['filename']}}</span></a>
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
