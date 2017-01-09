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
Route::group(['prefix' => 'admin', 'as' => 'admin::', 'middleware' => 'auth'], function () {

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
    Route::group(['prefix' => 'users', 'as' => 'users::'], function () {

        Route::get('/', [
            'uses' => 'UsersController@index',
            'as' => 'index'

        ]);
        Route::get('create', [
            'uses' => 'UsersController@create',
            'as' => 'create'

        ]);
        Route::get('edit/{id}', [
            'uses' => 'UsersController@edit',
            'as' => 'edit'
        ]);
        Route::put('update/{id}', [
            'uses' => 'UsersController@update',
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
    Route::group(['prefix' => 'media', 'as' => 'media::'], function () {

        Route::get('/{path?}', [
            'uses' => 'MediaController@index',
            'as' => 'index'
        ]);

        Route::get('/getIndex/{path?}', [
            'uses' => 'MediaController@getIndex',
            'as' => 'get.index'
        ]);

        Route::get('/getIndexFolders/{folder?}', [
            'uses' => 'MediaController@getIndexFolders',
            'as' => 'get.index.folders'
        ]);

        Route::get('getDirectories', [
            'uses' => 'MediaController@getMediaFolders',
            'as' => 'directories'
        ]);

        Route::get('download/{id}/{folder}', [
            'uses' => 'MediaController@download',
            'as' => 'download'
        ]);

        Route::post('/makeDirectory', [
            'uses' => 'MediaController@makeFolder',
            'as' => 'make.directory'
        ]);

        Route::post('/renameDirectory', [
            'uses' => 'MediaController@renameFolder',
            'as' => 'rename.directory'
        ]);

        Route::post('/renameFile', [
            'uses' => 'MediaController@renameFile',
            'as' => 'rename.file'
        ]);

        Route::delete('{id}', [
            'uses' => 'MediaController@destroy',
            'as' => 'delete'
        ]);

        Route::post('upload', [
            'uses' => 'MediaController@upload',
            'as' => 'upload'
        ]);

        Route::get('delete/{id}', [
            'uses' => 'MediaController@destroy',
            'as' => 'get.delete'
        ]);

        Route::get('delete/folder/{folder}', [
            'uses' => 'MediaController@folderDestroy',
            'as' => 'get.folder.delete'
        ]);

        Route::get('bytag/{path?}/{tag}', [
            'uses' => 'MediaController@getByTag',
            'as' => 'get.tag'
        ]);

        Route::delete('{id}', [
            'uses' => 'MediaController@destroy',
            'as' => 'delete'
        ]);

    });

    Route::group(['prefix' => 'roles', 'as' => 'roles::'], function () {

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
    Route::group(['prefix' => 'products', 'as' => 'products::'], function () {

        Route::get('/', [
            'uses' => 'ProductsController@index',
            'as' => 'index'

        ]);
        Route::get('create', [
            'uses' => 'ProductsController@create',
            'as' => 'create'

        ]);
        Route::get('edit/{id}', [
            'uses' => 'ProductsController@edit',
            'as' => 'edit'
        ]);
        Route::put('update/{id}', [
            'uses' => 'ProductsController@update',
            'as' => 'update'
        ]);
        Route::delete('{id}', [
            'uses' => 'ProductsController@destroy',
            'as' => 'delete'
        ]);
        Route::post('store', [
            'uses' => 'ProductsController@store',
            'as' => 'store'
        ]);

    });

    Route::group(['prefix' => 'categories', 'as' => 'categories::'], function () {
        Route::get('/', [
            'uses' => 'CategoriesController@index',
            'as' => 'index'

        ]);
        Route::get('create', [
            'uses' => 'CategoriesController@create',
            'as' => 'create'
        ]);
        Route::get('edit/{id}', [
            'uses' => 'CategoriesController@edit',
            'as' => 'edit'
        ]);
        Route::put('update/{id}', [
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
        Route::get('description/{id}', [
            'uses' => 'CategoriesController@getDescription',
            'as' => 'description'
        ]);
    });


});

Route::group(
    ['prefix' => '/admin/log-viewer',], function () {
    Route::get('/', [
        'as' => 'log-viewer::dashboard',
        'uses' => 'LogViewerController@index',
    ]);
    Route::group(
        ['prefix' => '/logs',], function () {
        $this->get('/', [
            'as' => 'log-viewer::logs.list',
            'uses' => 'LogViewerController@listLogs',
        ]);

        $this->delete('delete', [
            'as' => 'log-viewer::logs.delete',
            'uses' => 'LogViewerController@delete',
        ]);

    });
    Route::group(['prefix' => '/{date}'], function () {
        $this->get('/', [
            'as' => 'log-viewer::logs.show',
            'uses' => 'LogViewerController@show',
        ]);

        $this->get('download', [
            'as' => 'log-viewer::logs.download',
            'uses' => 'LogViewerController@download',
        ]);
        $this->get('{level}', [
            'as' => 'log-viewer::logs.filter',
            'uses' => 'LogViewerController@showByLevel',
        ]);
    });
});
