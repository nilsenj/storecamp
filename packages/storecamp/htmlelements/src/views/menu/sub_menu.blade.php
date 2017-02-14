<ul class="{{$structureClasses["ul_class"]}} {{ $childUlClass }}">
    @foreach($menu->getItems() as $item)
        @include(\storecamp\htmlelements\MenuManager::PLUGIN_NAME.'::menu.menu_item')
    @endforeach
</ul>