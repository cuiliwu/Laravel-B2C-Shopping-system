<?php

/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/5/17-11:22
 * License Hangzhou orce Technology Co., Ltd. Copyright © 2018
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class IndexController extends  Controller
{
    /**
     * 后台首页
     *
     * */
    public function index(){
        return view('Admin.index');
    }
}