<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Request;
use think\Model;

/**
 * @mixin think\Model
 */
class AdvertModel extends Model
{
    protected $name = 'advert';
    //
    public static function pageList($map = []){
        $limit = Request::param('limit',25);
        $list = self::where($map)->order('sort', 'ASC')->paginate([
            'list_rows'=> $limit,
            'var_page' => 'page',
        ])->each(function($item, $key){

            $item->admin_name = AdminModel::where('id',$item->admin_id)->value('username');

        });
        return $list;
    }

    public static function info($id){
        $info = self::find($id);
        return $info;
    }

    public static function allList($map=[],$limit=10){
    	$map[] = ['status','=',1];
        $list = self::where($map)->limit($limit)->order('sort','asc')->select();
        return $list;
    }
}
