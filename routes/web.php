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

$this->get('/', [
    'uses' => 'LandingController@index'
]);

//// Authentication routes...
//$this->get('auth/login', 'Auth\AuthController@getLogin');
//$this->post('auth/login', 'Auth\AuthController@postLogin');
//$this->get('auth/logout', 'Auth\AuthController@getLogout');
//
//// Registration routes...
//$this->get('auth/register', 'Auth\AuthController@getRegister');
//$this->post('auth/register', 'Auth\AuthController@postRegister');
//
//// Password reset link request routes...
//$this->get('password/email', 'Auth\PasswordController@getEmail');
//$this->post('password/email', 'Auth\PasswordController@postEmail');
//
//// Password reset routes...
$this->get('password/reset', 'Auth\ResetPasswordController@showResetForm');
$this->get('password/reset/{token}', 'Auth\PasswordController@getReset');
$this->post('password/reset', 'Auth\PasswordController@postReset');

$this->get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home::'
]);
Auth::routes();
$this->get('/logout', ['uses' => 'Auth\LoginController@logout']);

$this->get('/home', 'HomeController@home');
$this->group(/**
 *
 */
    ['prefix' => 'admin', 'as' => 'admin::', 'middleware' => 'auth'], function () {

    $this->get('dashboard', [
        'uses' => 'Admin\AdminController@show',
        'as' => 'dashboard'
    ]);
    $this->get('/', [
        'uses' => 'Admin\AdminController@show',
        'as' => 'dashboard'
    ]);

    $this->get('sales', [
        'uses' => 'Admin\AdminController@sales'
    ]);
    $this->group(['prefix' => 'users', 'as' => 'users::'], function () {

        $this->get('/', [
            'uses' => 'Admin\UsersController@index',
            'as' => 'index'

        ]);
        $this->get('/{id}', [
            'uses' => 'Admin\UsersController@show',
            'as' => 'show'

        ]);

        $this->get('create', [
            'uses' => 'Admin\UsersController@create',
            'as' => 'create'

        ]);

        $this->get('edit/{id}', [
            'uses' => 'Admin\UsersController@edit',
            'as' => 'edit'
        ]);

        $this->put('update/{id}', [
            'uses' => 'Admin\UsersController@update',
            'as' => 'update'
        ])->middleware('shouldLeftAdmin');

        $this->delete('{id}', [
            'uses' => 'Admin\UsersController@destroy',
            'as' => 'delete'
        ])->middleware('notAdmin');

        $this->post('store', [
            'uses' => 'Admin\UsersController@store',
            'as' => 'store'
        ]);

        $this->get('/delete/{id}', [
            'uses' => 'Admin\UsersController@destroy',
            'as' => 'get::delete'
        ])->middleware('notAdmin');
    });
    $this->group(['prefix' => 'media', 'as' => 'media::'], function () {

        $this->get('/index', [
            'uses' => 'Admin\MediaController@index',
            'as' => 'indexs'
        ]);
        $this->get('/index/{disk}/{path?}', [
            'uses' => 'Admin\MediaController@index',
            'as' => 'index'
        ]);

        $this->get('getIndex/{disk}/{path?}/', [
            'uses' => 'Admin\MediaController@getIndex',
            'as' => 'get.index'
        ]);

        $this->post('file_linker/{disk}/{folder?}', [
            'uses' => 'Admin\MediaController@filesLinker',
            'as' => 'file_linker'
        ]);

        $this->get('/getIndexFolders/{disk}/{folder?}', [
            'uses' => 'Admin\MediaController@getIndexFolders',
            'as' => 'get.index.folders'
        ]);

        $this->get('download/{disk}/{id}/{folder}', [
            'uses' => 'Admin\MediaController@download',
            'as' => 'download'
        ]);

        $this->post('/makeDirectory/{disk}', [
            'uses' => 'Admin\MediaController@makeFolder',
            'as' => 'make.directory'
        ]);

        $this->post('/renameDirectory/{disk}', [
            'uses' => 'Admin\MediaController@renameFolder',
            'as' => 'rename.directory'
        ])->middleware('folderLocked');

        $this->post('/renameFile/{disk}', [
            'uses' => 'Admin\MediaController@renameFile',
            'as' => 'rename.file'
        ]);

        $this->delete('{id}', [
            'uses' => 'Admin\MediaController@destroy',
            'as' => 'delete'
        ]);

        $this->post('upload/{disk}', [
            'uses' => 'Admin\MediaController@upload',
            'as' => 'upload'
        ]);

        $this->get('delete/{id}', [
            'uses' => 'Admin\MediaController@destroy',
            'as' => 'get.delete'
        ]);

        $this->get('delete/folder/{disk}/{folder}', [
            'uses' => 'Admin\MediaController@folderDestroy',
            'as' => 'get.folder.delete'
        ])->middleware('folderLocked');

        $this->get('bytag/{disk}/{path?}/{tag}', [
            'uses' => 'Admin\MediaController@getByTag',
            'as' => 'get.tag'
        ]);

    });

    $this->group(['prefix' => 'roles', 'as' => 'roles::'], function () {

        $this->get('/', [
            'uses' => 'Admin\RolesController@index',
            'as' => 'index'

        ]);

        $this->get('create', [
            'uses' => 'Admin\RolesController@create',
            'as' => 'create'

        ]);

        $this->get('edit/{id}', [
            'uses' => 'Admin\RolesController@edit',
            'as' => 'edit'
        ]);

        $this->put('update/{id}', [
            'uses' => 'Admin\RolesController@update',
            'as' => 'update'
        ])->middleware('notDefaultRole');

        $this->delete('{id}', [
            'uses' => 'Admin\RolesController@destroy',
            'as' => 'delete'
        ])->middleware('notDefaultRole');

        $this->post('store', [
            'uses' => 'Admin\RolesController@store',
            'as' => 'store'
        ]);

        $this->get('perms/json', [
            'uses' => 'Admin\RolesController@getPermsJson',
            'as' => 'permissions::json'
        ]);

        $this->get('/delete/{id}', [
            'uses' => 'Admin\RolesController@destroy',
            'as' => 'get::delete'
        ])->middleware('notDefaultRole');

    });
    $this->group(['prefix' => 'products', 'as' => 'products::'], function () {

        $this->get('/', [
            'uses' => 'Admin\ProductsController@index',
            'as' => 'index'

        ]);

        $this->get('show/{id}',[
            'uses' => 'Admin\ProductsController@show',
            'as' => 'show'
        ]);

        $this->get('create', [
            'uses' => 'Admin\ProductsController@create',
            'as' => 'create'

        ]);

        $this->get('edit/{id}', [
            'uses' => 'Admin\ProductsController@edit',
            'as' => 'edit'
        ]);

        $this->put('update/{id}', [
            'uses' => 'Admin\ProductsController@update',
            'as' => 'update'
        ]);

        $this->delete('{id}', [
            'uses' => 'Admin\ProductsController@destroy',
            'as' => 'delete'
        ]);

        $this->post('store', [
            'uses' => 'Admin\ProductsController@store',
            'as' => 'store'
        ]);

        $this->get('/delete/{id}', [
            'uses' => 'Admin\ProductsController@destroy',
            'as' => 'get::delete'
        ]);

    });
    $this->group(['prefix' => 'reviews', 'as' => 'reviews::'], function () {

        $this->get('index',
            [
                'uses' => 'Admin\ProductReviewController@index',
                'as' => 'index'
            ]);

        $this->get('show/{id}',
            [
                'uses' => 'Admin\ProductReviewController@show',
                'as' => 'show'
            ]);

        $this->get('delete/{id}', [
            'uses' => 'Admin\ProductReviewController@delete',
            'as' => 'get.delete'
        ]);

        $this->get('toggle_visibility/{id}', [
            'uses' => 'Admin\ProductReviewController@visibility',
            'as' => 'visibility'
        ]);

        $this->put('reply/review/{id}', [
                'uses' => 'Admin\ProductReviewController@replyFeedback',
                'as' => 'reply'
        ]);

        $this->delete('delete/review/{id}', [
                'uses' => 'Admin\ProductReviewController@delete',
                'as' => 'destroy'
        ]);

        $this->get('create', [
            'uses' => 'Admin\ProductReviewController@create',
            'as' => 'create'
        ]);

        $this->post('store', [
                'uses' => 'Admin\ProductReviewController@store',
                'as' => 'store'
        ]);

        $this->get('markasread/productReview/{feed}', [
            'uses' => 'Admin\ProductReviewController@markAsRead',
            'as' => 'markasread'
        ]);
    });

    $this->group(['prefix' => 'categories', 'as' => 'categories::'], function () {

        $this->get('/', [
            'uses' => 'Admin\CategoriesController@index',
            'as' => 'index'

        ]);

        $this->get('create', [
            'uses' => 'Admin\CategoriesController@create',
            'as' => 'create'
        ]);

        $this->get('edit/{id}', [
            'uses' => 'Admin\CategoriesController@edit',
            'as' => 'edit'
        ]);

        $this->put('update/{id}', [
            'uses' => 'Admin\CategoriesController@update',
            'as' => 'update'
        ]);

        $this->delete('{id}', [
            'uses' => 'Admin\CategoriesController@destroy',
            'as' => 'delete'
        ]);

        $this->get('/delete/{id}', [
            'uses' => 'Admin\CategoriesController@destroy',
            'as' => 'get::delete'
        ]);

        $this->post('store', [
            'uses' => 'Admin\CategoriesController@store',
            'as' => 'store'
        ]);

        $this->get('description/{id}', [
            'uses' => 'Admin\CategoriesController@getDescription',
            'as' => 'description'
        ]);
    });
    $this->group(['prefix' => 'attribute_groups', 'as' => 'attribute_groups::'], function () {

        $this->get('/', [
            'uses' => 'Admin\AttributeGroupsController@index',
            'as' => 'index'

        ]);

        $this->get('create', [
            'uses' => 'Admin\AttributeGroupsController@create',
            'as' => 'create'

        ]);

        $this->get('edit/{id}', [
            'uses' => 'Admin\AttributeGroupsController@edit',
            'as' => 'edit'
        ]);

        $this->put('update/{id}', [
            'uses' => 'Admin\AttributeGroupsController@update',
            'as' => 'update'
        ]);

        $this->delete('{id}', [
            'uses' => 'Admin\AttributeGroupsController@destroy',
            'as' => 'delete'
        ]);

        $this->post('store', [
            'uses' => 'Admin\AttributeGroupsController@store',
            'as' => 'store'
        ]);

        $this->get('/delete/{id}', [
            'uses' => 'Admin\AttributeGroupsController@destroy',
            'as' => 'get::delete'
        ]);

        $this->get('/groups/json', [

            'uses' => 'Admin\AttributeGroupsController@getJson',
            'as' => 'get::json'
        ]);
    });

    $this->group(['prefix' => 'attributes', 'as' => 'attributes::'], function () {

        $this->get('/', [
            'uses' => 'Admin\AttributesController@index',
            'as' => 'index'

        ]);

        $this->get('create', [
            'uses' => 'Admin\AttributesController@create',
            'as' => 'create'

        ]);

        $this->get('edit/{id}', [
            'uses' => 'Admin\AttributesController@edit',
            'as' => 'edit'
        ]);

        $this->put('update/{id}', [
            'uses' => 'Admin\AttributesController@update',
            'as' => 'update'
        ]);

        $this->delete('{id}', [
            'uses' => 'Admin\AttributesController@destroy',
            'as' => 'delete'
        ]);

        $this->post('store', [
            'uses' => 'Admin\AttributesController@store',
            'as' => 'store'
        ]);

        $this->get('/delete/{id}', [
            'uses' => 'Admin\AttributesController@destroy',
            'as' => 'get::delete'
        ]);

        $this->get('/attrs/json', [

            'uses' => 'Admin\AttributesController@getJson',
            'as' => 'get::json'
        ]);
    });
    $this->group(['prefix' => 'subscribers', 'as' => 'subscribers::'], function () {

        $this->get('/', ['uses' => 'Admin\SubscriptionController@index', 'as' => 'index']);

        $this->get('/show/{uid}',
            ['uses' => 'Admin\SubscriptionController@show',
                'as' => 'show'
            ]);

        $this->get('/show_user/{user}',
            ['uses' => 'Admin\SubscriptionController@showUser',
                'as' => 'showUser'
            ]);

        $this->get('/generate/{newsList_id}',
            [
                'uses' => 'Admin\SubscriptionController@showGenerate',
                'as' => 'showGenerate'
            ]);

        $this->get('/tmp_mail/{file}',
            [
                'uses' => 'Admin\SubscriptionController@getTmpMail',
                'as' => 'tmp_mail'
            ]);

        $this->get('/history_mail/{folder}/{filename}',
            [
                'uses' => 'Admin\SubscriptionController@getHistoryTmpMail',
                'as' => 'history_mail'
            ]);

        $this->post('/generate/{uid}/{type}',
            [
                'uses' => 'Admin\SubscriptionController@generate',
                'as' => 'generate'
            ]);
    });
    $this->group(['prefix' => 'mail', 'as' => 'mail::'], function () {

        $this->get('/',
            ['uses' => 'Admin\MailController@index', 'as' => 'index'
            ]);

        $this->get('/show/{uid}',
            ['uses' => 'Admin\MailController@show',
                'as' => 'show'
            ]);

        $this->get('/create',
            ['uses' => 'Admin\MailController@create',
                'as' => 'create'
            ]);

        $this->get('/templates',
            ['uses' => 'Admin\MailController@getTmpMails',
                'as' => 'getTmpMails'
            ]);


    });

    $this->group(['prefix' => 'campaign', 'as' => 'campaign::'], function () {

        $this->get('/', ['uses' => 'Admin\CampaignController@index', 'as' => 'index']);

        $this->get('/show/{uid}',
            ['uses' => 'Admin\CampaignController@show',
                'as' => 'show'
            ]);

        $this->get('/subscriber/{user}',
            ['uses' => 'Admin\CampaignController@subscribers',
                'as' => 'subscriber'
            ]);

        $this->get('/generate/{Campaign}',
            [
                'uses' => 'Admin\CampaignController@show',
                'as' => 'show'
            ]);

        $this->get('/tmp_mail/{file}',
            [
                'uses' => 'Admin\CampaignController@getTmpMail',
                'as' => 'tmp_mail'
            ]);

        $this->get('/history_mail/{folder}/{filename}',
            [
                'uses' => 'Admin\CampaignController@getHistoryTmpMail',
                'as' => 'history_mail'
            ]);

        $this->post('/generate/{uid}/{type}',
            [
                'uses' => 'Admin\CampaignController@generate',
                'as' => 'generate'
            ]);
        $this->get('/groups/json', [

            'uses' => 'Admin\CampaignController@getJson',
            'as' => 'get::json'
        ]);
    });
    $this->group(['prefix' => 'audits', 'as' => 'audits::'], function () {

        $this->get('/{model?}', [
            'uses' => 'Admin\AuditsController@index',
            'as' => 'index'
        ]);

        $this->get('show/{model}/{id}',
            [
                'uses' => 'Admin\AuditsController@show',
                'as' => 'show'
            ]);
    });
});

$this->group(/**
 *
 */
    ['prefix' => '/admin/log-viewer',], function () {

    $this->get('/', [
        'as' => 'log-viewer::dashboard',
        'uses' => 'Admin\LogViewerController@index',
    ]);

    $this->group(['prefix' => '/logs',], function () {
        $this->get('/', [
            'as' => 'log-viewer::logs.list',
            'uses' => 'Admin\LogViewerController@listLogs',
        ]);
        $this->delete('delete', [
            'as' => 'log-viewer::logs.delete',
            'uses' => 'Admin\LogViewerController@delete',
        ]);
    });

    $this->group(['prefix' => '/{date}'], function () {
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
