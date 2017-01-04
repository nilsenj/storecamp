<div class="col-xs-9 col-md-9">
    <?php $tag = isset($tag) ? $tag : null; ?>
    @foreach(array_chunk($media->all(), 4) as $row)
        <div class="row">
            @foreach($row as $file)
                {{--{!! dd($file) !!}--}}
                @if($file->extension == "mp4" || $file->extension == "avi" || $file->extension == "mov" || $file->extension == "ogv" || $file->extension == "webm")
                        <div class="col-xs-3 col-md-3 file-item" style="margin-bottom: 10px">
                            {{--<a class="tag-file text-info btn btn-success btn-xs" role="button" href="{{url($path ? 'admin/media/'.$path."/video" : 'admin/media/#/video')}}"><i class="fa fa-file-video-o" aria-hidden="true"></i></a>--}}
                            <a class="delete-file text-danger btn btn-default btn-xs" type="delete" role="button" href="{{route("admin::media::get.delete", $file->id)}}"><i class="fa fa-times" aria-hidden="true"></i></a>
                            <div class="title" style="overflow: hidden">{{$file->filename}}</div>
                            <video controls>
                                <source src="{{$file->getUrl()}}" type="video/mp4">
                                <source src="{{$file->getUrl()}}" type="video/webm">
                                <!-- Captions are optional -->
                                {{--<track kind="captions" label="{{$file->filename}}" src="/path/to/captions.vtt" srclang="en" default>--}}
                            </video>
                        </div>
                @elseif($file->extension == "jpg" || $file->extension =="jpeg" || $file->extension == "png" || $file->extension == "gif")
                    <div class="col-xs-3 col-md-3 file-item" style="margin-bottom: 10px">
                        <a class="delete-file text-danger btn btn-default btn-xs" type="delete" role="button" href="{{route("admin::media::get.delete", $file->id)}}"><i class="fa fa-times" aria-hidden="true"></i></a>
                        <div class="title" style="overflow: hidden">{{$file->filename}}</div>
                        <img class="" src="{{$file->getUrl()}}" alt="{{$file->filename}}"
                             width="266" height="150">
                    </div>

                @elseif($file->extension == 'aac' ||
                        $file->extension =='ogg' ||
                        $file->extension == 'oga' ||
                        $file->extension == 'mp3' ||
                        $file->extension == 'wav')
                    <div class="col-xs-3 col-md-3 file-item" alt="{{$file->filename}}" style="margin-bottom: 10px">
                        <a class="delete-file text-danger btn btn-default btn-xs" type="delete" role="button" href="{{route("admin::media::get.delete", $file->id)}}"><i class="fa fa-times" aria-hidden="true"></i></a>
                        <div class="title">{{$file->filename}}</div>
                        <audio controls title="{{$file->filename}}">
                            <source src="{{$file->getUrl()}}" type="audio/mp3">
                            <source src="{{$file->getUrl()}}" type="audio/ogg">
                        </audio>
                    </div>
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
.delete-file, .tag-file {
    position: absolute;
    top: auto;
    right: 10px;
    display: none;
}
.tag-file {
    left: 15px;
    right: auto;
    display: none;
    padding: 5px;
    top: 30px;
    z-index: 9999;
}
.file-item:hover .delete-file, .file-item:hover .tag-file {
    display: block;
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
                    modalTitle.html('Media - '+descTrigger.data('desc-name'));
                },
                error: function (xhr, textStatus, errorThrown) {
                    modalTitle.html("<p class='text-danger'>ERROR Appeared!</p>");
                    modalBody.html("<b class='text-warning'>"+xhr.responseJSON+"</b>"+ "<br><code class='text-warning'>" +'code - '+ xhr.status + ' statusText - '+xhr.statusText + "</code>");
                    console.error(xhr);
                }
            });
            return false;
        });
    });

</script>
@endpush