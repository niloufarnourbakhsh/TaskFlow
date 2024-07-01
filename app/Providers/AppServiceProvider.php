<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Plan;
use App\Policies\PlanPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['Plan.create'],function ($view){
            $view->with('Categories',Category::all());
        });
        Gate::policy(Plan::class,PlanPolicy::class);
    }
}
