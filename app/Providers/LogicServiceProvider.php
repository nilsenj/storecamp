<?php

namespace App\Providers;

use App\Core\Contracts\MediaSystemContract;
use App\Core\Logic\MediaSystem;
use Illuminate\Support\ServiceProvider;

class LogicServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $models = [
            'MediaSystem',
            'CategorySystem',
            'ProductSystem',
            'AttributeGroupSystem'
        ];

        foreach ($models as $repo) {
            $this->app->bind(
                "App\\Core\\Contracts\\{$repo}Contract",
                "App\\Core\\Logic\\{$repo}"
            );
        }
    }
}
