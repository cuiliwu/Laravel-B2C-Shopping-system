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
            // return redirect()->to(route('admin.login'));
        }
        return $next($request);
    }
}
