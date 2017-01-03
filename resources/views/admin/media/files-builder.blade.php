<div class="col-xs-9 col-md-9">
    @foreach ($media as $file)
        {{--{!! dd($file) !!}--}}
        @if($file->extension == "mp4" || $file->extension == "avi" || $file->extension == "mov" || $file->extension == "ogv" || $file->extension == "webm")
        <div class="col-xs-3 col-md-3" style="margin-bottom: 10px">
            <video controls>
                <source src="{{$file->getUrl()}}" type="video/mp4">
                <source src="{{$file->getUrl()}}" type="video/webm">
                <!-- Captions are optional -->
                {{--<track kind="captions" label="{{$file->filename}}" src="/path/to/captions.vtt" srclang="en" default>--}}
            </video>
        </div>
        @elseif($file->extension == "jpg")
            <div class="col-xs-3 col-md-3"  style="margin-bottom: 10px">
            <img class="" src="{{$file->getUrl()}}" alt="{{$file->filename}}"
                 width="266" height="150">
            </div>
            @endif
    @endforeach
    @if($media->count() == 0)
        <h3 class="text-warning">No Files found</h3>
    @endif
</div>
@push('scripts-add_on')
<link rel="stylesheet" href="{{asset('plugins/plyr/plyr.css')}}">
<script src="{{ asset('/plugins/plyr/plyr.js') }}" type="text/javascript"></script>
<script>plyr.setup();</script>
@endpush