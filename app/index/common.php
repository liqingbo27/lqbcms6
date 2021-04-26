<?php
// 这是系统自动生成的公共文件
use think\facade\Db;

function get_current_lang(){
	$lang = \think\facade\Session::get('lang');
	if(empty($lang)){
		return 'zh';
	}else{
		return $lang;
	}
}

function static_path(){
    return '/static/index';
}

function setNavAvctive($path,$controllerName,$actionName=''){
    $current = $controllerName.'_'.$actionName;
    if(!empty($actionName)){
        if($path==$current){
            return 'class="active"';
        }
    }
    if($path==$controllerName){
        return 'class="active"';
    }
}


function get_news_list($cid,$limit=10){
     return $list = \app\common\model\NewsModel::listByCategory($cid,$limit);
}

function news_category_list($cid){
    $map = [];
    if(!empty($cid)){
        $map[] = ['pid','=',$cid];
    }
    $list = Db::name('news_category')->where( $map )->order('sort ASC')->select()->toArray();
    return $list;

}

function get_news_category_name($category_id){
	return \app\common\model\NewsCategoryModel::where('id',$category_id)->value('name');
}


function news_list_url($cid){
     return '/news/index/cid/'.$cid;
}

function notice_list_url($cid){
	if(!empty($cid)){
		return '/notice/index/cid/'.$cid;
	}else{
		return '/notice/index';
	}
}

function notice_category_list($cid){
	$map = [];
	if(!empty($cid)){
		$map[] = ['pid','=',$cid];
	}
	$list = Db::name('notice_category')->where( $map )->select()->toArray();
	return $list;

}

function get_notice_list($cid,$limit=10){
	return $list = \app\common\model\NoticeModel::listByCategory($cid,$limit);
}

function get_singlepage_info($var,$field='')
{
	$lang = get_current_lang();
    $info = \app\common\model\SinglepageModel::where('varname',$var)->where('lang',$lang)->find();
    if($info->status==0){
        $info->content = '';
        $info->description = '';
        $info->thumb = '';
    }
   if(!empty($field)){
    return $info[$field];
   	// return \app\common\model\SinglepageModel::where('varname',$var)->value($field);
   }
   return $info;
}