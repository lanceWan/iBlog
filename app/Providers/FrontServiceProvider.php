<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use FrontRepository;
class FrontServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            //共享分类数据
            $categories = FrontRepository::getCategories();
            $view->with('categories',$categories);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('FrontRepository', function($app){
            return new \App\Repositories\front\FrontRepository();
        });
    }
}
