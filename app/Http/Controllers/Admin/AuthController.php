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
        dd(123);
        $this->validate($this->request,['email' => 'required','password' => 'required'],[
            'email.required' => '账号不为空',
            'password.required' => '密码不为空',
        ]);

        if ($this->hasTooManyLoginAttempts($this->request)) {
            return $this->sendLockoutResponse($this->request);
        }
        $api = 'auth/login';
        $res = http_admin(['post', $api])->send($this->request->only('email','password'));

        if(0 == $res['code'] && array_get($res,'data.user')){
            session(['admin_user' => $res['data']['user']]);
            session(['admin_user_id' => $res['data']['user']['admin_user_id']]);
            $this->clearLoginAttempts($this->request);
            return redirect()->to('/Kawhi');
        }else{
            $this->validate($this->request,['errorRturn' => 'required'],[
                'errorRturn.required' => '账号或密码错误',
            ]);
            $this->incrementLoginAttempts($this->request);
            return redirect()->to('/Kawhi/login');
        }
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