<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Request;
use think\Model;

/**
 * @mixin think\Model
 */
class SmsModel extends Model
{
    protected $name = 'sms';

    public static function checkPhoneCode($phone,$code){
        $nowTime = time();
        $map = [];
        $map[] = ['phone','=',$phone];
        $map[] = ['code','=',$code];
        $smsInfo = self::where($map)->find();
        if(empty($smsInfo)){
            return ['code'=>1, 'msg'=>'验证码错误'];
        }
        if($smsInfo['isuse']!=0){
            return ['code'=>1, 'msg'=>'无效验证码'];
        }
        if($smsInfo['send_time']+1800<$nowTime){
            return ['code'=>1, 'msg'=>'验证码已失效'];
        }
        return ['code'=>0, 'msg'=>'success'];
    }
}
