<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \Illuminate\Support\Facades\View::composer('layouts.guest', function ($view) {
            $view->with('dynamicBackgrounds', \App\Models\DynamicBackground::where('is_active', true)->get());
            
            // Only query if the table exists to avoid migration errors
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $settings = \App\Models\Setting::whereIn('key', ['bg_animation_speed', 'bg_element_count', 'bg_element_shape'])
                    ->pluck('value', 'key')
                    ->toArray();
            } else {
                $settings = [];
            }
            
            $view->with('bgSettings', $settings);
        });
    }
}
