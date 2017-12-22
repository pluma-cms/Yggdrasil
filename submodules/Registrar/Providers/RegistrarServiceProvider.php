<?php

namespace Registrar\Providers;

use Illuminate\Support\Facades\Blade;
use Pluma\Support\Providers\ServiceProvider;

class RegistrarServiceProvider extends ServiceProvider
{
    /**
     * Array of observable models.
     *
     * @var array
     */
    protected $observables = [
        //
    ];

    /**
     * Registered middlewares on the
     * Service Providers Level.
     *
     * @var mixed
     */
    protected $middlewares = [
        //
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootObservables();

        $this->bootDirectives();
    }

    /**
     * Boots the Blade Directives.
     *
     * @return void
     */
    public function bootDirectives()
    {
        Blade::directive('enrolled', function ($param) {
            return "<?php if (false) : ?>";
        });
        Blade::directive('endenrolled', function ($param) {
            return "<?php endif; ?>";
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
