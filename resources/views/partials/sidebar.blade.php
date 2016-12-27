<?php $user = Auth::user() ? Auth::user() : null; ?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>@if($user){{ $user->name }}@else User Not Available @endif</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i
                            class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Store's Menu</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ route('admin::dashboard') }}"><i class='fa fa-th'></i> <span>Widgets</span></a></li>
            <li><a href="{{ route('admin::categories::index') }}"><i class='fa fa-archive'></i> <span>Categories</span></a>
            </li>
            <li><a href="{{ route('admin::users::index') }}"><i class='fa fa-users'></i> <span>Users</span></a></li>
            <li class="treeview">
                <a href="{{ route('admin::products::index') }}"><i class='fa fa-link'></i> <span>Products</span> <i
                            class="fa fa-good pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin::products::index') }}">List</a></li>
                    <li><a href="{{ route('admin::products::create') }}">Create</a></li>
                    <!--    <li><a href="#">Link in level 2</a></li> -->
                </ul>
            </li>
            <li class="header">Administration</li>
            <li><a href="{{ route('admin::roles::index') }}"><i class='fa  fa-street-view'></i> <span>Access</span></a>
            </li>
            <li class="treeview {{ Route::is('log-viewer::logs.list') || Route::is('log-viewer::logs.show') ? 'active' : '' }}">
                <a href="{{ route('log-viewer::dashboard') }}">
                    <i class="fa fa-bug"></i>
                    <span>LogsViewer</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('log-viewer::dashboard') }}">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('log-viewer::logs.list') }}">
                            <i class="fa fa-archive"></i> Logs
                        </a>
                    </li>
                    <!--    <li><a href="#">Link in level 2</a></li> -->
                </ul>
            </li>


            {{--<li class="nav-item" role="presentation">--}}
            {{--<a role="menuitem" tabindex="-1" class="" href="{!! route('web::admin::dblogs::allUsersAdmin') !!}">--}}
            {{--<i class='text-info fa fa-th'></i>--}}
            {{--<span class="nav-text">Users - DB logs</span></a>--}}
            {{--</li>--}}
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
