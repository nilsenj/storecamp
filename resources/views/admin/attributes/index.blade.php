﻿@extends('admin/app')
<h1>
    @section('breadcrumb')
        {{--{!! Breadcrumbs::render('admin') !!}--}}

        {!! Breadcrumbs::render('users', 'Attributes') !!}
    @endsection
    @section('contentheader_title')

        Amount of Attributes ({!! \App\Core\Models\AttributeGroupDescription::all()->count() !!})
        &middot;
    @endsection
    @section('contentheader_description')
        <b>{!! link_to_route('admin::attributes::create', 'Add New Attribute') !!}</b>
    @endsection
</h1>

@section('main-content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List of Attributes</h3>
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
        <th>Attribute Name</th>
        <th>Attribute Group</th>
        <th>Sort Order</th>
        <th>Created</th>
        <th class="text-center">Actions</th>
        </thead>
        <tbody>
        @foreach ($groupDescriptions as $groupDescription)
            <tr>
                <td>{!! $no !!}</td>
                <td>{!! $groupDescription->name !!}</td>
                <td>{!! $groupDescription->attributesGroup->name !!}</td>
                <td>{!! $groupDescription->sort_order !!}</td>
                <td>{!! $groupDescription->created_at !!}</td>
                <td class="text-center">
                    <a class="edit" href="{!! route('admin::attributes::edit', $groupDescription->id) !!}" title="Edit">
                        <i class="fa fa-pencil-square-o"></i></a>
                    <a class="delete text-warning" href="{!! route('admin::attributes::get::delete', $groupDescription->id) !!}"
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
        {!! $groupDescriptions->links() !!}
    </div>
    @endsection
