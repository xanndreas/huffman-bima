<?php

namespace App\Providers;

use App\Notifications\Channels\ProviderMailChannel;
use Illuminate\Foundation\Application;
use Illuminate\Mail\Markdown;
use Illuminate\Notifications\ChannelManager;
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

    public function boot()
    {
        //
    }
}
