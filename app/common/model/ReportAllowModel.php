<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Request;
use think\Model;

/**
 * @mixin think\Model
 */
class ReportAllowModel extends Model
{
    protected $name = 'report_allow';


    public static function getMemberIds($report_id){
        $ids = self::where('report_id',$report_id)->column('member_id');
        return $ids;
    }
}
