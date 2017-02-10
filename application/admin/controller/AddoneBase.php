<?php
/**
 * Created by PhpStorm.
 * User: liu
 * Date: 1/20/17
 * Time: 5:15 PM
 */

namespace app\admin\controller;
use think\Controller;
use think\view;

class AddoneBase extends Controller{
    protected $addone_config = [];
    protected $tpl_data = [];
    public function _initialize(){
        $this->init_addone();
    }
    //默认模板目录
    protected $root_tpl = "template";
    //默认模板后缀
    protected $ext_tpl = ".html";
    public function asData($name,$value = ''){
        if (is_array($name) && !empty($name)) {
            $this->tpl_data = array_merge($this->tpl_data, $name);
        }else{
            $this->tpl_data[$name] = $value;
        }
    }
    /**
     * 生成模板
     * @param $name
     * @param array $data
     * @return view
     */
    public function tpl($name, $data = []){
        $name = array_filter(explode('/',$name));
        $name[0] = ucwords($name[0]);
        $path = APP_PATH . 'addones/';
        for($i = 0;$i < count($name);$i ++){
            if ($i == (count($name)-1)){
                $path .= $this->root_tpl.'/'.$name[$i].$this->ext_tpl;
                continue;
            }
            $path .= $name[$i].'/';
        }
        if (!empty($data))
            $this->tpl_data = array_merge($this->tpl_data,$data);
        return view($path,$this->tpl_data);
    }

    protected function init_addone(){
    }
}