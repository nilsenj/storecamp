<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Slug</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($categories as $category)
        include('category')
    @endforeach
    </tbody>
</table>