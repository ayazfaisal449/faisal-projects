<?php

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('smartcall.sms',function()
        {
            return new SmartcallSMS();
        });
    }
}