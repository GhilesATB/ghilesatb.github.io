<?php

namespace App\Providers;

use App\Services\DataSource\ExternalApiDataSourceInterface;
use App\Services\DataSource\MediaDataSource;
use App\Services\MediaService;
use App\Services\MediaServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ExternalApiDataSourceInterface::class, function () {
            return new MediaDataSource(Config('externalapidataprovider.source_url'));
        });

        $this->app->bind(MediaServiceInterface::class, function () {
            return new MediaService(new MediaDataSource(Config('externalapidataprovider.source_url')));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
