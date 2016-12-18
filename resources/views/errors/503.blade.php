@extends('app')

@section('htmlheader_title')
    Сервис не доступен
@endsection

@section('contentheader_title')
    503 Код ошибки страницы
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')

    <div class="error-page">
        <h2 class="headline text-red">530</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Упс! Что то пошло не так.</h3>
            <p>
                Мы работаем над исправлением ошибки сейчас.
                В то же самое время  вы можете <a href='{{ url('/admin/dashboard') }}'>вернуться на главную админки</a> или попробуйте использовать наш поиск.            </p>
            <form class='search-form'>
                <div class='input-group'>
                    <input type="text" name="search" class='form-control' placeholder="Search"/>
                    <div class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fa fa-search"></i></button>
                    </div>
                </div><!-- /.input-group -->
            </form>
        </div>
    </div><!-- /.error-page -->
@endsection