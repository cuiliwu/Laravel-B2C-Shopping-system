<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/6/5-15:19
 * License Hangzhou orce Technology Co., Ltd. Copyright © 2018
 */

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;

class UserController extends  BaseController
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * 后台-用户列表
     * */
    public function index(){
        return view('Admin.User.index',['bread'=>['first_level'=>'用户管理','second_level'=>'用户列表']]);
    }

}