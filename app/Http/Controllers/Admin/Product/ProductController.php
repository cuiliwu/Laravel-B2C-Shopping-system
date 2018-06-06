<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/6/6-9:07
 * License Hangzhou orce Technology Co., Ltd. Copyright © 2018
 */

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
class ProductController extends  BaseController
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }    
    /**
     * 商品列表
     * */
    public function index(){
        return view('Admin.Product.productList');
    }
}