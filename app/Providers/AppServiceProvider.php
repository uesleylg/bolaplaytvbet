<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\CarrinhoPalpite;

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
        // Torna $bilhetesCount disponível em todas as views
        View::composer('*', function ($view) {
            $bilhetesCount = 0;

            if (Auth::check()) {
                $bilhetesCount = CarrinhoPalpite::where('usuario_id', Auth::id())->count();
            }

            $view->with('bilhetesCount', $bilhetesCount);
        });
    }
}
