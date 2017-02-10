<?php
/**
 * Created by PhpStorm.
 * User: liu
 * Date: 1/17/17
 * Time: 2:32 PM
 */

namespace app\admin\model;
use think\Cache;
use think\Model;

class Menu extends Model{
    public function getAll(){
        $temp = [];
        $data['recordsFiltered'] = $data['recordsTotal'] = self::count();
        $fortemp = $parent = self::where("parent","=",0)->field("menu_name,mid,ishidden,menu_url,gid,listorder")->order("listorder asc")->cache(true)->select();
        foreach ($fortemp as $k=>$v){
            $child = self::where("parent","=",$v['mid'])->field("menu_name,mid,ishidden,menu_url,gid,listorder")->order("listorder asc")->cache(true)->select();
            $temp[] = $v;
            if (!empty($child)) {
                $temp = array_merge($temp, self::toTree($child));
            }
        }

        $data['data'] = $temp;
        return $data;
    }

    public function getMenu($tid){
        $data = self::where(["tid" => $tid, "parent" => 0, "ishidden" => 0])->field("menu_name,mid,ishidden,menu_url,gid,listorder")->order("listorder asc")->cache(true)->select();
        if (!is_array($data)){
            $data = $data->toArray();
        }
        foreach ($data as $k => $v){
            $child = self::where(["tid"=>$tid,"parent"=>$v['mid'],"ishidden"=>0])->field("menu_name,mid,ishidden,menu_url,gid,listorder")->order("listorder asc")->cache(true)->select();
            if (!is_array($child)) {
                $child = $child->toArray();
            }
            $data[$k]["child"] = $child;
        }
        return $data;
    }

    public function getIshiddenAttr($value){
        $status = [0=>'是',1=>"否"];
        return $status[$value];
    }

    public function insertMenu($data){
        Cache::clear();
        if (!isset($data['mid'])) {
            return $this->data($data,true)->allowField(true)->isUpdate(false)->save();
        }else{
            Cache::clear();
            return $this->allowField(true)->save($data,['mid'=>$data['mid']]);
        }

    }

    public function getPmenu(){
        return self::where("parent",0)->select();
    }
    public function toTree($array){
        $t1 = "&nbsp;&nbsp;&nbsp;├─ ";
        $t2 = "&nbsp;&nbsp;&nbsp;└─ ";
        $ca = count($array);
        for ($i = 0;$i < $ca;$i++){
            if($i+1 == $ca){
                $array[$i]["menu_name"] = $t2 . $array[$i]["menu_name"];
            }else{
                $array[$i]["menu_name"] = $t1 . $array[$i]["menu_name"];
            }
        }
        return $array;
    }
}