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

