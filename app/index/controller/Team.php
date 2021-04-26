<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\common\model\TeamModel;
use think\facade\View;

class Team extends Common
{

	protected function initialize()
	{
		parent::initialize();

	}
    public function zhuanjia()
    {
	    $map[] = ['category_id','=',1];
	    $map[] = ['lang','=',$this->lang];
	    $map[] = ['status','=',1];
        $list = TeamModel::pageList($map,9);
        // 获取分页显示
        $page = $list->render();

        if($this->lang=='en'){
        	$categoryName = 'Experts';
        }else{
	        $categoryName = '专家团队';
        }

	    View::assign('categoryName',$categoryName);
        return view('index',['list'=>$list,'page'=>$page,'info'=>['varname'=>'假数据']]);
    }

    public function lishihui(){

	    $map[] = ['category_id','=',2];
	    $map[] = ['lang','=',$this->lang];
	    $map[] = ['status','=',1];
	    $list = TeamModel::pageList($map,9);
	    // 获取分页显示
	    $page = $list->render();

	    if($this->lang=='en'){
		    $categoryName = 'Board Members';
	    }else{
		    $categoryName = '理事会成员';
	    }

	    View::assign('categoryName',$categoryName);

	    $list1 = TeamModel::lishiList('理事长',$this->lang,5);
	    $list2 = TeamModel::lishiList('常务副理事长',$this->lang,200);
	    $list3 = TeamModel::lishiList('副理事长',$this->lang,200);
	    $list4 = TeamModel::lishiList('理事',$this->lang,200);
	    View::assign('list1',$list1);
	    View::assign('list2',$list2);
	    View::assign('list3',$list3);
	    View::assign('list4',$list4);

	    return view('member',['list'=>$list,'page'=>$page,'info'=>['varname'=>'假数据']]);
    }

    public function show(){
        $id = input('id');
        $info = TeamModel::info($id);
        TeamModel::where('id', $id)->inc('clicks', 1)->update();

        $prev = TeamModel::prev($info);
	    $next = TeamModel::next($info);

        View::assign('info',$info);
        View::assign('prev',$prev);
        View::assign('next',$next);

	    View::assign('categoryName',TeamModel::$categoryArr[$info->category_id]);
        if($info->category_id==1){
            $category_tag = 'zhuanjia';
        }else{
            $category_tag = 'lishihui';
        }
        View::assign('categoryTag',$category_tag);
        return view('info');
    }
}
