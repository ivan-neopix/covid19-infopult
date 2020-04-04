<?php

namespace App\Providers;

use App\View\Components\PostComponent;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Date;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerBladeComponents();

        Date::use(CarbonImmutable::class);
    }

    private function registerBladeComponents()
    {
        Blade::component('post', PostComponent::class);
    }
}
