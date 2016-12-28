<a data-toggle="modal" href="#category-chooser-modal"
   class="form-control" style="display: block; position: relative; width: 100%">
    choose parent category
</a>
<div class="modal" id="category-chooser-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Choose Parent Category</h4>
            </div>
            <div class="modal-body" style="word-wrap: break-word;">
                @include('admin.categories.category_chooser', [$chosenCategory = $category])
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

    });
</script>
@endpush