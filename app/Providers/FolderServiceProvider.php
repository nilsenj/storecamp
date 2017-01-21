<?php

namespace App\Providers;

use App\Core\Models\Folder;
use Illuminate\Support\ServiceProvider;

class FolderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
                "App\\Drivers\\FolderToDb\\Synchronizer",
                "App\\Core\\Repositories\\SynchronizerInterface");

        Folder::created(function ($folder) {
            //setDiskAttribute fix
            if (empty($folder->disk)) {
                $folder->disk = "local";
                $folder->save();
            }
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
