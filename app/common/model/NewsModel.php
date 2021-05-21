<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Request;
use think\facade\Session;
use think\Model;

/**
 * @mixin think\Model
 */
class NewsModel extends Model
{
    protected $name = 'news';
    //
    public static function pageList($map = [],$limit=25){
        $limit = Request::param('limit',$limit);
        $list = self::where($map)->order(['update_time'=>'DESC'])->paginate([
            'list_rows'=> $limit,
            'var_page' => 'page',
        ])->each(function($item, $key){
        	if($item->lang=='en'){

		        $item->category_name = NewsCategoryModel::where('id',$item->category_id)->value('ename');
	        }else{

		        $item->category_name = NewsCategoryModel::where('id',$item->category_id)->value('name');
	        }
            $item->admin_name = AdminModel::where('id',$item->admin_id)->value('username');
            $item->url = '/news/show/id/'.$item->id;

	        $item->recommended_text = $item->recommended==1 ? '推荐' : '';
	        $item->topped_text = $item->topped==1 ? '推荐' : '';

        });
        return $list;
    }

    public static function info($id){
        $info = self::find($id);
        if(!empty($info)){
        	$info->content = NewsContentModel::where('id',$info->id)->value('content');
        }
        return $info;
    }


    /**
     * 前端获取
     */
    public static function listByCategory($category_id,$limit=10){
    	$map = [
		    ['category_id','=',$category_id],
		    ['lang','=',get_current_lang()],
		    ['status','=',1]
	    ];

    	$list = self::where($map)
		    ->limit($limit)
		    ->order(['sort'=>'ASC','update_time'=>'DESC'])
		    ->select()
		    ->toArray();
	    if(!empty($limit)){
	    	foreach ($list as $key=>$val){
	    		$list[$key]['url'] = self::getShowUrl($val['id']);
		    }
	    }
    	return $list;
    }

	/**
	 * 前端获取
	 */
	public static function getToppedList($limit=10){
		$map = [
			['topped','=',1]
		];

		$list = self::where($map)
			->limit($limit)
			->order(['update_time'=>'DESC'])
			->select()
			->toArray();
		if(!empty($limit)){
			foreach ($list as $key=>$val){
				$list[$key]['url'] = self::getShowUrl($val['id']);
			}
		}
		return $list;
	}

	public static function getRecommendedList($limit=10){
		$map = [
			['recommended','=',1]
		];

		$list = self::where($map)
			->limit($limit)
			->order(['update_time'=>'DESC'])
			->select()
			->toArray();
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
    public static function prev($info,$type=0){
        $info = self::where('id','>',$info['id'])
	        ->where('category_id','=',$info['category_id'])
	        ->where('lang','=',$info['lang'])
	        ->field('id,title,thumb')
	        ->order('id','ASC')
	        ->find();
        if(!empty($info)){
	        $info->url = self::getShowUrl($info->id);
        }
        if($type==1){
        	return $info;
        }
        return self::aHtml($info);
    }

    /**
     * 下一篇
     * 2020-01-14 10:45:56 李清波
     */
    public static function next($info,$type=0){
        $info = self::where('id','<',$info['id'])
	        ->where('category_id','=',$info['category_id'])
	        ->where('lang','=',$info['lang'])
	        ->field('id,title,thumb')
	        ->order('id','DESC')
	        ->find();
	    if(!empty($info)){
		    $info->url = self::getShowUrl($info->id);
	    }
	    if($type==1){
		    return $info;
	    }
        return self::aHtml($info);
    }

    public static function getShowUrl($id){
        return '/news/show-'.$id.'.html';
	    /*return url('news/show/read', ['id'=>$id])
		    ->suffix('html')
		    ->domain(true)
		    ->root('');*/
    }

    public static function aHtml($info){
        if(!empty($info)){
            return '<a href="'.self::getShowUrl($info['id']).'">'.$info->title.'</a>';
        }else{
            return '<a href="javascript:;">无</a>';
        }
    }

    public static function recommending($ids,$status=1){
    	return self::where('id','in',$ids)->update(['recommended' => $status]);
    }

	public static function topping($ids,$status=1){
		return self::where('id','in',$ids)->update(['topped' => $status]);
	}

}
