
<div id="folder-body" data-folder-url="{{route('admin::media::get.index', [ $media["folderInstance"]->unique_id])}}" class="box-body folder-body">
    @include("admin.media.files-builder", [$media = $media["media"], $path = $media["path"], $tag = $media["tag"], $folderInstance = $media["folderInstance"]])
    <span id="folders-side">
    @include('admin.media.folders_part')
    </span>
</div>

@push('scripts-add_on')

<script>

</script>
@endpush