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
        'uses' => 'Admin\AdminController@show',
        'as' => 'dashboard'
    ]);
    Route::get('/', [
        'uses' => 'Admin\AdminController@show',
        'as' => 'dashboard'
    ]);

    Route::get('sales', [
        'uses' => 'Admin\AdminController@sales'
    ]);
    Route::group(['prefix' => 'users', 'as' => 'users::'], function () {

        Route::get('/', [
            'uses' => 'Admin\UsersController@index',
            'as' => 'index'

        ]);
        Route::get('/{id}', [
            'uses' => 'Admin\UsersController@show',
            'as' => 'show'

        ]);


        Route::get('create', [
            'uses' => 'Admin\UsersController@create',
            'as' => 'create'

        ]);

        Route::get('edit/{id}', [
            'uses' => 'Admin\UsersController@edit',
            'as' => 'edit'
        ]);

        Route::put('update/{id}', [
            'uses' => 'Admin\UsersController@update',
            'as' => 'update'
        ])->middleware('shouldLeftAdmin');

        Route::delete('{id}', [
            'uses' => 'Admin\UsersController@destroy',
            'as' => 'delete'
        ])->middleware('notAdmin');

        Route::post('store', [
            'uses' => 'Admin\UsersController@store',
            'as' => 'store'
        ]);

        Route::get('/delete/{id}', [
            'uses' => 'Admin\UsersController@destroy',
            'as' => 'get::delete'
        ])->middleware('notAdmin');
    });
    Route::group(['prefix' => 'media', 'as' => 'media::'], function () {

        Route::get('/{path?}', [
            'uses' => 'Admin\MediaController@index',
            'as' => 'index'
        ]);

        Route::get('/getIndex/{path?}', [
            'uses' => 'Admin\MediaController@getIndex',
            'as' => 'get.index'
        ]);

        Route::get('/getIndexFolders/{folder?}', [
            'uses' => 'Admin\MediaController@getIndexFolders',
            'as' => 'get.index.folders'
        ]);

        Route::get('getDirectories', [
            'uses' => 'Admin\MediaController@getMediaFolders',
            'as' => 'directories'
        ]);

        Route::get('download/{id}/{folder}', [
            'uses' => 'Admin\MediaController@download',
            'as' => 'download'
        ]);

        Route::post('/makeDirectory', [
            'uses' => 'Admin\MediaController@makeFolder',
            'as' => 'make.directory'
        ]);

        Route::post('/renameDirectory', [
            'uses' => 'Admin\MediaController@renameFolder',
            'as' => 'rename.directory'
        ]);

        Route::post('/renameFile', [
            'uses' => 'Admin\MediaController@renameFile',
            'as' => 'rename.file'
        ]);

        Route::delete('{id}', [
            'uses' => 'Admin\MediaController@destroy',
            'as' => 'delete'
        ]);

        Route::post('upload', [
            'uses' => 'Admin\MediaController@upload',
            'as' => 'upload'
        ]);

        Route::get('delete/{id}', [
            'uses' => 'Admin\MediaController@destroy',
            'as' => 'get.delete'
        ]);

        Route::get('delete/folder/{folder}', [
            'uses' => 'Admin\MediaController@folderDestroy',
            'as' => 'get.folder.delete'
        ]);

        Route::get('bytag/{path?}/{tag}', [
            'uses' => 'Admin\MediaController@getByTag',
            'as' => 'get.tag'
        ]);

        Route::delete('{id}', [
            'uses' => 'Admin\MediaController@destroy',
            'as' => 'delete'
        ]);

    });

    Route::group(['prefix' => 'roles', 'as' => 'roles::'], function () {

        Route::get('/', [
            'uses' => 'Admin\RolesController@index',
            'as' => 'index'

        ]);
        Route::get('create', [
            'uses' => 'Admin\RolesController@create',
            'as' => 'create'

        ]);
        Route::get('edit/{id}', [
            'uses' => 'Admin\RolesController@edit',
            'as' => 'edit'
        ]);

        Route::put('update/{id}', [
            'uses' => 'Admin\RolesController@update',
            'as' => 'update'
        ])->middleware('notDefaultRole');

        Route::delete('{id}', [
            'uses' => 'Admin\RolesController@destroy',
            'as' => 'delete'
        ])->middleware('notDefaultRole');

        Route::post('store', [
            'uses' => 'Admin\RolesController@store',
            'as' => 'store'
        ]);

        Route::get('perms/json', [
            'uses' => 'Admin\RolesController@getPermsJson',
            'as' => 'permissions::json'
        ]);

        Route::get('/delete/{id}', [
            'uses' => 'Admin\RolesController@destroy',
            'as' => 'get::delete'
        ])->middleware('notDefaultRole');

    });
    Route::group(['prefix' => 'products', 'as' => 'products::'], function () {

        Route::get('/', [
            'uses' => 'Admin\ProductsController@index',
            'as' => 'index'

        ]);
        Route::get('show/{id}',
            [
                'uses' => 'Admin\ProductsController@show',
                'as' => 'show'
            ]);

        Route::get('create', [
            'uses' => 'Admin\ProductsController@create',
            'as' => 'create'

        ]);
        Route::get('edit/{id}', [
            'uses' => 'Admin\ProductsController@edit',
            'as' => 'edit'
        ]);
        Route::put('update/{id}', [
            'uses' => 'Admin\ProductsController@update',
            'as' => 'update'
        ]);
        Route::delete('{id}', [
            'uses' => 'Admin\ProductsController@destroy',
            'as' => 'delete'
        ]);
        Route::post('store', [
            'uses' => 'Admin\ProductsController@store',
            'as' => 'store'
        ]);

        Route::get('/delete/{id}', [
            'uses' => 'Admin\ProductsController@destroy',
            'as' => 'get::delete'
        ]);

    });
    Route::group(['prefix' => 'reviews', 'as' => 'reviews::'], function () {

        Route::get('index',
            [
                'uses' => 'Admin\ProductReviewController@index',
                'as' => 'index'
            ]);

        Route::get('show/{id}',
            [
                'uses' => 'Admin\ProductReviewController@show',
                'as' => 'show'
            ]);

//            Route::get('create/feedback',
//                [
//                    'uses' => 'Admin\ProductReviewController@create',
//                    'as' => 'createFeedback'
//                ]);
//            Route::get('edit/feedback/{id}',
//                [
//                    'uses' => 'Admin\ProductReviewController@edit',
//                    'as' => 'editFeedback'
//                ]);
//
//            Route::patch('update/feedback/{id}',
//                [
//                    'uses' => 'Admin\ProductReviewController@update',
//                    'as' => 'updateFeedback'
//                ]);

        Route::put('reply/review/{id}',
            [
                'uses' => 'Admin\ProductReviewController@replyFeedback',
                'as' => 'reply'

            ]);

        Route::delete('delete/review/{id}',
            [
                'uses' => 'Admin\ProductReviewController@destroy',
                'as' => 'destroy'
            ]);

        Route::post('store/review',
            [
                'uses' => 'Admin\ProductReviewController@store',
                'as' => 'store'
            ]);

        Route::get('markasread/productReview/{feed}', [
            'uses' => 'Admin\ProductReviewController@markAsRead',
            'as' => 'markasread'
        ]);
    });

    Route::group(['prefix' => 'categories', 'as' => 'categories::'], function () {
        Route::get('/', [
            'uses' => 'Admin\CategoriesController@index',
            'as' => 'index'

        ]);
        Route::get('create', [
            'uses' => 'Admin\CategoriesController@create',
            'as' => 'create'
        ]);
        Route::get('edit/{id}', [
            'uses' => 'Admin\CategoriesController@edit',
            'as' => 'edit'
        ]);
        Route::put('update/{id}', [
            'uses' => 'Admin\CategoriesController@update',
            'as' => 'update'
        ]);
        Route::delete('{id}', [
            'uses' => 'Admin\CategoriesController@destroy',
            'as' => 'delete'
        ]);
        Route::get('/delete/{id}', [
            'uses' => 'Admin\CategoriesController@destroy',
            'as' => 'get::delete'
        ]);
        Route::post('store', [
            'uses' => 'Admin\CategoriesController@store',
            'as' => 'store'
        ]);
        Route::get('description/{id}', [
            'uses' => 'Admin\CategoriesController@getDescription',
            'as' => 'description'
        ]);
    });
    Route::group(['prefix' => 'attribute_groups', 'as' => 'attribute_groups::'], function () {

        Route::get('/', [
            'uses' => 'Admin\AttributeGroupsController@index',
            'as' => 'index'

        ]);
        Route::get('create', [
            'uses' => 'Admin\AttributeGroupsController@create',
            'as' => 'create'

        ]);
        Route::get('edit/{id}', [
            'uses' => 'AttributeGroupsController@edit',
            'as' => 'edit'
        ]);
        Route::put('update/{id}', [
            'uses' => 'Admin\AttributeGroupsController@update',
            'as' => 'update'
        ]);
        Route::delete('{id}', [
            'uses' => 'Admin\AttributeGroupsController@destroy',
            'as' => 'delete'
        ]);
        Route::post('store', [
            'uses' => 'Admin\AttributeGroupsController@store',
            'as' => 'store'
        ]);

        Route::get('/delete/{id}', [
            'uses' => 'Admin\AttributeGroupsController@destroy',
            'as' => 'get::delete'
        ]);

        Route::get('/groups/json', [

            'uses' => 'Admin\AttributeGroupsController@getJson',
            'as' => 'get::json'
        ]);
    });

    Route::group(['prefix' => 'attributes', 'as' => 'attributes::'], function () {

        Route::get('/', [
            'uses' => 'Admin\AttributesController@index',
            'as' => 'index'

        ]);
        Route::get('create', [
            'uses' => 'Admin\AttributesController@create',
            'as' => 'create'

        ]);
        Route::get('edit/{id}', [
            'uses' => 'Admin\AttributesController@edit',
            'as' => 'edit'
        ]);
        Route::put('update/{id}', [
            'uses' => 'Admin\AttributesController@update',
            'as' => 'update'
        ]);
        Route::delete('{id}', [
            'uses' => 'Admin\AttributesController@destroy',
            'as' => 'delete'
        ]);
        Route::post('store', [
            'uses' => 'Admin\AttributesController@store',
            'as' => 'store'
        ]);
        Route::get('/delete/{id}', [
            'uses' => 'Admin\AttributesController@destroy',
            'as' => 'get::delete'
        ]);
        Route::get('/attrs/json', [

            'uses' => 'Admin\AttributesController@getJson',
            'as' => 'get::json'
        ]);
    });
    Route::group(['prefix' => 'newsletter', 'as' => 'newsletter::'], function () {

        Route::get('/', ['uses' => 'Admin\SubscriptionController@index', 'as' => 'subscribe::index']);

        Route::get('/show/{uid}',
            ['uses' => 'Admin\SubscriptionController@show',
                'as' => 'subscribe::show'
            ]);
        Route::get('/show_user/{user}',
            ['uses' => 'Admin\SubscriptionController@showUser',
                'as' => 'subscribe::showUser'
            ]);

        Route::get('/generate/{newsList_id}',
            [
                'uses' => 'Admin\SubscriptionController@showGenerate',
                'as' => 'subscribe::showGenerate'
            ]);
        Route::get('/tmp_mail/{file}',
            [
                'uses' => 'Admin\SubscriptionController@getTmpMail',
                'as' => 'subscribe::tmp_mail'
            ]);

        Route::get('/history_mail/{folder}/{filename}',
            [
                'uses' => 'Admin\SubscriptionController@getHistoryTmpMail',
                'as' => 'subscribe::history_mail'
            ]);

        Route::post('/generate/{uid}/{type}',
            [
                'uses' => 'Admin\SubscriptionController@generate',
                'as' => 'subscribe::generate'
            ]);
    });

});

Route::group(
    ['prefix' => '/admin/log-viewer',], function () {
    Route::get('/', [
        'as' => 'log-viewer::dashboard',
        'uses' => 'Admin\LogViewerController@index',
    ]);
    Route::group(
        ['prefix' => '/logs',], function () {
        $this->get('/', [
            'as' => 'log-viewer::logs.list',
            'uses' => 'Admin\LogViewerController@listLogs',
        ]);

        $this->delete('delete', [
            'as' => 'log-viewer::logs.delete',
            'uses' => 'Admin\LogViewerController@delete',
        ]);
    });
    Route::group(['prefix' => '/{date}'], function () {
        $this->get('/', [
            'as' => 'log-viewer::logs.show',
            'uses' => 'Admin\LogViewerController@show',
        ]);

        $this->get('download', [
            'as' => 'log-viewer::logs.download',
            'uses' => 'Admin\LogViewerController@download',
        ]);
        $this->get('{level}', [
            'as' => 'log-viewer::logs.filter',
            'uses' => 'Admin\LogViewerController@showByLevel',
        ]);
    });
});
