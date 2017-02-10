<?php
/**
 * Created by PhpStorm.
 * User: liu
 * Date: 17-1-22
 * Time: 下午10:31
 */

namespace app\admin\controller;

class Addone extends AdminBase {
    protected static $default_conf = [
        'name'=>'',
        'author'=>'',
        'image'=>'',
        'type'=>'only'
    ];
    protected static $basePath = APP_PATH.'addones/';
    public function _initialize(){
        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    public function index(){

    }

    public function install(){

    }

    public function plugin_list(){
        $config = [];
        foreach (deepScanDir(self::$basePath) as $item) {
            $temp = controller('addones/Config',$item);
            $temp = $temp->config;
            $temp["pname"] = $item;
            $config[] = array_merge(self::$default_conf,$temp);
        }
        return view("list",['plugins'=>$config]);
    }
}