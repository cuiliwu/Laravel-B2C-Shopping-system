<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/6/5-15:19
 * License Hangzhou orce Technology Co., Ltd. Copyright © 2018
 */

namespace App\Http\Controllers\Admin\User;

use App\Presenters\MenuPresenter;
use App\Repository\Models\AdminUser;
use App\Repository\Repositories\Interfaces\MenuRepository;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;

class MenuController extends  BaseController
{
    protected $menu;
    protected $menuPresenter;

    public function __construct(Request $request,MenuRepository $menu,MenuPresenter $menuPresenter)
    {
        parent::__construct($request);
        $this->menu = $menu;
        $this->menuPresenter = $menuPresenter;
    }
    /**
     * 后台-用户列表
     * */
    public function index(){
//        dd($this->menuPresenter->levelTree());
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
        $ret = $this->menu->paginate($this->perPage)->toArray();

        //结果处理部分
        $data = paginate($this->request, $ret);
        //dd($data);
        return view('Admin.Menu.menu_list',$data);
    }

    public function show(){
        dd('show');
    }
    public function create(){
        return view('Admin.Menu.menu_create');
    }
    public function edit($id){
        $ret  = $this->menu->find($id)->toArray();
        old_set($ret);
        return view('Admin.Menu.menu_edit',['type'=>'PUT']);
    }
    public function update($id)
    {
        $data = $this->form();
        $ret  = $this->menu->update($data,$id);
        return redirect('/Kawhi/menu');
    }
    public function store(){
        $data = $this->form();

        $ret = $this->menu->updateOrCreate($data);

        return redirect('/Kawhi/menu');
    }
    public function destroy($id){
        $ret = $this->menu->delete($id);
        return redirect('/Kawhi/menu');
    }
    public function form(){
        $id = $this->request->get('id',false);
        $validate = [
            'parent_id'=>'required|integer',
            'order'=>'integer',
            'hide'=>'integer|in:0,1',
            'uri'=>'required|max:64',
        ];
        if ($id!=false) {
            $validate['title']    = 'required|min:2|max:24|unique:menus,title,'.$id; // email
        }else{
            $validate['title']    = 'required|min:2|max:24|unique:menus,title'; // email
        }
        $this->validate($this->request,$validate,[
            'title.required'=> '菜单标题不可为空',
            'title.max'     => '最多64个字符',
            'title.unique'  => '菜单标题不可重复',
            'order.integer' => '排序格式不正确',
            'parent_id.required'  => '父级菜单必选',
            'parent_id.integer'   => '父级菜单格式不正确',
            'uri.required'   => '菜单路由必填',
            'hide.integer'   => '是否显示格式错误',
            'hide.in'        => '是否显示格式不正确',
        ]);
        return $this->request->all(['title','parent_id','order','uri','hide','icon']);
    }
    
    public function setStatus($id){
        
    }

}