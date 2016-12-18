@extends('admin/app')
<h1>
    @section('breadcrumb')
        {{--{!! Breadcrumbs::render('admin') !!}--}}

        {!! Breadcrumbs::render('categories', 'Категории') !!}
    @endsection
@section('contentheader_title')

        Все категории ({!! \App\Core\Entities\Category::all()->count() !!})
        &middot;
    @endsection
@section('contentheader_description')
        <b>{!! link_to_route('admin::categories::create', 'Добавить новую') !!}</b>
@endsection
</h1>

@section('main-content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Список категорий товара</h3>
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
                        <th>Название</th>
                        <th>Slug</th>
                        <th>Описание</th>
                        <th>Когда Создана</th>
                        <th class="text-center">Действия</th>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            @include('admin.categories.category', [$category, $no])
                        @endforeach
                        </tbody>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

    <div class="text-center">
        {!! $categories->links() !!}
        {{--{!! pagination_links($categories) !!}--}}
    </div>
@endsection