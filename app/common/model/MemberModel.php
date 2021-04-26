<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Request;
use think\Model;

/**
 * @mixin think\Model
 */
class MemberModel extends Model
{
    protected $name = 'member';
    //
    public static function pageList($map = [],$limit=20){
        $limit = Request::param('limit',$limit);
        $list = self::where($map)->order('id', 'DESC')->paginate([
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

    public static function createUserName(){
        $username = get_random(8, '123456789abcdefghijklmnpqrstuvwxyz');
        if(self::checkUserName($username)){
            return $username;
        }else{
            return time().get_random(8, '123456789abcdefghijklmnpqrstuvwxyz');
        }
    }

    public static function checkUserName($username){
        $r = self::where('username',$username)->find();
        if(!$r){
            return true;
        }else{
            return self::checkUserName($username);
        }
    }

}
