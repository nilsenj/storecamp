<div class="modal" id="renameDir-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Please Rename Directory</h4>
            </div>
            <div class="modal-body" style="word-wrap: break-word;">
                @include('admin.media.rename-dir-form')
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
<script>
    $(function () {
        var renameDirModal = $('#renameDir-modal'),
            submitBtn = renameDirModal.find('button[type=submit]'),
            modalTitle = renameDirModal.find('.modal-title'),
            modalBody = renameDirModal.find('.modal-body');

        renameDirModal.on('shown.bs.modal', function (event) {
            var renameDirTrigger = $(event.relatedTarget); // Button that triggered the modal
            var newPath = renameDirTrigger.data('new_name');
            var renameId = renameDirTrigger.data('rename-id');
            renameDirModal.find('.new_name').val(newPath);
            renameDirModal.find('.rename-id').val(renameId);
            $(this).modal('show');
        });
    });

</script>
@endpush