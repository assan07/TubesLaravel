<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.mahasiswa.header', function ($view) {
            $user = Auth::user();
            $mahasiswa = null; // Initialize to null
            if ($user) {
                $mahasiswa = $user->mahasiswa;
            }
            $view->with('user', $user)->with('mahasiswa', $mahasiswa);
        });
    }
}
