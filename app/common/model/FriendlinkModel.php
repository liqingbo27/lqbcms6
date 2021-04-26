<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Request;
use think\Model;

/**
 * @mixin think\Model
 */
class FriendlinkModel extends Model
{
    protected $name = 'link';
    //
    public static function pageList($map = [],$limit=25){
        $limit = Request::param('limit',$limit);
        $list = self::where($map)->order('id', 'DESC')->paginate([
            'list_rows'=> $limit,
            'var_page' => 'page',
        ])->each(function($item, $key){


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
