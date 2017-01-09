<tr>

    <td>{{ $no-1}}</td>
    <td>{{ $category->name }}</td>
    <td>{{ $category->slug }}</td>
    <td>
        <a data-toggle="modal" href="#description-modal"
           class="btn btn-xs btn-info"
           data-desc-url="{{route('admin::categories::description', $category->id)}}"
           data-desc-id="{{ $category->id }}"
           data-desc-name="{{ $category->name }}">
            show
        </a>
    </td>
    @if($category->status)
        <td>
            <div class="label bg-green">active</div>
        </td>
    @else
        <td>
            <div class="label bg-warning">not active</div>
        </td>
    @endif
    <td>{!! $category->sort_order !!}</td>
    <td>{{ $category->created_at }}</td>
    <td><a class="edit" href="{!! route('admin::categories::edit', $category->id) !!}" title="Edit">
            <i class="fa fa-pencil-square-o"></i></a>
        <a class="delete text-warning" href="{!! route('admin::categories::get::delete', $category->id) !!}"
           title="Are you sure you want to delete?"><i class="fa fa-trash-o"></i></a>
    </td>
</tr>
