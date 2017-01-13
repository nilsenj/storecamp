﻿@extends('admin/app')
<h1>
    @section('breadcrumb')
        {!! Breadcrumbs::render('users', 'Users') !!}
    @endsection
    @include('admin.partial._contentheader_title', [$model = $users, $message = "Amount of Users"])
    @section('contentheader_description')
        <b>{!! link_to_route('admin::users::create', 'Add New User') !!}</b>
    @endsection
</h1>

@section('main-content')
    @if(isset($search))
        @include('admin::users.search-form')
    @endif
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List of Users</h3>
                    <div class="box-tools">
                        @include('admin.partial._box_search')
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th>Role</th>
                        <th class="text-center">Actions</th>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{!! $no !!}</td>
                                <td>{!! $user->name !!}</td>
                                <td>{!! $user->email !!}</td>
                                <td>{!! $user->created_at !!}</td>
                                <td>
                                    @foreach ($user->roles()->get() as $role)
                                        {{ $role->name }}
                                    @endforeach</td>
                                <td class="text-center">
                                    <a href="{!! route('admin::users::edit', $user->id) !!}">Edit</a>
                                    &middot;
                                    {{--@include('admin::partials.modal', ['data' => $user, 'name' => 'users'])--}}
                                </td>
                            </tr>
                            <?php $no++;?>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <div class="text-center">
        {!! $users->links() !!}
    </div>
@endsection
