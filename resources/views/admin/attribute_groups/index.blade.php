@extends('admin/app')
<h1>
    @section('breadcrumb')
        {{--{!! Breadcrumbs::render('admin') !!}--}}

        {!! Breadcrumbs::render('attribute groups', 'Attribute Groups') !!}
    @endsection
    @section('contentheader_title')

        Amount of Group Attributes ({!! \App\Core\Models\AttributeGroup::all()->count() !!})
        &middot;
    @endsection
    @section('contentheader_description')
        <b>{!! link_to_route('admin::attribute_groups::create', 'Add New Group Attribute') !!}</b>
    @endsection
</h1>

@section('main-content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List of Group Attributes</h3>
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
        <th>#</th>
        <th>Attribute Id</th>
        <th>Attribute Group</th>
        <th>Sort Order</th>
        <th>Created</th>
        <th class="text-center">Actions</th>
        </thead>
        <tbody>
        @foreach ($groupAttributes as $groupAttribute)
            <tr>
                <td>{!! $no !!}</td>
                <td>{!! $groupAttribute->id !!}</td>
                <td>{!! $groupAttribute->name !!}</td>
                <td>{!! $groupAttribute->sort_order !!}</td>
                <td>{!! $groupAttribute->created_at !!}</td>
                <td class="text-center">
                    <a class="edit" href="{!! route('admin::attribute_groups::edit', $groupAttribute->id) !!}" title="Edit">
                        <i class="fa fa-pencil-square-o"></i></a>
                    <a class="delete text-warning" href="{!! route('admin::attribute_groups::get::delete', $groupAttribute->id) !!}"
                       title="Are you sure you want to delete?"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
            <?php $no++ ;?>
        @endforeach
        </tbody>
    </table>
    </div><!-- /.box-body -->
    </div><!-- /.box -->
    </div>
    </div>
    <div class="text-center">
        {!! $groupAttributes->links() !!}
    </div>
    @endsection
