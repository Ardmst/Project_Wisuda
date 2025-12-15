<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Factory;   // <--- Posisinya harus di sini (di luar class)
use Faker\Generator; // <--- Posisinya harus di sini (di luar class)

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Kode ini yang benar (cukup ini saja di dalam fungsi)
        $this->app->singleton(Generator::class, function () {
            return Factory::create('id_ID');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}