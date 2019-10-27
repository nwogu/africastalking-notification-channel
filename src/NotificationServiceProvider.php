<?php

namespace Nwogu\AfricasTalking;

use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{

    /**
     * Register SmoothMigration Services
     * @return void
     */
    public function register()
    {
        $this->app->bind(AfricasTalking::class, function ($app) {
            $at = new AfricasTalking(
                config("services.africastalking.username"),
                config("services.africastalking.key")
            );
            return $at->sms();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

}