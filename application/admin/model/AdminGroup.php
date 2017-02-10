<?php
/**
 * Created by PhpStorm.
 * User: liu
 * Date: 1/17/17
 * Time: 11:03 PM
 */

namespace app\admin\model;
use think\Model;

class AdminGroup extends Model{
    public function getAll(){
        $data['recordsFiltered'] = $data['recordsTotal'] = self::count();
        $data['data'] = self::all();
        return $data;
    }

    public function getUidAttr($value){
        $value = unserialize($value);
        $temp = '';
        foreach ($value as $k){
            $data = model("admin")->getAccountInfo($k);
            $temp .= $data['account'].' , ';
        }
        return trim($temp);
    }

    public function updateGroup($gid,$uid = '',$mid = []){
        if (empty($uid) && empty($mid)){
            return false;
        }
        $all = self::where("gid",$gid)->find();
        $menus = empty($all['mid'])?unserialize($all['mid']):[];
        $accs = !empty($all['uid'])?unserialize($all['uid']):[];
        if (!in_array($uid,$accs)) {
            $accs[] = $uid;
        }
        $mid = (isset($menus) && !empty($menus))?(array_merge($menus,$mid)):$mid;
        self::where(["gid"=>$gid])->update(["uid"=>serialize($accs),"mid"=>serialize($mid)]);
    }
}