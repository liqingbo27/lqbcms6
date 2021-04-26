<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Request;
use think\Model;

/**
 * @mixin think\Model
 */
class ServiceModel extends Model
{
    protected $name = 'service';
    //
    public static function pageList($map = []){
        $limit = Request::param('limit',25);
        $list = self::where($map)->order('id', 'DESC')->paginate([
            'list_rows'=> $limit,
            'var_page' => 'page',
        ])->each(function($item, $key){
            $item->admin_name = AdminModel::where('id',$item->admin_id)->value('username');
            $item->url = self::getShowUrl($item->id);
        });
        return $list;
    }

    public static function info($id){
        $info = self::find($id);
        return $info;
    }

    /**
     * 上一篇
     * 2020-01-14 10:45:38 李清波
     */
    public static function prev($id){
        $info = self::where('id','>',$id)->field('id,title')->order('id','ASC')->find();
        return self::aHtml($info);
    }

    /**
     * 下一篇
     * 2020-01-14 10:45:56 李清波
     */
    public static function next($id){
        $info = self::where('id','<',$id)->field('id,title')->order('id','DESC')->find();
        return self::aHtml($info);
    }

    public static function getShowUrl($id){
        return '/service/show/id/'.$id;
    }

    public static function aHtml($info){
        if(!empty($info)){
            return '<a href="'.self::getShowUrl($info['id']).'">'.$info->title.'</a>';
        }else{
            return '<a href="javascript:;">无</a>';
        }
    }
}
