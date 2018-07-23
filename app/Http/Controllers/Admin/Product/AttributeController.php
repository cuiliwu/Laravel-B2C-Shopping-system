<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/7/23-10:14
 * License Hangzhou orce Technology Co., Ltd. Copyright © 2018
 */

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;

class AttributeController  extends  BaseController
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * 规格列表
     * */
    public function index(){
        return view('Admin.Attribute.attribute');
    }
}