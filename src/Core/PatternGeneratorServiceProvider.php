<?php

namespace NuWorks\PatternGenerator\Core;

use Illuminate\Support\ServiceProvider;

class PatternGeneratorServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 * 
	 * @return  void
	 */
    public function boot()
    {

    }

	/**
	 * Register the application services.
	 * 
	 * @return  void
	 */
    public function register()
    {
        $this->registerBindingsServiceProviderMakeCommand();
        $this->registerMakeCommand();
        $this->registerRepositoryInterfaceMakeCommand();
        $this->registerServiceMakeCommand();
        $this->registerTraitMakeCommand();
    }

    /**
     * Registers the BindingsServiceProviderMakeCommand
     * 
     * @return void
     */
    public function registerBindingsServiceProviderMakeCommand()
    {
        $this->app->singleton('command.nuworks.bindings', function ($app) {
            return $app['NuWorks\PatternGenerator\Core\Commands\BindingsServiceProviderMakeCommand'];
        });

        $this->commands('command.nuworks.bindings');
    }

    /**
     * Registers the ModelMakeCommand
     * 
     * @return void
     */
    public function registerMakeCommand()
    {
        $this->app->singleton('command.nuworks.make', function ($app) {
            return $app['NuWorks\PatternGenerator\Core\Commands\ModelMakeCommand'];
        });

        $this->commands('command.nuworks.make');
    }

    /**
     * Registers the RepositoryInterfaceMakeCommand
     * 
     * @return void
     */
    public function registerRepositoryInterfaceMakeCommand()
    {
        $this->app->singleton('command.nuworks.repository', function ($app) {
            return $app['NuWorks\PatternGenerator\Core\Commands\RepositoryInterfaceMakeCommand'];
        });

        $this->commands('command.nuworks.repository');
    }

    /**
     * Registers the ServiceMakeCommand
     * 
     * @return void
     */
    public function registerServiceMakeCommand()
    {
        $this->app->singleton('command.nuworks.service', function ($app) {
            return $app['NuWorks\PatternGenerator\Core\Commands\ServiceMakeCommand'];
        });

        $this->commands('command.nuworks.service');
    }

    /**
     * Registers the TraitMakeCommand
     * 
     * @return void
     */
    public function registerTraitMakeCommand()
    {
        $this->app->singleton('command.nuworks.trait', function ($app) {
            return $app['NuWorks\PatternGenerator\Core\Commands\TraitMakeCommand'];
        });

        $this->commands('command.nuworks.trait');
    }
}