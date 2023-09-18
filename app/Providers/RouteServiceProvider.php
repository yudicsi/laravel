<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
session_start();


class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
     protected $namespace = '';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
/*            ->prefix('api')*/
            ->group(base_path('routes/api.php'));

            if (file_exists(base_path('app/__aaa/api.php'))) {    
                Route::middleware('api')
                ->group(base_path('app/__aaa/api.php'));
            }

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            if (file_exists(base_path('app/__aaa/web.php'))) {    
               Route::middleware('web')
               ->namespace($this->namespace)
               ->group(base_path('app/__aaa/web.php'));
            }

            if (file_exists($_SESSION['APP_DIR'].'/web.php')) {    
               Route::middleware('web')
               ->namespace($this->namespace)
               ->group($_SESSION['APP_DIR'].'/web.php');
            }

            if (file_exists($_SESSION['APP_DIR'].'/api.php')) {    
               Route::middleware('api')
               ->namespace($this->namespace)
               ->group($_SESSION['APP_DIR'].'/api.php');
            }

        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
