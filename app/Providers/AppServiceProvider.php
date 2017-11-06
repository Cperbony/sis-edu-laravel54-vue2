<?php

namespace CAP\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Bootstrapper\Facades\Button;
use Bootstrapper\Facades\Table;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);
}
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Button', Button::class);
        $loader->alias('Table', Table::class);

        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }
}
