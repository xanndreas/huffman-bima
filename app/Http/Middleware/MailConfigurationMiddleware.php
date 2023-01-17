<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class MailConfigurationMiddleware {


    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            Config::set('mail.mailers.smtp', Auth::user()->email_configurations);

            $app = App::getInstance();
            $app->register('Illuminate\Mail\MailServiceProvider');
        }

        return $next($request);
    }
}
