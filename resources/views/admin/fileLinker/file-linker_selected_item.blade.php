<div data-id="{!! $file->id !!}" class="col-xs-6 col-md-2 col-lg-1 selected-item">
    @if($file->aggregate_type == "image")
        <img src="{!! $file->getUrl() !!}" class="item-icon" alt="{{$file->filename}}">
    @else
        <i class="{!! $icon !!}"></i>
    @endif
    <strong class="text-muted"><i class="fa fa-paperclip"></i>
        {!! $file->filename !!}
    </strong>
</div>