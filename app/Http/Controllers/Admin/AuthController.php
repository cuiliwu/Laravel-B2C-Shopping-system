<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/5/24-16:19
 */


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;


class AuthController extends  BaseController
{

    use ThrottlesLogins;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 登录视图展示
     * */
    public function login(){
        return view('Admin.login');
    }
    /**
     * 执行登录
     * */
    public function dologin(){
        session(['admin_user_id'=>1]);
        return redirect()->to('/Kawhi');
    }
    /**
     * 退出登录
     */
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        return redirect()->to(route('admin.login'));
    }
}