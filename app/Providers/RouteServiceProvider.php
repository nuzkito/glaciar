<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapPublicRoutes();
        $this->mapAuthRoutes();
        $this->mapAppRoutes();
        $this->mapAdminRoutes();
    }

    protected function mapPublicRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/public.php');
        });
    }

    protected function mapAppRoutes()
    {
        Route::group([
            'middleware' => ['web', 'auth'],
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/app.php');
        });
    }

    protected function mapAdminRoutes()
    {
        Route::group([
            'middleware' => ['web', 'auth', 'admin'],
            'namespace' => $this->namespace . '\Admin',
        ], function ($router) {
            require base_path('routes/admin.php');
        });
    }

    protected function mapAuthRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            Route::auth();
            Route::get('/logout', 'Auth\LoginController@logout');
        });
    }
}
