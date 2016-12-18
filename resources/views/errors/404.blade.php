@extends('app')

@section('htmlheader_title')
    Страница не найдена
@endsection

@section('contentheader_title')
    404 Код ошибки страницы
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')

<div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Упс! Страница не найдена.</h3>
        <p>
            Мы не смогли ничего найти по заданному запросу.
            В то же самое время  вы можете <a href='{{ url('/admin/dashboard') }}'>вернуться на главную админки</a> или попробуйте использовать наш поиск.
        </p>
        <form class='search-form'>
            <div class='input-group'>
                <input type="text" name="search" class='form-control' placeholder="Search"/>
                <div class="input-group-btn">
                    <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
                </div>
            </div><!-- /.input-group -->
        </form>
    </div><!-- /.error-content -->
</div><!-- /.error-page -->
@endsection