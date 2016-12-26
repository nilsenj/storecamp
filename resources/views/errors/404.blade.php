@extends('admin/app')
<h1>
    @section('contentheader_title')
        Sorry Nothing Found
    @endsection
    @section('contentheader_description')
        Please try another link!!!
    @endsection
</h1>
@section('main-content')
<div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> OOps! Page Not Found.</h3>
        <p>
            We could't find anything.
            At the same time you can go <a href='{{ url('/admin/dashboard') }}'>back to admin panel</a> Or Try our search.
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