<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\index\controller\Common;
use app\common\model\RecruitModel;

class Recruit extends Common
{
    public function index()
    {
        $cid = input('cid');
        $map = [];
        if(!empty($cid)){
            $map[] = ['category_id','=',$cid];
        }
	    $map[] = ['lang','=',$this->lang];
	    $map[] = ['status','=',1];
        $list = RecruitModel::pageList($map,10);

        // 获取分页显示
        $page = $list->render();
        //$list = [];
        

        return view('index',['list'=>$list,'page'=>$page]);
    }

    public function show(){
        $id = input('id');
        $info = RecruitModel::info($id);
        if($info->status==0){
        	echo '暂无预览权限';
        	exit;
        }

        $prev = RecruitModel::prev($id);
        $next = RecruitModel::next($id);

        return view('info',['info'=>$info,'prev'=>$prev,'next'=>$next,]);
    }
}
