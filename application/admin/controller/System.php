<?php
/**
 * Created by PhpStorm.
 * User: liu
 * Date: 1/16/17
 * Time: 2:01 PM
 */

namespace app\admin\controller;

class System extends AdminBase{
    protected static $data = '';
    public function _initialize(){
        parent::_initialize();
        // self::$userinfo = $GLOBALS['user_info'];
        $this->needLogin();
    }

    public function index(){

    }

    //菜单管理
    public function menu_list(){
        if($this->request->isPost()){
            $menu = model("menu");
            return $menu->getAll();
        }
        return view("system/menu");
    }

    //菜单添加
    public function menu_add(){
        if($this->request->isAjax()){
            $data = $this->request_data;
            $res = model("menu")->insertMenu($data);
            return ['error'=>0];
        }
        if (isset($this->request_data['mid'])) {
            $this->assign("menu",model("Menu")::get(["mid"=>$this->request_data['mid']]));
            $this->assign("hasid", true);
        }else{
            $this->assign("menu",['menu_name'=>'',"menu_url"=>'',"listorder"=>0,]);
        }
        $this->assign("pemnu",model('menu')->getPmenu());
        return view("system/menu_add");
    }

    public function sysset(){

    }

    public function log_list(){

    }


}