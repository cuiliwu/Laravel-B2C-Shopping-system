<?php

/**
 * Created by Engineer CuiLiwu.
 * Project: deal. 
 * Date: 2018/5/17-11:22
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;

class AdminIndexController extends  BaseController
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * 后台-文章分类列表
     * */
    public function index(){
        return view('Admin.welcome',['bread'=>['first_level'=>'首页','second_level'=>'']]);
    }
    /**
     * 后台-新增页面
     * */
    public function create(){
        return view('Admin.article.catecreate');
    }
    /**
     * 后台-查看页面
     * */
    public function show(){

    }
    /**
     * 后台-编辑页面
     * */
    public function edit($id){
        $res = http_admin($this->api_url['show'], [$id])->send();

        return view('Admin.article.cateedit', ['cate'=>$res['data']]);
    }
    /**
     * 后台-新增
     * */
    public function store(){
        $this->form();

        $data = $this->request->except('_token','_method');
        $ret = http_admin($this->api_url['store'])->send($data);
        return redirect('/foradmin/article/category');
    }
    /**
     * 后台-编辑
     * */
    public function update($id){

        $this->form();

        $data = $this->request->except('_token','_method');
        $ret = http_admin($this->api_url['update'],[$id])->send($data);
        return redirect('/foradmin/article/category');
    }
    /**
     * 后台-删除
     * */
    public function destroy($id){
        $ret = http_admin($this->api_url['delete'],[$id])->send();
        return redirect('/foradmin/article/category');
    }
    /**
     * 后台-是否显示
     * */
    public function setShow($id){

        $this->validate($this->request, [
            'is_show' => 'required'
        ],[
            'is_show' => '请选择是否显示'
        ]);

        $data['is_show'] = $this->request->get('is_show',1);
        $ret = http_admin($this->api_url['setShow'],[$id])->send($data);
        if(isset($ret['code']) && $ret['code']===0 ){
            return response()->json(['code'=>0,'message'=>'']);
        }else{
            return response()->json(['code'=>1,'message'=>isset($ret['message']) ? $ret['message'] : $ret['data']]);
        }
    }

    /**
     * 后台-验证分类保存
     * */
    public function form(){
        $this->validate($this->request,[
            'fid'   => 'required|integer',
            'title' => 'required',
            'is_show' => 'required',
            'sort' => 'integer',
        ], [
            'fid'   => '父级分类必选|父级分类必选',
            'title' => '分类名称必填',
            'is_show' => '是否前台展示必选',
            'sort' => '排序必须为数字',
        ]);

        return $this->request->all();
    }
}