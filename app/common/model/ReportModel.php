<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Request;
use think\Model;

/**
 * @mixin think\Model
 */
class ReportModel extends Model
{
    protected $name = 'report';
    //
    public static function pageList($map = []){
        $limit = Request::param('limit',25);
        $list = self::where($map)->order('id', 'DESC')->paginate([
            'list_rows'=> $limit,
            'var_page' => 'page',
        ])->each(function($item, $key){
            $item->admin_name = AdminModel::where('id',$item->admin_id)->value('username');
            if(!file_exists('.'.$item->attach)||empty($item->attach)){
                $item->file_status = '丢失';
            }else{
                $item->file_status = '正常';
            }
        });
        return $list;
    }

    public static function info($id){
        $info = self::find($id);
        return $info;
    }
}
