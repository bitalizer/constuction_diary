<?php

namespace EBuildingDiary\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Register blade directives
        $this->bladeDirectives();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() === 'local') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Register the blade directives
     *
     * @return void
     */
    private function bladeDirectives()
    {
        if (!class_exists('\Blade')) return;

        Blade::directive('position', function($expression) {
            return "<?php if (Auth::user()->hasPosition({$expression})) : ?>";
        });
        Blade::directive('endposition', function($expression) {
            return "<?php endif; // EBuildingDiary\Employee::hasPosition ?>";
        });

        Blade::directive('permission', function($expression) {
            return "<?php if (Auth::user()->can({$expression})) : ?>";
        });
        Blade::directive('endpermission', function($expression) {
            return "<?php endif; // EBuildingDiary\Employee::can ?>";
        });
    }
}
