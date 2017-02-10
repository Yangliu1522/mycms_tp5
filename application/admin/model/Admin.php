<?php
/**
 * Created by PhpStorm.
 * User: liu
 * Date: 1/10/17
 * Time: 3:42 PM
 */

namespace app\admin\model;
use think\Model;
use think\Cache;

class Admin extends Model{
    protected static $password_salt = '';
    protected $createTime = 'createtime';
    protected $updateTime = false;
    protected $autoWriteTimestamp = true;
    public function getAccount($account){
        return $this::where(["account"=>$account,"isuse"=>1])->field("uid,account,pwd,salt")->find();
    }

    public function insertAccount($data){
        if (isset($data['pwd'])){
            $data["pwd"] = $this->setUserLoginPasswordAttr($data['pwd']);
            $data['salt'] = self::$password_salt;
        }
        if (!isset($data['uid'])) {
            return $this->data($data,true)->allowField(true)->isUpdate(false)->save();
        }else{
            model("AdminGroup")->updateGroup($data['admin_group'],$data['uid']);
            Cache::clear();
            return $this->allowField(true)->save($data,['uid'=>$data['uid']]);
        }

    }
    public function updateAccount($pwd,$uid){
        $data = ["pwd" => $this->setUserLoginPasswordAttr($pwd), 'salt'=> self::$password_salt,"last_time"=>time()];
        return $this::where("uid",$uid)->update($data);
    }

    public function getAccountInfo($id){
        return self::where(["uid"=>$id])->field("uid,account,admin_group,note,email,phone")->cache(true)->find();
    }

    public function getJdata($page){
        $data = [];
        $data['recordsTotal'] = $this::count();
        $data['data'] = $this::where("uid",">","0")->field("uid,account,email,createtime,last_time,admin_group,phone,isuse")->limit($page,10)->cache(true)->select();
        if (!is_array($data['data'])){
            $data = $data['data']->toArray();
        }
        $data['recordsFiltered'] = count($data['data']);
        foreach ($data['data'] as $key=>$val){
            $data['data'][$key]['DT_RowId'] = "row_".$val['uid'];
        }
        return $data;
    }

    public function getLastTimeAttr($value){
        return date("Y年m月d日 H:i",$value);
    }

    public function getAdminGroupAttr($value){
        $status = model("AdminGroup")::all();
        $temp = [];
        foreach ($status as $k => $v){
            $temp[$v['gid']] = $v['name'];
        }
        return $temp[$value];
    }

    public function getIsuseAttr($value){
        $status = [1=>'<span class="label label-success radius">已启用</span>',0=>"<span class=\"label radius\">已停用</span>"];
        return $status[$value];
    }

    public function getCreatetimeAttr($value){
        return date("Y年m月d日 H:i",$value);
    }

    protected static function generateSalt(){
        $str = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890';
        $salt = substr(str_shuffle($str),10,6);
        return $salt;
    }

    protected static function init(){
        parent::init();
        self::$password_salt = self::generateSalt();
    }

    public function setUserLoginPasswordAttr($value){
        return md5(md5($value).self::$password_salt);
    }
}