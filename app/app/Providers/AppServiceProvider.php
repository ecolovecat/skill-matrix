<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Skill;
use Illuminate\Support\Facades\View;
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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $user = User::all();
        View::share('users', $user);

        $skill = Skill::all();
        View::share('skills', $skill);
    }
}
