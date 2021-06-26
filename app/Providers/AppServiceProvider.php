<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Book;
use App\OrderDetail;
use App\Observers\BookObserver;
use App\Observers\OrderDetailObserver;
use Illuminate\Routing\UrlGenerator;

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
    public function boot(UrlGenerator $url)
    {
        if(env('REDIRECT_HTTPS'))
		{
			$url->forceScheme('https');
		}
        //Book::observe(BookObserver::class);
    }
}
