<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    //插件引导测试
    'p/[:name]/[:controller]'=>['index/index/plugin',['method'=>'get'],['name'=>'\w+','controller'=>'\w+']],
    //后台登录地址 可自由修改;
    'admin-login'=>['admin/admin/login',['method'=>'get']],
    //后台地址
    'admin-admin'=>['admin/admin/index',['method'=>"get"]],
    //添加管理员
    'admin-add'=>['admin/admin/admin_add',['method'=>'get,post,ajax']],
    //管理员列表
    'admin-list'=>['admin/admin/admin_list',['method'=>'get,post,ajax']],
    //系统菜单
    'admin-menu'=>['admin/system/menu_list',['method'=>'get,post,ajax']],
    //管理员组
    'admin-group'=>['admin/admin/admin_group',['method'=>"get,post,ajax"]],
    //插件列表
    'plugin-list'=>['admin/addone/plugin_list',['method'=>'get,post,ajax']],
];
