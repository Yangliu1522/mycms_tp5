<?php
namespace app\addones\Hello;
use app\admin\controller\AddoneBase;

class Hello extends AddoneBase{
    public function init_addone(){
        parent::init_addone(); // TODO: Change the autogenerated stub
    }

    public function doWebIndex(){
        $this->asData("test","test");
        return $this->tpl("hello/index");
    }

    public function doWebPost(){
        return json_encode();
    }
}