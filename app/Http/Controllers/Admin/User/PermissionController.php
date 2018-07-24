<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/6/5-15:19
 * License Hangzhou orce Technology Co., Ltd. Copyright © 2018
 */

namespace App\Http\Controllers\Admin\User;

use App\Repository\Models\AdminUser;
use App\Repository\Repositories\Interfaces\PermissionRepository;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;

class PermissionController extends  BaseController
{
    protected $permission;

    public function __construct(Request $request,PermissionRepository $permission)
    {
        parent::__construct($request);
        $this->permission = $permission;
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
        $ret = $this->permission->paginate($this->perPage)->toArray();

        //结果处理部分
        $data = paginate($this->request, $ret);
        //dd($data);
        return view('Admin.User.permission_list',$data);
    }

    public function show(){
        dd('show');
    }
    public function create(){
        return view('Admin.User.permission_create');
    }
    public function edit($id){
        $ret  = $this->permission->find($id)->toArray();
        old_set($ret);
        return view('Admin.User.permission_edit',['type'=>'PUT']);
    }
    public function update($id)
    {
        $data = $this->form();
        unset($data['password']);
        $ret  = $this->permission->update($data,$id);
        return redirect('/Kawhi/permission');
    }
    public function store(){
        $data = $this->form();

        $ret = $this->permission->updateOrCreate($data);

        return redirect('/Kawhi/permission');
    }
    public function destroy($id){
        $ret = $this->permission->delete($id);
        return redirect('/Kawhi/permission');
    }
    public function form(){
        $id = $this->request->get('id',false);
        $validate = [
            'name'=>'required|max:64',
            //'email'=>'required|email|unique:admin_users,email',
            //'password'=>'required|min:6',
        ];
        if ($id!=false) {
            $validate['email']    = 'required|email|unique:admin_users,email,'.$id; // email
        }else{
            $validate['email']    = 'required|email|unique:admin_users,email'; // email
            $validate['password'] = 'required|min:6';
        }
        $this->validate($this->request,$validate,[
            'name.required'  => '昵称不可为空',
            'name.max'  => '昵称超过最大长度限制',
            'email.required' => 'E-mail 不可为空',
            'email.email'    => 'E-mail 格式不正确',
            'email.unique'   => 'E-mail 已使用，请更换',
            'password.min'   => '密码长度最少为 6 位',
            'password.required' => '密码 不可为空',
        ]);
        return $this->request->all(['name','password','email']);
    }
    
    public function setStatus($id){
        
    }

}