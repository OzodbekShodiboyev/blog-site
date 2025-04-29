<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use App\View\Composers\FooterComposer;
use App\View\Composers\NavbarComposer;
use App\View\Composers\TopbarComposer;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer('partials.topbar', TopbarComposer::class);
        View::composer('partials.navbar', NavbarComposer::class);
        View::composer('partials.footer', FooterComposer::class);
    }
}
