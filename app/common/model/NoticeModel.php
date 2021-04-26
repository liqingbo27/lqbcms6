<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Request;
use think\Model;

/**
 * @mixin think\Model
 */
class NoticeModel extends Model
{
    protected $name = 'notice';
    //
    public static function pageList($map = [],$limit=25){
	    $limit = Request::param('limit',$limit);
	    $list = self::where($map)->order(['sort'=>'ASC','update_time'=>'DESC'])->paginate([
            'list_rows'=> $limit,
            'var_page' => 'page',
        ])->each(function($item, $key){
	        $item->url = self::getShowUrl($item->id);
          $item->category_name = NoticeCategoryModel::where('id',$item->category_id)->value('name');
          $item->admin_name = AdminModel::where('id',$item->admin_id)->value('username');
        });
        return $list;
    }

    public static function info($id){
        $info = self::find($id);
        return $info;
    }

	public static function listByCategory($category_id,$limit=10){
		$categoryIdArr = [];
    	if(!empty($category_id)){
		    $categoryIdArr = NoticeCategoryModel::where('pid',$category_id)->column('id');
		    array_push($categoryIdArr,$category_id);
	    }

    	$map = [];
    	if(is_array($categoryIdArr)&&!empty($categoryIdArr)){
    		$map[] = ['category_id','in',$categoryIdArr];
	    }
        $map[] = ['lang','=',get_current_lang()];
        $map[] = ['status','=',1];
		$list = self::where($map)->limit($limit)->order(['sort'=>'ASC','update_time'=>'DESC'])->select()->toArray();
		if(!empty($limit)){
			foreach ($list as $key=>$val){
				$list[$key]['url'] = self::getShowUrl($val['id']);
			}
		}
		return $list;
	}

    /**
     * 上一篇
     * 2020-01-14 10:45:38 李清波
     */
    public static function prev($info){
        $info = self::where('id','>',$info['id'])->field('id,title')->order('id','ASC')->find();
        return self::aHtml($info);
    }

    /**
     * 下一篇
     * 2020-01-14 10:45:56 李清波
     */
    public static function next($info){
        $info = self::where('id','<',$info['id'])->field('id,title')->order('id','DESC')->find();
        return self::aHtml($info);
    }

    public static function getShowUrl($id){
        return '/notice/show/id/'.$id;
    }

    public static function aHtml($info){
        if(!empty($info)){
            return '<a href="'.self::getShowUrl($info['id']).'">'.$info->title.'</a>';
        }else{
            return '<a href="javascript:;">无</a>';
        }
    }
}
