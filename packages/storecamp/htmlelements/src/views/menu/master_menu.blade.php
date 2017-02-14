{{--NOTICE FOR MULTIPLE FILE QUERIES IN RECURSION WE HARDCODED THIS PART OF THE CODE--}}
<?php
if (!isset($class)) {
    $class = '';
}
if (!isset($childClass)) {
    $childClass = '';
}
if (!isset($childUlClass)) {
    $childUlClass = '';
}
?>
<ul class="{!! $structureClasses["root_class"] !!} {{ $class }}">
    @if ($menu->getLabel())
    <li class="header">
        {!! $menu->getLabel() !!}
    </li>
    @endif
    @foreach($menu->getItems() as $item)
            @if ($item['item'] instanceof \storecamp\htmlelements\Menu)
                <li class="{!! $structureClasses["li_class"] !!} {{$childClass}} {{ app('elements.menu.manager')->isActive($item) ? 'active' : '' }}">
                    <a class="{{$structureClasses["a_class"]}}" href="{!!  $item['item']->getItems()[0]['item']['url'] !!}">
                        {!! $item['before'] !!}
                        {!! $item['item']->getLabel()  !!}
                        {!! $item['after'] !!}
                    </a>
                    <ul class="{{$structureClasses["ul_class"]}} {{ $childUlClass }}">
                        @foreach($item['item']->getItems() as $item)
                            @if ($item['item'] instanceof \storecamp\htmlelements\Menu)
                                <li class="{!! $structureClasses["li_class"] !!} {{$childClass}} {{ app('elements.menu.manager')->isActive($item) ? 'active' : '' }}">
                                    <a class="{{$structureClasses["a_class"]}}" href="{!!  $item['item']->getItems()[0]['item']['url'] !!}">
                                        {!! $item['before'] !!}
                                        {!! $item['item']->getLabel()  !!}
                                        {!! $item['after'] !!}
                                    </a>
                                    @include(\storecamp\htmlelements\MenuManager::PLUGIN_NAME.'::menu.sub_menu', ['menu' => $item['item']])
                                </li>
                            @else
                                <li class="{{$structureClasses["li_class"]}} item {{ app('elements.menu.manager')->isActive($item) ? 'active' : '' }}">
                                    <a class="{{$structureClasses["a_class"]}}" href="{{ $item['item']['url'] }}">
                                        {!! $item['before'] !!}
                                        {!!  $item['item']['text']  !!}
                                        {!! $item['after'] !!}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="{{$structureClasses["li_class"]}} item {{ app('elements.menu.manager')->isActive($item) ? 'active' : '' }}">
                    <a class="{{$structureClasses["a_class"]}}" href="{{ $item['item']['url'] }}">
                        {!! $item['before'] !!}
                        {!!  $item['item']['text']  !!}
                        {!! $item['after'] !!}
                    </a>
                </li>
            @endif
    @endforeach
</ul>