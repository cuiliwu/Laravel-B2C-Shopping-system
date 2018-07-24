<?php

namespace App\Presenters;

use App\Repository\Repositories\Interfaces\MenuRepository;
use App\Listeners\MenuEventSubscriber;
use Cache, Route, Auth;

/**
 * Menu View Presenters
 */
class MenuPresenter
{
    protected $menu;

    protected $api_url = [
        'nav' => ['get', 'seller/member/nav/%d'],
    ];
    public function __construct(MenuRepository $menu)
    {
        $this->menu = $menu;
    }

    /**
     * 渲染左侧栏视图
     *
     * @param  array $route
     * @param  array $menus
     *
     * @return mixed
     */
    public function renderSidebar()
    {
        $res = \Cache::remember('menu_list_alls',0,function(){
            $api = 'admin/menus';
            return http_admin(['get',$api])->send();
        });
        $tree = list_to_tree(array_get($res,'data.list',[]),'menu_id','parent_id');
        /* 生成左侧栏 HTML */
        return  self::makeSidebar($tree, []);
    }

    public function levelTree()
    {
        $res = \Cache::remember('menu_list_alls',0,function(){
            $ret = $this->menu->all()->toArray();
            return $ret;
        });
        $data = $res;
        return create_level_tree($data,0,'menu_id','parent_id');
    }
    public function cateLevelTree()
    {
        $res = \Cache::remember('cate_list_alls',0,function(){
            $api = 'article/catelist';
            return http_admin(['get',$api])->send(['type'=>'all']);
        });
        $data = array_get($res,'data',[]);
        return create_level_tree($data,0,'cate_id','fid');
    }

    /**
     * 生成左侧栏
     *
     * @param array $menus
     * @param array $active
     *
     * @return string
     */
    protected static function makeSidebar(array $menus, $active)
    {
//        $sidebar = json_encode($menus);
        $sidebar = "";
        foreach ($menus as $menu) {
            if($menu['hide'] == 0){
                if(array_key_exists('child', $menu)){
                    if(in_array($menu['route'], $active)){
                        $sidebar .= '<li>';
                    } else {
                        $sidebar .= '<li>';
                    }
                    $sidebar .= '<a href="javascript:void(0);">
                                    <i class="' . $menu['icon'] . '"></i>
                                    <span>' . ($menu['name']) . '</span>
                                    <i class="fa arrow"></i>
                                </a>
                            <ul class="nav nav-second-level">' .
                        self::makeSidebar($menu['child'], $active) . '
                            </ul>
                        </li>';
                } else {
                    if(in_array($menu['route'], $active)){
                        $sidebar .= '<li class="active">';
                    } else {
                        $sidebar .= '<li>';
                    }

                    if($menu['route']){
                        $sidebar .= '<a class="J_menuItem" href="' . ($menu['route']) . '">';
                    } else {
                        $sidebar .= '<a href="javascript:void(0);">';
                    }
                    $sidebar .= '<i class="' . $menu['icon'] . '"></i>
                                <span> ' . ($menu['name']) . '</span>
                            </a>
                        </li>';
                }
            }
        }

        return $sidebar;
    }



    /**
     * 渲染左侧栏视图
     *
     * @param  array $route
     * @param  array $menus
     *
     * @return mixed
     */
    public function renderWebSidebar()
    {
        $res = \Cache::remember('web_menu_list_alls',0,function(){

            $nav= http_web($this->api_url['nav'],[session('user_id')])->send();

            return $nav;
        });
        /* 生成左侧栏 HTML */
        return  self::makeWebSidebar($res['data'], []);
    }

