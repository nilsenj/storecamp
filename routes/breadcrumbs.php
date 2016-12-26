<?php

// Home
Breadcrumbs::register('/', function($breadcrumbs)
{
    $breadcrumbs->push('Main', route('home::'));
});

// / > About
Breadcrumbs::register('about', function($breadcrumbs)
{
    $breadcrumbs->parent('/');
    $breadcrumbs->push('About', route('about'));
});

// / > Admin
Breadcrumbs::register('admin', function($breadcrumbs)
{
    $breadcrumbs->parent('/');
    $breadcrumbs->push('Admin Panel', route('admin::dashboard'));
});

// / > [Category]
Breadcrumbs::register('categories', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Categories', route('admin::categories::index'));
});

// / > [Logs]
Breadcrumbs::register('LogViewer', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('LogViewer', route('log-viewer::dashboard'));
});

Breadcrumbs::register('LogsDashboard', function($breadcrumbs)
{
    $breadcrumbs->parent('LogViewer');
    $breadcrumbs->push('LogsDashboard', route('log-viewer::logs.list'));
});

Breadcrumbs::register('Logs', function($breadcrumbs)
{
    $breadcrumbs->parent('LogViewer');
    $breadcrumbs->push(Request::segment(3), route('log-viewer::logs.show', Request::segment(3)));
});
// / > [roles]
Breadcrumbs::register('roles', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Roles', route('admin::roles::index'));
});

// / > [permissions]
Breadcrumbs::register('permissions', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Privileges', route('admin::permissions::index'));
});

// / > [permissions]
Breadcrumbs::register('users', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Users', route('admin::users::index'));
});
Breadcrumbs::register('products', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Goods', route('admin::products::index'));
});

// / > [Category] > [Page]
Breadcrumbs::register('page', function($breadcrumbs, $page)
{
    $breadcrumbs->parent('categories', $page->category);
    $breadcrumbs->push($page->title, route('page', $page->id));
});