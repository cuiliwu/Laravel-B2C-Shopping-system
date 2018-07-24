<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/5/17-11:31
 * License Hangzhou orce Technology Co., Ltd. Copyright © 2018
 */
namespace App\Http\Middleware;

use Closure;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(!session('admin_user_id')){
            return redirect()->to(route('admin.login'));
        }elseif(session('is_super')==1){
            $user_id = session('admin_user_id');
            $route_index = $request->route()->action['as'];

        }
        //dd(self::getRouteList());
        return $next($request);
    }
    public function getRouteList()
    {
        $app = app();
        $path = [];
        $routes = $app->routes->getRoutes();
        foreach ($routes as $k => $value){
            $path[$k]['uri']    = $value->uri;
            $path[$k]['path']   = $value->methods[0];
            $path[$k]['action'] = $value->action;
        }
        return $routes;
    }
}
