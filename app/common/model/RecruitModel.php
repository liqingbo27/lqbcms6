<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Request;
use think\Model;

/**
 * @mixin think\Model
 */
class RecruitModel extends Model
{
    protected $name = 'recruit';
    //
    public static function pageList($map = [],$limit=25){
        $limit = Request::param('limit',$limit);
        $list = self::where($map)->order('sort', 'ASC')->order('id', 'DESC')->paginate([
            'list_rows'=> $limit,
            'var_page' => 'page',
        ])->each(function($item, $key){
            $item->admin_name = AdminModel::where('id',$item->admin_id)->value('username');
            $item->money = self::getMoneyText($item->price_min,$item->price_max);
            $item->admin_name = AdminModel::where('id',$item->admin_id)->value('username');
            $item->url = self::getShowUrl($item->id);

        });
        return $list;
    }

    public static function info($id){
        $info = self::find($id);
        if(!empty($info)){
            $info->money = self::getMoneyText($info['price_min'],$info['price_max']);
        }
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
        return '/recruit/show/id/'.$id;
    }

    public static function aHtml($info){
        if(!empty($info)){
            return '<a href="'.self::getShowUrl($info['id']).'">'.$info->title.'</a>';
        }else{
            return '<a href="javascript:;">无</a>';
        }
    }

    public static function getMoneyText($price_min,$price_max){
    	if(empty($price_min)||empty($price_max)){
    		return '';
	    }
        if($price_min == $price_max){
            $money = $price_min;
        }else if($price_min <= 0){
            $money = '面议';
        }else{
            $money = $price_min .' - '. $price_max;
        }
        if($price_min <= 0){
            $money = '面议';
        }


        return $money;
    }
}
