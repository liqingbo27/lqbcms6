<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Request;
use think\Model;

/**
 * @mixin think\Model
 */
class TeamModel extends Model
{
    protected $name = 'Team';

    public static $categoryArr = [
    	1=>'专家团队',
    	2=>'理事会成员',
    ];
    //
    public static function pageList($map = [],$limit=25){
        $limit = Request::param('limit',$limit);
        $list = self::where($map)->order('sort', 'ASC')->paginate([
            'list_rows'=> $limit,
            'var_page' => 'page',
        ])->each(function($item, $key){
			$item->url = '/team/show/id/'.$item->id;
        });
        return $list;
    }

    public static function info($id){
        $info = self::find($id);
        return $info;
    }

	public static function allList($limit=10){
		$list = self::where('status',1)
			->limit($limit)
			->order('sort','DESC')
			->select()
			->each(function(){

		});
		return $list;
	}

	public static function lishiList($position,$lang,$limit=5){
		return self::where('category_id',2)
			->where('position',$position)
			->where('lang',$lang)
			->limit($limit)
			->order('sort','ASC')
			->select()
			->each(function($item, $key){
				$item->url = '/team/show/id/'.$item['id'];
			});
    }

    /**
     * 上一篇
     * 2020-01-14 10:45:38 李清波
     */
    public static function prev($info){
        $info = self::where('id','>',$info['id'])->where('category_id','=',$info['category_id'])->field('id,title')->order('id','ASC')->find();
        return self::aHtml($info);
    }

    /**
     * 下一篇
     * 2020-01-14 10:45:56 李清波
     */
    public static function next($info){
        $info = self::where('id','<',$info['id'])->where('category_id','=',$info['category_id'])->field('id,title')->order('id','DESC')->find();
        return self::aHtml($info);
    }

    public static function getShowUrl($id){
        return '/team/show/id/'.$id;
    }

    public static function aHtml($info){
        if(!empty($info)){
            return '<a href="'.self::getShowUrl($info['id']).'">'.$info->title.'</a>';
        }else{
            return '<a href="javascript:;">无</a>';
        }
    }
}
