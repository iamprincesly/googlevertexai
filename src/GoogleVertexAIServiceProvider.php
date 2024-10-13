<?php

namespace Iamprincesly\GoogleVertexAI;

use Illuminate\Support\ServiceProvider;

class GoogleVertexAIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(abstract: 'vertexai', concrete: function ($app): GoogleVertexAI {
            return new GoogleVertexAI();
        });
        
        $this->mergeConfigFrom(path: __DIR__.'/../config/googlevertexai.php', key: 'googlevertexai');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes(paths: [
            __DIR__.'/../config/googlevertexai.php' => config_path('googlevertexai.php'),
        ], groups: 'config');
    }
}