    /**
     * 生成左侧栏
     *
     * @param array $menus
     * @param array $active
     *
     * @return string
     */
    protected static function makeWebSidebar(array $menus, $active)
    {
        $sidebar = "";
        $m=1;
        foreach($menus['menu'] as $k=>$v){
            $sidebar.="<dl>";

            $sidebar.="<dt><img src='/img/web/user/nav_left_dt_0".$m.".png'>".$v['p_menu']['name']."</dt>";
            if($k==1 && session('user_shop_id')){
                $sidebar.="<dd class='prove_goods'><a href='/shop/index/".session('user_shop_id')."'>我的店铺</a></dd>";

            }
                foreach($v['menu'] as $key=>$value){
                    $explode = explode('/', $value['url']);
                    $array_filter   = array_filter($explode);
                    $group   = end($array_filter);
                    // 修改 选中 格式 begin
                    $strUrl =  str_replace(request()->root(),"",request()->fullUrl());
                    if ($strUrl == $value['url']){
                        $group.=' selected';
                    }else{
                        if($strUrl=='/member/seller/member/create'){
                            if($value['url']=='/member/seller/member'){
                                $group='member selected';
                            }else{
                                $group='member';
                            }
                        }
                        if($strUrl=='/member/seller/items/create'){
                            if($value['url']=='/member/seller/items'){
                                $group='items selected';
                            }else{
                                $group='items';
                            }
                        }
                    }
                    // 修改 选中 格式 end
                    $sidebar.="<dd class='".$group."' ";
//                    if(request()->path() == $value['url']){
//                        $sidebar.=" selected ";
//                    }
                    $sidebar.="><a href='".$value['url']."'>".$value['name']."</a>";
                    $sidebar.="</dd>";
                }

            $sidebar.="</dl>";
            $m++;
        }

        return $sidebar;
    }

    /**
     * 渲染右侧操作权限
     *
     * @param  array $route
     * @param  array $menus
     *
     * @return mixed
     */
    public function renderWebOperation($menu_id,$code=null)
    {
        $res = \Cache::remember('web_menu_list_alls',0,function(){

            $nav= http_web($this->api_url['nav'],[session('user_id')])->send();

            return $nav;
        });
        /* 生成左侧栏 HTML */
        return  self::makeWebOperation($res['data'], $menu_id,$code);
    }

    /**
         * 生成左侧栏
         *
         * @param array $menus
         * @param int $menu_id
         *
         * @return string
         */
        protected static function makeWebOperation(array $menus, $menu_id,$code=null)
        {
            $sidebar=json_encode($menus['operation']);
            $sidebar = "";
            foreach($menus['operation'] as $k=>$v){

                if($v['menu_id']==$menu_id && $menu_id==9){
                    if($v['code']=='btnPutOff'){//下架
                        $sidebar.="<input type=\"submit\" class=\"shelves do-curd\" data-action=\"do-offsale\" value='".$v['name']."'>";
                    }
                    if($v['code']=='btnDelete'){//删除
                        $sidebar.="<input type=\"submit\" class=\"shelves do-curd\" data-action='do-delete' value='".$v['name']."'>";
                    }
                }
                if($v['menu_id']==$menu_id && $menu_id==10){
                    if($v['code']=='btnPutOn'){//上架
                        $sidebar.="<input type=\"submit\" class=\"shelves do-curd\" data-action=\"do-onsale\" value='".$v['name']."'>";
                    }
                    if($v['code']=='btnDelete'){//删除
                        $sidebar.="<input type=\"submit\" class=\"shelves do-curd\" data-action='do-delete' value='".$v['name']."'>";
                    }
                }

                if($v['menu_id']==$menu_id && $menu_id==12){
                    if($code=='btnInvite' && $v['code']==$code){
                        $sidebar="<a href=\"".url('/member/seller/member/create')."\" class=\"add_num member \"> +  邀请员工</a>";
                    }elseif($code=='btnEdit' && $v['code']==$code){
//                        $sidebar="<a href=\"".url('/member/seller/member/'.$v['id'])."\" class=\"edit\">编辑</a>";
                        $sidebar="编辑";
                    }elseif($code=='btnDisRelation' && $v['code']==$code){
//                        $sidebar="<a href=\"javascript:void(0)\" data-id=\"0\" class=\"del\" >解除关系</a>";
                        $sidebar="解除关系";
                    }
                }
            }
            return $sidebar;
        }



}
