<tr>
    <td><?php $no++ ;?></td>
    <td>{{ $category->name }}</td>
    <td>{{ $category->slug }}</td>
    <td>{{ $category->description }}</td>
    <td>{{ $category->created_at }}</td>
    <td><a class="edit" href="{!! route('admin::categories::edit', $category->slug) !!}" title="Edit">
            <i class="fa fa-pencil-square-o"></i></a>
        <a class="delete text-warning" href="{!! route('admin::categories::get::delete', $category->id) !!}" title="Are you sure you want to delete?"><i class="fa fa-trash-o"></i></a>
    @foreach ($category->children as $child)
        @include('category', ['category' => $child])
    @endforeach
</tr>
