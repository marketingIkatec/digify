<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Page;

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
    public function boot(): void
    {
        // Envia dados para TODAS as views
        View::composer('*', function ($view) {
            $settings = Setting::all();

            $config = [];
            foreach ($settings as $item) {
                $config[$item['key']] = $item['value'];
            }

            $view->with('config', $config);

            $page_id = 0;
                      
            $menuPagina = Page::where('status', 1)
                              ->where('page_id', $page_id)
                              ->where('ordem', '>', 0)
                              ->orderBy('ordem')->with('childrenRecursive')
                              ->get();
            

            $view->with('menuPagina', $menuPagina);
        });
    }
}
