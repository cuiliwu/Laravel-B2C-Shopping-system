<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/6/5-15:19
 * License Hangzhou orce Technology Co., Ltd. Copyright © 2018
 */

namespace App\Http\Controllers\Admin\User;

use App\Repository\Models\AdminUser;
use App\Repository\Repositories\Interfaces\RoleRepository;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;

class RoleController extends  BaseController
{
    protected $role;

    public function __construct(Request $request,RoleRepository $role)
    {
        parent::__construct($request);
        $this->role = $role;
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
        $ret = $this->role->paginate($this->perPage)->toArray();

        //结果处理部分
        $data = paginate($this->request, $ret);
        //dd($data);
        return view('Admin.User.role_list',$data);
    }

    public function show(){
        dd('show');
    }
    public function create(){
        return view('Admin.User.role_create');
    }
    public function edit($id){
        $ret  = $this->role->find($id)->toArray();
        old_set($ret);
        return view('Admin.User.role_edit',['type'=>'PUT']);
    }
    public function update($id)
    {
        $data = $this->form();
        $ret  = $this->role->update($data,$id);
        return redirect('/Kawhi/role');
    }
    public function store(){
        $data = $this->form();

        $ret = $this->role->updateOrCreate($data);

        return redirect('/Kawhi/role');
    }
    public function destroy($id){
        $ret = $this->role->delete($id);
        return redirect('/Kawhi/role');
    }
    public function form(){
        $id = $this->request->get('id',false);
        $validate = [
            'label'=> 'required|max:64',
            'description'=> 'max:255',
        ];
        if ($id!=false) {
            $validate['name']    = 'required|min:4|max:24|unique:roles,name,'.$id; // name
        }else{
            $validate['name']    = 'required|min:4|max:24|unique:roles,name'; // name
        }
        //dd($validate);
        $this->validate($this->request,$validate,[
            'name.required'  => '角色名称不可为空',
            'name.min'  => '角色名称最多24个字符',
            'name.max'  => '角色名称最少4个字符',
            'name.unique'  => '角色名称不可重复',

            'label.required' => 'label不可为空',
            'label.max'    => 'label 最多64个字符',
            'description.max'   => '描述最多255个字符',
        ]);
        return $this->request->all(['name','label','description']);
    }
    
    public function setStatus($id){
        
    }

}