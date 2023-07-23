<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use App\Core\PayStar\PayStar;

class PayStarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('paystar', PayStar::class);
        $loader = AliasLoader::getInstance();
        $loader->alias('Paystar', \App\Core\PayStar\Facade\Paystar::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
