<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands('\App\Console\Commands\BindingsCommand');
        $this->app->bind(\App\Repository\Repositories\Interfaces\AdminUserRepository::class, \App\Repository\Repositories\AdminUserRepositoryEloquent::class);
        //:end-bindings:
    }

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}
	

}