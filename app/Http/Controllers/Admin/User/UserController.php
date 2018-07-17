<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/6/5-15:19
 * License Hangzhou orce Technology Co., Ltd. Copyright © 2018
 */

namespace App\Http\Controllers\Admin\User;

use App\Repository\Models\AdminUser;
use App\Repository\Repositories\Interfaces\AdminUserRepository;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;

class UserController extends  BaseController
{
    protected $adminUser;

    public function __construct(Request $request,AdminUserRepository $adminUser)
    {
        parent::__construct($request);
        $this->adminUser = $adminUser;
    }
    /**
     * 后台-用户列表
     * */
    public function index(){
        // 参数部分
        $search_params = $this->request->all();
        $page   = $this->request->get('page', 1);
        $params = [
            'search' => search_params($search_params),
            'searchJoin' => 'and',
            'orderBy'=>'created_at',
            'sortedBy'=>'desc',
            'page' => $page
        ];
        // 设置条件参数
        $this->request_set($params);
        $ret = $this->adminUser->paginate($this->perPage)->toArray();

        //结果处理部分
        $data = paginate($this->request, $ret);
        //dd($data);
        return view('Admin.User.index',$data);
    }

    public function show(){
        dd('show');
    }
    public function create(){
        return view('Admin.User.create');
        dd('create');
    }
    public function edit(){
        dd('edit');
    }
    public function store(){
        dd('store');
    }
    public function delete(){
        dd('delete');
    }

}