<?php

namespace Ajmariduena\SettingsTool;

use Laravel\Nova\Nova;
use Spatie\Valuestore\Valuestore;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Ajmariduena\SettingsTool\Classes\Settings;
use Ajmariduena\SettingsTool\Http\Middleware\Authorize;

class SettingsToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/settings.php' => config_path('settings.php'),
        ], 'settings-tool');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'settings-tool');

        $this->app->booted(function () {
            $this->routes();
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
                ->prefix('nova-vendor/settings-tool')
                ->group(__DIR__ . '/../routes/api.php');
    }
}
