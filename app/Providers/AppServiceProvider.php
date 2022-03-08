<?php

namespace App\Providers;

use App\Http\Response\JsonResponse;
use App\Services\Payment\Finotech;
use App\Services\Payment\IPayment;
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
        $this->app->bind(IPayment::class, Finotech::class);
        $this->app->bind(IResponse::class, JsonResponse::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
