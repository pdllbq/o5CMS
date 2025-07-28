<?php

use Illuminate\Support\Facades\Route;

if(!function_exists('registerRoutes')){ //for tests
    function registerRoutes($prefix = '') {
        $groupOptions = ['middleware' => ['locale']];
        
        if (!empty($prefix)) {
            $locales = config('app.locales', 'en');
            $locales = str_replace(',', '|', $locales);
            
            $groupOptions['prefix'] = $prefix;
            $groupOptions['where'] = ['locale' => $locales];

            Route::redirect('/', '/'.config('app.locale', 'en'), 301);
        }
        
        Route::group($groupOptions, function () use ($prefix) {

            Route::get('/', function () {
                return view('welcome');
            })->name('home');
            
            Route::get('/about', function () {
                return view('about');
            })->name('about');
        });
    }
}

if (config('app.multilang', false)) {
    registerRoutes('{locale}');
} else {
    registerRoutes();
}