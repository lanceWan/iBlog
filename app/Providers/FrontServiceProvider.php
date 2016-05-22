<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use FrontRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\AbstractPaginator;
use App\Repositories\front\PaginationRepository;
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
            $hotArticles = FrontRepository::hotArticle();
            $tags = FrontRepository::tags();
            $view->with(compact(['categories','hotArticles','tags']));

        });

        // 使用自定义分页模板
        Paginator::presenter(function (AbstractPaginator $paginator) {
            return new PaginationRepository($paginator);
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
