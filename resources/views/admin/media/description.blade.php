@if($file->extension == "mp4" || $file->extension == "avi" || $file->extension == "mov" || $file->extension == "ogv" || $file->extension == "webm")

        <div class="title" style="overflow: hidden">{{$file->filename}}</div>
        <video controls>
            <source src="{{$file->getUrl()}}" type="video/mp4">
            <source src="{{$file->getUrl()}}" type="video/webm">
            <!-- Captions are optional -->
            {{--<track kind="captions" label="{{$file->filename}}" src="/path/to/captions.vtt" srclang="en" default>--}}
        </video>
@elseif($file->extension == "jpg" || $file->extension =="jpeg" || $file->extension == "png" || $file->extension == "gif")
        <div class="title" style="overflow: hidden">{{$file->filename}}</div>
        <img class="" src="{{$file->getUrl()}}" alt="{{$file->filename}}"
             width="266" height="150">
@elseif($file->extension == 'aac' ||
        $file->extension =='ogg' ||
        $file->extension == 'oga' ||
        $file->extension == 'mp3' ||
        $file->extension == 'wav')
        <div class="title">{{$file->filename}}</div>
        <audio controls title="{{$file->filename}}">
            <source src="{{$file->getUrl()}}" type="audio/mp3">
            <source src="{{$file->getUrl()}}" type="audio/ogg">
        </audio>
@endif

<script>plyr.setup();</script>
