<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\MainController;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        View::composer('*', function($view)
        {
            $ctl = new MainController;
            $navbars = $ctl->GetMenu();
            $links = $ctl->GetLink();
            $sosmed = $ctl->GetSosmed();
            $kontens = $ctl->getHal();
            //$banner = $ctl->getBanner();
            $view->with('navbars', $navbars);
            $view->with('kontens', $kontens);
            $view->with('links', $links);
            $view->with('sosmed', $sosmed);
            //$view->with('banner', $banner);
        });
    }
}
