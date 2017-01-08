<div id="folder-body" data-folder-url="{{route('admin::media::get.index', [$folder->id])}}" class="box-body folder-body">
    {!! $media !!}
    <span id="folders-side">
    @include('admin.media.folders_part')
    </span>
</div>
</div><!-- /.box-body -->

@push('scripts-add_on')

<script>

</script>
@endpush