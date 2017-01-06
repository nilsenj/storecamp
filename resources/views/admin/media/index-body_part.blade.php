<div id="folder-body" class="box-body folder-body">
    {!! $media !!}
    <span id="folders-side">
    @include('admin.media.folders_part')
    </span>
</div>
</div><!-- /.box-body -->

@push('scripts-add_on')
<style>
    #my-awesome-dropzone-body {
        border: 2px dashed aliceblue;
        border-radius: 5px;
        background: white;
    }
    #my-awesome-dropzone-body .dz-message {
        text-decoration: dashed;
        font-weight: 700;
    }
    #my-awesome-dropzone-body > .dz-preview {
     display: none;
    }
</style>
<script>

</script>
@endpush