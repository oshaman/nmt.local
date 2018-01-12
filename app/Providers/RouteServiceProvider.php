<?php

namespace Fresh\Nashemisto\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Fresh\Nashemisto\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::model('cat', \Fresh\Nashemisto\Category::class);
        Route::model('channel', \Fresh\Nashemisto\Channel::class);
        Route::model('tag', \Fresh\Nashemisto\Tag::class);
        Route::model('article', \Fresh\Nashemisto\Article::class);
        Route::model('poll', \Fresh\Nashemisto\Poll::class);
        Route::model('video', \Fresh\Nashemisto\Video::class);
        Route::model('seo', \Fresh\Nashemisto\Seo::class);
        Route::model('static', \Fresh\Nashemisto\StaticPage::class);
        Route::model('priority', \Fresh\Nashemisto\Priority::class);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
