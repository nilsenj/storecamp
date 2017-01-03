<?php

namespace App\Providers;

use App\Transformers\FileTransformer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Pagination\LengthAwarePaginator::defaultView('partials.paginator');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }
        $this->app->instance('FileTransformer', new FileTransformer());
        $this->app->bind(
            'App\Core\Repositories\CategoryRepository',
            'App\Core\Repositories\CategoryRepositoryEloquent'
        );
        $this->app->bind(
            'App\Core\Repositories\UserRepository',
            'App\Core\Repositories\UserRepositoryEloquent'
        );
        $this->app->bind(
            'App\Core\Repositories\RolesRepository',
            'App\Core\Repositories\RolesRepositoryEloquent'
        );
        $this->app->bind(
            'App\Core\Repositories\ProductsRepository',
            'App\Core\Repositories\ProductsRepositoryEloquent'
        );
        $this->app->bind(
            'App\Core\Repositories\PermissionRepository',
            'App\Core\Repositories\PermissionRepositoryEloquent'
        );
    }
}
