<div class="modal" id="upload-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" style="word-wrap: break-word;">
                @include('admin.media.upload-form')
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
    .dropzone {
        border: 2px dashed #0087F7;
        border-radius: 5px;
        background: white;
    }
</style>
<script>
    $(function () {
        var uploadModal = $('#upload-modal'),
            submitBtn = uploadModal.find('button[type=submit]'),
            modalTitle = uploadModal.find('.modal-title'),
            modalBody = uploadModal.find('.modal-body');

        uploadModal.on('shown.bs.modal', function (event) {
            var uploadTrigger = $(event.relatedTarget); // Button that triggered the modal
            $(this).modal('show');
//            modalBody.html(null);
//            modalTitle.html(null);
//
//            $.ajax({
//                url: uploadTrigger.data('desc-url'),
//                type: 'GET',
//                success: function (data) {
//                    modalBody.html(data);
//                    modalTitle.html('Media Files');
//                },
//                error: function (xhr, textStatus, errorThrown) {
//                    modalTitle.html("<p class='text-danger'>ERROR Appeared!</p>");
//                    modalBody.html("<b class='text-warning'>"+xhr.responseJSON+"</b>"+ "<br><code class='text-warning'>" +'code - '+ xhr.status + ' statusText - '+xhr.statusText + "</code>");
//                    console.error(xhr);
//                }
//            });
//            return false;
        });
    });

</script>
@endpush