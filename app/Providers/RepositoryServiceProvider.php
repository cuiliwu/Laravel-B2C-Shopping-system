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
		// 后台用户表
        $this->app->bind(\App\Repository\Repositories\Interfaces\AdminUserRepository::class, \App\Repository\Repositories\AdminUserRepositoryEloquent::class);
        // 角色表
		$this->app->bind(\App\Repository\Repositories\Interfaces\RoleRepository::class, \App\Repository\Repositories\RoleRepositoryEloquent::class);
        // 后台 用户-角色 关联表
		$this->app->bind(\App\Repository\Repositories\Interfaces\RoleAdminUserRepository::class, \App\Repository\Repositories\RoleAdminUserRepositoryEloquent::class);
        // 菜单表
		$this->app->bind(\App\Repository\Repositories\Interfaces\MenuRepository::class, \App\Repository\Repositories\MenuRepositoryEloquent::class);
        // 角色权限关联表
		$this->app->bind(\App\Repository\Repositories\Interfaces\PermissionRoleRepository::class, \App\Repository\Repositories\PermissionRoleRepositoryEloquent::class);
		// 权限列表
		$this->app->bind(\App\Repository\Repositories\Interfaces\PermissionRepository::class, \App\Repository\Repositories\PermissionRepositoryEloquent::class);
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