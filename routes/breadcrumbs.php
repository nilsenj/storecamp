<?php

// Home
Breadcrumbs::register('/', function($breadcrumbs)
{
    $breadcrumbs->push('Главная', route('home::'));
});

// / > About
Breadcrumbs::register('about', function($breadcrumbs)
{
    $breadcrumbs->parent('/');
    $breadcrumbs->push('О нас', route('about'));
});

// / > Admin
Breadcrumbs::register('admin', function($breadcrumbs)
{
    $breadcrumbs->parent('/');
    $breadcrumbs->push('Админ-Панель', route('admin::dashboard'));
});

// / > [Category]
Breadcrumbs::register('categories', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Категории', route('admin::categories::index'));
});

// / > [roles]
Breadcrumbs::register('roles', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Роли', route('admin::roles::index'));
});

// / > [permissions]
Breadcrumbs::register('permissions', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Привилегии', route('admin::permissions::index'));
});

// / > [permissions]
Breadcrumbs::register('users', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Пользователи', route('admin::users::index'));
});
Breadcrumbs::register('goods', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Товар', route('admin::goods::index'));
});

// / > [Category] > [Page]
Breadcrumbs::register('page', function($breadcrumbs, $page)
{
    $breadcrumbs->parent('categories', $page->category);
    $breadcrumbs->push($page->title, route('page', $page->id));
});