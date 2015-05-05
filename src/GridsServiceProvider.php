<?php namespace Sygmaa\Grids;

use Illuminate\Support\ServiceProvider;

class GridsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'grids');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'grids');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/grids/')
        ], 'grids');

        $this->publishes([
            __DIR__.'/../assets' => public_path('vendor/grids'),
        ], 'public');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('grids', function($app)
        {
            return new GridsShortcuts($app['request']);
        });
        $this->app->alias('grids', 'Sygmaa\Grids\Grids');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('grids');
    }
}
