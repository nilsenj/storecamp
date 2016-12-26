<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TransformersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $models = [
            'Basket',
            'Item'
        ];
        foreach ($models as $model) {
            $this->app->bind("FBA\\Transformers\\{$model}Transformer");
        }
    }
}
