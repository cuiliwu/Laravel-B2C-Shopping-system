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
        $this->app->bind(\App\Repository\Repositories\Interfaces\ExamplesRepository::class, \App\Repository\Repositories\ExamplesRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\UserRepository::class,
            \App\Repository\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\CompanyMaterialRepository::class,
            \App\Repository\Repositories\CompanyMaterialRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\CompanyRepository::class,
            \App\Repository\Repositories\CompanyRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\OrdersRepository::class, \App\Repository\Repositories\OrdersRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\RoleRepository::class, \App\Repository\Repositories\RoleRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\AdminUserRepository::class, \App\Repository\Repositories\AdminUserRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ActionRepository::class, \App\Repository\Repositories\ActionRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\MenuRepository::class, \App\Repository\Repositories\MenuRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\PermissionRepository::class, \App\Repository\Repositories\PermissionRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ProductsRepository::class, \App\Repository\Repositories\ProductsRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\AttributesRepository::class, \App\Repository\Repositories\AttributesRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\AttributeValuesRepository::class, \App\Repository\Repositories\AttributeValuesRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ProductBrandsRepository::class, \App\Repository\Repositories\ProductBrandsRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ProductCategoriesRepository::class, \App\Repository\Repositories\ProductCategoriesRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ProductSkusRepository::class, \App\Repository\Repositories\ProductSkusRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\CartsRepository::class, \App\Repository\Repositories\CartsRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\InvoicesRepository::class, \App\Repository\Repositories\InvoicesRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\UserInvoiceRepository::class, \App\Repository\Repositories\UserInvoiceRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\OrderProductsRepository::class, \App\Repository\Repositories\OrderProductsRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\AddressRepository::class, \App\Repository\Repositories\AddressRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\RegionsRepository::class, \App\Repository\Repositories\RegionsRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\OrderExpressRepository::class, \App\Repository\Repositories\OrderExpressRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ChangeRepository::class, \App\Repository\Repositories\ChangeRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ExpressCompanyRepository::class, \App\Repository\Repositories\ExpressCompanyRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\OrderProductCommentRepository::class, \App\Repository\Repositories\OrderProductCommentRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ShopRepository::class, \App\Repository\Repositories\ShopRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ReportRepository::class, \App\Repository\Repositories\ReportRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ConsultRepository::class, \App\Repository\Repositories\ConsultRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ShopTypeRepository::class, \App\Repository\Repositories\ShopTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ShopLevelRepository::class, \App\Repository\Repositories\ShopLevelRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ReportTypeRepository::class, \App\Repository\Repositories\ReportTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\UserLogRepository::class, \App\Repository\Repositories\UserLogRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\BrandAuditRepository::class, \App\Repository\Repositories\BrandAuditRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ContractsRepository::class, \App\Repository\Repositories\ContractsRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ShopCategoriesRepository::class, \App\Repository\Repositories\ShopCategoriesRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\UserContractsRepository::class, \App\Repository\Repositories\UserContractsRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ShopEmployeeRepository::class, \App\Repository\Repositories\ShopEmployeeRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ShopRightAuthRepository::class, \App\Repository\Repositories\ShopRightAuthRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ShopRightMenuRepository::class, \App\Repository\Repositories\ShopRightMenuRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ShopRightOperationRepository::class, \App\Repository\Repositories\ShopRightOperationRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\UserCommentRepository::class, \App\Repository\Repositories\UserCommentRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\PaymentOrderRepository::class, \App\Repository\Repositories\PaymentOrderRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\UserCollectionRepository::class, \App\Repository\Repositories\UserCollectionRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ShopBannersRepository::class, \App\Repository\Repositories\ShopBannersRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ReceivingAccountRepository::class, \App\Repository\Repositories\ReceivingAccountRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ShopTempleteRepository::class, \App\Repository\Repositories\ShopTempleteRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\OrdersCrontabRepository::class, \App\Repository\Repositories\OrdersCrontabRepositoryEloquent::class);
        $this->app->bind(\App\Repository\Repositories\Interfaces\ArticleCategoryRepository::class, \App\Repository\Repositories\ArticleCategoryRepositoryEloquent::class);
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