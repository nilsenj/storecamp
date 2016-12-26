@extends('admin/app')
<h1>
    @section('breadcrumb')
        {{--{!! Breadcrumbs::render('admin') !!}--}}

        {!! \Breadcrumbs::render('roles', 'Roles') !!}
    @endsection
    @section('contentheader_title')

        All Roles Count ({!! \App\Core\Models\Role::all()->count() !!})
        &middot;
    @endsection
    @section('contentheader_description')
        <b>{!! link_to_route('admin::roles::create', 'Add New Role') !!}</b>
    @endsection
</h1>

@section('main-content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List of Roles</h3>
                    <div class="box-tools">
                        <form action="#" method="get" class="input-group" style="width: 150px;">
                            <input type="text" name="q" class="form-control input-sm pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </form>

                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
        <thead>
        <th>№</th>
        <th>Name</th>
        <th>Alias</th>
        <th>Description</th>
        <th>Privilege</th>
        <th>Created</th>
        <th class="text-center">Actions</th>
        </thead>
        <tbody>
        @foreach ($roles as $role)

            <tr>
                <td>{!! $no++ !!}</td>
                <td>{!! $role->name !!}</td>
                <td>{!! $role->slug !!}</td>
                <td>{!! $role->description !!}</td>
                <td>
                    @foreach($role->perms()->get() as $permission)
                        &bullet; {{ $permission->name }}<br>
                    @endforeach
                </td>
                <td>{!! $role->created_at !!}</td>
                <td class="text-center">
                    <a href="{!! route('admin::roles::edit', $role->id) !!}">Edit</a>
                    &middot;
                    {{--@include('admin::partials.modal', ['data' => $role, 'name' => 'roles'])--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <div class="text-center">
        {{--{!! $roles->links() !!}--}}
        {{--{!! pagination_links($categories) !!}--}}
    </div>


@endsection