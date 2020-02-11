<?php

namespace App\Providers;

use App\Contracts\IScraper;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpClient\HttpClient;
use App\Services\Scraper;
use Goutte\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IScraper::class, function($app) {
            return new Scraper(new Client(HttpClient::create()));
        });
    }
}
