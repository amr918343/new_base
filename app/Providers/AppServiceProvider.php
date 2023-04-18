<?php

namespace App\Providers;

use App\Repositories\Classes\EloquentRepository;
use App\Repositories\Interfaces\IORMRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // foreach (glob(app_path() . '/Models/*.php') as $file) {
        //     $model = basename($file, '.php');
        //     $this->app->bind(
        //         "App\Repositories\\{$model}Repository",
        //         "App\Repositories\EloquentRepository"
        //     );
        // }

        $this->app->bind(IORMRepository::class, EloquentRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
