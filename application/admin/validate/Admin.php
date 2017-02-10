<?php
/**
 * Created by PhpStorm.
 * User: liu
 * Date: 1/13/17
 * Time: 12:19 PM
 */

namespace app\admin\validate;
use think\Validate;

class Admin extends Validate{
    protected $rule = [
        'account' => 'require|max:20',
        'pwd'=>'require|max:20|min:6',
        'email'=>'email',
        'phone'=>'number',
    ];

    protected $scene = [
        'edit'  =>  ['account','email','phone'],
    ];
}