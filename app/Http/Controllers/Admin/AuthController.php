<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/5/24-16:19
 */


namespace App\Http\Controllers\Admin;

use App\Repository\Models\AdminUser;
use App\Repository\Repositories\Interfaces\AdminUserRepository;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;


class AuthController extends  BaseController
{

    use ThrottlesLogins;
    protected $request;
    protected $AdminUser;

    public function __construct(Request $request ,AdminUserRepository $AdminUser)
    {
        $this->request = $request;
        $this->AdminUser = $AdminUser;
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
        $this->validate($this->request,[
            'email'=>'required|email',
            'password'=>'required|min:6'
        ],[
            'email.required'   => '账号信息必填',
            'email.email'      => '账号格式不正确',
            'password.required'=> '密码信息必填',
            'password.min'     => '密码至少六位',
        ]);
        $doLogin = $this->AdminUser->checkLoginUser($this->request->all(['email','password']));

        if (isset($doLogin['flag'])&&$doLogin['flag']==true){
            session([
                'name'=>$doLogin['name'],
                'email'=>$doLogin['email'],
                'created_at'=>$doLogin['created_at'],
                'is_super'=>$doLogin['is_super'],
                'admin_user_id'=>$doLogin['user_id'],
            ]);
            return redirect()->to('/Kawhi');
        }else{

            $this->validate($this->request,['errorRturn' => 'required'],[
                'errorRturn.required' => '账号或密码错误',
            ]);
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