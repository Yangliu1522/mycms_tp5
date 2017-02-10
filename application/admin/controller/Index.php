<?php
/**
 * Created by PhpStorm.
 * User: liu
 * Date: 17-1-25
 * Time: 下午1:52
 */

namespace app\admin\controller;
use think\Controller;

class Index extends Controller {
    public function index(){
        $this->redirect(url('admin/admin/index'));
    }
}