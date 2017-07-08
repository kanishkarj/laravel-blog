<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar',function($view){
            $view->with('tags',\App\Tag::has('posts')->pluck('name'));
            $view->with('archives',\App\Post::archives());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->Singleton(Stripe::class,function(){
            return new Stripe(config('services.stripe.secret'));
        });
    }
}
