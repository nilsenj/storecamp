@extends('admin/app')
<h1>
    @section('breadcrumb')
        {{--{!! Breadcrumbs::render('admin') !!}--}}

        {!! Breadcrumbs::render('media', 'media') !!}
    @endsection
    @section('contentheader_title')

        Amount of Media Files
        &middot;
    @endsection
    @section('contentheader_description')
        <b>{!! link_to_route('admin::media::create', 'Add New Media File') !!}</b>
    @endsection
</h1>

@section('main-content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List of Media Files
                        <a data-desc-url="{{route('admin::media::directories')}}" data-toggle="modal"
                           href="#upload-modal"
                           class="btn btn-xs btn-default" style="margin-left: 10px">
                            upload
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
                    <div class="col-xs-9 col-md-9">
                        @foreach ($media as $file)
                            <div class="col-xs-6 col-md-2">
                                <img class="img-responsive" src="{{$file->getUrl()}}" alt="{{$file->filename}}" width="304" height="236">
                            </div>
                        @endforeach
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
            acceptedFiles: ".mp4,.mkv,.avi, image/*,application/pdf,.psd,.docx,.doc",
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, Are you kidding(");
                }
                else { done(); }
            }
        };
    </script>
@endsection
@include('admin.media.upload-modal')
