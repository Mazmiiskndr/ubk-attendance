<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
        $this->routes(function () {
            $this->registerApiRoutes();
            $this->registerWebRoutes();
            $this->registerUsersRoutes();
            $this->registerSettingsRoutes();
            $this->registerDatatablesRoutes();
        });
    }

    /**
     * Register routes for the api section.
     * @return void
     */
    protected function registerApiRoutes()
    {
        Route::prefix('api')->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    /**
     * Register routes for the web section.
     * @return void
     */
    protected function registerWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Register routes for the users section.
     * @return void
     */
    protected function registerUsersRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/users.php'));
    }

    /**
     * Register routes for the settings section.
     * @return void
     */
    protected function registerSettingsRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/settings.php'));
    }

    /**
     * Register routes for the datatables section.
     * @return void
     */
    protected function registerDatatablesRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/datatables.php'));
    }
}
