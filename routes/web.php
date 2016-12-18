<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    'uses' => 'LandingController@index'
]);

//// Authentication routes...
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');
//
//// Registration routes...
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');
//
//// Password reset link request routes...
//Route::get('password/email', 'Auth\PasswordController@getEmail');
//Route::post('password/email', 'Auth\PasswordController@postEmail');
//
//// Password reset routes...
//Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
//Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('/', [
    'uses' => 'PagesController@index',
    'as' => 'home::'
]);
Auth::routes();
Route::get('/logout', ['uses' => 'Auth\LoginController@logout']);

Route::get('/home', 'HomeController@index');
Route::group(['prefix' => 'admin', 'as' => 'admin::', 'middleware' => 'auth'], function(){

    Route::get('dashboard', [
        'uses' => 'AdminController@show',
        'as' => 'dashboard'
    ]);
    Route::get('/', [
        'uses' => 'AdminController@show',
        'as' => 'dashboard'
    ]);

    Route::get('sales', [
        'uses' => 'AdminController@sales'
    ]);
    Route::group(['prefix' => 'users', 'as' => 'users::'], function() {

        Route::get('/', [
            'uses' => 'UsersController@index',
            'as' => 'index'

        ]);
        Route::get('create', [
            'uses' => 'UsersController@create',
            'as' => 'create'

        ]);
        Route::get('edit/{slug}', [
            'uses' => 'UsersController@edit',
            'as' => 'edit'
        ]);
        Route::put('update/{slug}', [
            'uses' => 'UsersController@update',
            'middleware' => 'shouldBeUnique',
            'as' => 'update'
        ]);
        Route::delete('{id}', [
            'uses' => 'UsersController@destroy',
            'as' => 'delete'
        ]);
        Route::post('store', [
            'uses' => 'UsersController@store',
            'as' => 'store'
        ]);

    });

    Route::group(['prefix' => 'roles', 'as' => 'roles::'], function(){

        Route::get('/', [
            'uses' => 'RolesController@index',
            'as' => 'index'

        ]);
        Route::get('create', [
            'uses' => 'RolesController@create',
            'as' => 'create'

        ]);
        Route::get('edit/{id}', [
            'uses' => 'RolesController@edit',
            'as' => 'edit'
        ]);
        Route::put('update/{id}', [
            'uses' => 'RolesController@update',
            'as' => 'update'
        ]);
        Route::delete('{id}', [
            'uses' => 'RolesController@destroy',
            'as' => 'delete'
        ]);
        Route::post('store', [
            'uses' => 'RolesController@store',
            'as' => 'store'
        ]);

    });
    Route::group(['prefix' => 'goods', 'as' => 'goods::'], function(){

        Route::get('/', [
            'uses' => 'GoodsController@index',
            'as' => 'index'

        ]);
        Route::get('create', [
            'uses' => 'GoodsController@create',
            'as' => 'create'

        ]);
        Route::get('edit/{id}', [
            'uses' => 'GoodsController@edit',
            'as' => 'edit'
        ]);
        Route::put('update/{id}', [
            'uses' => 'GoodsController@update',
            'as' => 'update'
        ]);
        Route::delete('{id}', [
            'uses' => 'GoodsController@destroy',
            'as' => 'delete'
        ]);
        Route::post('store', [
            'uses' => 'GoodsController@store',
            'as' => 'store'
        ]);

    });

    Route::group(['prefix' => 'permissions', 'as' => 'permissions::'], function(){

        Route::get('/', [
            'uses' => 'PermissionsController@index',
            'as' => 'index'

        ]);
        Route::get('create', [
            'uses' => 'PermissionsController@create',
            'as' => 'create'

        ]);
        Route::get('edit/{slug}', [
            'uses' => 'PermissionsController@edit',
            'as' => 'edit'
        ]);
        Route::put('update/{slug}', [
            'uses' => 'PermissionsController@update',
            'as' => 'update'
        ]);
        Route::delete('{id}', [
            'uses' => 'PermissionsController@destroy',
            'as' => 'delete'
        ]);
        Route::post('store', [
            'uses' => 'PermissionsController@store',
            'as' => 'store'
        ]);

    });

    Route::group(['prefix' => 'categories', 'as' => 'categories::'], function(){
        Route::get('/', [
            'uses' => 'CategoriesController@index',
            'as' => 'index'

        ]);
        Route::get('create', [
            'uses' => 'CategoriesController@create',
            'as' => 'create'
        ]);
        Route::get('edit/{slug}', [
            'uses' => 'CategoriesController@edit',
            'as' => 'edit'
        ]);
        Route::put('update/{slug}', [
            'uses' => 'CategoriesController@update',
            'as' => 'update'
        ]);
        Route::delete('{id}', [
            'uses' => 'CategoriesController@destroy',
            'as' => 'delete'
        ]);
        Route::get('/delete/{id}', [
            'uses' => 'CategoriesController@destroy',
            'as' => 'get::delete'
        ]);
        Route::post('store', [
            'uses' => 'CategoriesController@store',
            'as' => 'store'
        ]);
    });



});
