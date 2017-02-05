<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider
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
        $this->commands('App\Core\Generators\Commands\RepositoryCommand');
        $this->commands('App\Core\Generators\Commands\TransformerCommand');
        $this->commands('App\Core\Generators\Commands\PresenterCommand');
        $this->commands('App\Core\Generators\Commands\EntityCommand');
        $this->commands('App\Core\Generators\Commands\cControllerCommand');
    }
}
