<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Store's Menu</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ route('admin::dashboard') }}"><i class='fa fa-th'></i> <span>Widgets</span></a></li>
            <li><a href="{{ route('admin::categories::index') }}"><i class='fa fa-archive'></i> <span>Categories</span></a></li>
            <li><a href="{{ route('admin::roles::index') }}"><i class='fa  fa-street-view'></i> <span>Roles</span></a></li>
            <li><a href="{{ route('admin::permissions::index') }}"><i class='fa fa-user-md'></i> <span>Privileges</span></a></li>
            <li><a href="{{ route('admin::users::index') }}"><i class='fa fa-users'></i> <span>Users</span></a></li>
            <li class="treeview">
                <a href="{{ route('admin::goods::index') }}"><i class='fa fa-link'></i> <span>Goods</span> <i class="fa fa-good pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin::goods::index') }}">List</a></li>
                    <li><a href="{{ route('admin::goods::create') }}">Create</a></li>
                <!--    <li><a href="#">Link in level 2</a></li> -->
                </ul>
            </li>
            <li class="nav-header" role="presentation">Logs management</li>
            <li class="nav-item" role="presentation"><a role="menuitem" tabindex="-1"
                                                        href="{{ route('log-viewer::dashboard') }}">
                    <i class='text-danger fa fa-bug'></i>
                    <span class="nav-text">LogViewer</span> </a></li>
            {{--<li class="nav-item" role="presentation">--}}
                {{--<a role="menuitem" tabindex="-1" class="" href="{!! route('web::admin::dblogs::allUsersAdmin') !!}">--}}
                    {{--<i class='text-info fa fa-th'></i>--}}
                    {{--<span class="nav-text">Users - DB logs</span></a>--}}
            {{--</li>--}}
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
