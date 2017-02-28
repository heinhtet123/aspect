<?php

namespace RoleCms\Aspect;

use Illuminate\Support\ServiceProvider;
use RoleCms\Aspect\Aspect;

class AspectServiceProvider extends ServiceProvider
{
    protected $defer = false;
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../Config/aspectpermission.php' => app()->basePath() . '/config/aspectpermission.php',
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPermission();

        $this->mergeConfig();
    }


    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerPermission()
    {
        $this->app->bind('Aspect', function($app){
            return new Aspect($app);
        });

    }


      /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        // $this->app->singleton('command.aspect.migration',function($app){
        //     //return new 
        // });

        //  $this->app->singleton('command.entrust.migration', function ($app) {
        //     return new MigrationCommand();
        // });
    }

     private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Config/aspectpermission.php', 'aspectpermission'
        );
    }

}
