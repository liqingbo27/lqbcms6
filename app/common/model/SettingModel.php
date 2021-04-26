<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Request;
use think\Model;

/**
 * @mixin think\Model
 */
class SettingModel extends Model
{
    protected $name = 'setting';

    public static function singleUpdate($data,$group='',$act='update'){
        if(empty($data)||!is_array($data)){
            return false;
        }

        $i = 0;
        foreach ($data as $key=>$val){
            $info = self::where('name',$key)->where('group',$group)->find();
            if(empty($info)){
                if($act==='add'){
                    self::create(['group'=>$group,'name'=>$key,'value'=>$key]);
                    continue;
                }else{
                    continue;
                }
            }
            $info->value = $val;
            $r = $info->save();
            if($r){
                $i++;
            }
        }
        return $i;
    }
}
