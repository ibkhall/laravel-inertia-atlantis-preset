<?php

namespace App\Providers;

use App\Models\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Inertia::share('auth.user', function () {
            if (Auth::user()) {
                return [
                    'id' => Auth::user()->id,
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'avatar' => Auth::user()->avatar
                ];
            }
        });

        Inertia::share('config', function () {
            return Config::first();
        });

        Inertia::share([
            'errors' => function () {
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessages()
                    : (object) [];
            },
        ]);

        Inertia::share('flashes', function () {
            return [
                'success' => Session::has('success') ? Session::get('success') : null,
                'info' => Session::has('info') ? Session::get('info') : null,
                'danger' => Session::has('danger') ? Session::get('danger') : null,
                'warning' => Session::has('warning') ? Session::get('warning') : null,
            ];
        });
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
