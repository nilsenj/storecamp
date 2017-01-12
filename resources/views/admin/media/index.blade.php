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

                            @include('admin.partial._box_search')
                        </div>
                    </div>
                    <div class="clearifx"></div>
                    <span class="media_tags">
                           <span class="text-muted">only: </span>
                        <li>
                    <a href="{{url('admin/media/'.$folder->id)}}" class="btn btn-xs btn-icon" style="margin-left: 10px">
                        - all
                    </a>
                        </li>
                        <li>
                            <a href="{{url('admin/media/'.$folder->id."?tag=video")}}" class="btn btn-xs btn-icon"
                               style="margin-left: 10px">
                        <i class="fa fa-video-camera"></i> - video
                    </a>
                        </li>

                        <li>
                             <a href="{{url('admin/media/'.$folder->id."?tag=audio")}}" class="btn btn-xs btn-icon"
                                style="margin-left: 10px">
                        <i class="fa fa-music"></i> - audio
                    </a>
                        </li>
                        <li>
                              <a href="{{url('admin/media/'.$folder->id."?tag=image")}}" class="btn btn-xs btn-icon"
                                 style="margin-left: 10px">
                        <i class="fa fa-image"></i> - image
                    </a>
                        </li>
                        <li>
                            <a href="{{url('admin/media/'.$folder->id."?tag=pdf")}}" class="btn btn-xs btn-icon"
                               style="margin-left: 10px">
                        <i class="fa fa-file-pdf-o"></i> - pdf
                    </a>
                        </li>
                        <li>
                             <a href="{{url('admin/media/'.$folder->id."?tag=archive")}}" class="btn btn-xs btn-icon"
                                style="margin-left: 10px">
                        <i class="fa fa-file-archive-o"></i> - archive
                    </a>
                        </li>
                        <li>
                            <a href="{{url('admin/media/'.$folder->id."?tag=document")}}" class="btn btn-xs btn-icon"
                               style="margin-left: 10px">
                        <i class="fa fa-file-archive-o"></i> - document
                    </a>
                        </li>

                    </span>
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

@endsection
@include('admin.media.upload-modal')
@include('admin.media.newdir-modal')
@include('admin.media.rename-dir-modal')
@include('admin.media.rename-file-modal')
