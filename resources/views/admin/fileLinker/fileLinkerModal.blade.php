<a data-toggle="modal" href="#fileLinker-modal"
   class="btn btn-md btn-info file-linker"
   data-file-types="{!! $fileTypes ? $fileTypes : "images" !!}"
   data-multiple="{!! $multiple ? 'true' : 'false' !!}"
   data-disk="{!! $disk ? $disk : 'local' !!}"
   data-attach-output-path="{!! $outputElementPath !!}"
   data-requestUrl="{!! route('admin::media::file_linker', [$disk]) !!}"
>
    {!! $btnMsg ? $btnMsg : "attach file" !!}
</a>
<div class="modal tallModal modal-wide" id="fileLinker-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Please Select Files To Attach</h4>
            </div>
            <div class="modal-body" style="word-wrap: break-word;">
            </div>
            <div class="modal-footer">
                <div class="col-md-10 selected-block"></div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>