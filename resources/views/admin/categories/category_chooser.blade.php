<div class="category nav nav-pills nav-stacked">
    @foreach($categories as $category)
        @if(!$category->parent_id && ($chosenCategory->id !== $category->id))
            <?php $children = $category->children; ?>
            <li class="treeview category-treeview">
            <a class="btn btn-app" role="button" href="#category-{{$category->id}}" data-category-id="{{$category->id}}">
                <i class="fa fa-link"></i>
                <span class="badge bg-green">{{count($children)}}</span>
                <span>{{$category->name}}</span>
            </a>
            @if(count($children))
            <ul class="treeview-menu nav nav-pills nav-stacked" style="display:none">
                @foreach ($children as $child)
                    <li>
                        <a class="btn btn-app" href="#category-{{$child->id}}">
                            <i class="fa fa-link"></i> {{$child->name}}
                        </a>
                    </li>
                @endforeach
            </ul>
            @endif
        </li>
        @endif
    @endforeach
</div>