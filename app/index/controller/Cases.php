<?php
declare (strict_types = 1);

namespace app\index\controller;
use app\common\model\CasesModel;
use think\facade\View;


class Cases extends Common
{
    public function index()
    {
        $cid = input('cid');
        $map = [];
        if(!empty($cid)){
            $map[] = ['category_id','=',$cid];
        }
        $list = CasesModel::pageList($map,6);

        // 获取分页显示
        $page = $list->render();

        return view('index',['list'=>$list,'page'=>$page]);
    }

    public function show(){
        $id = input('id');
        $info = CasesModel::info($id);
        CasesModel::where('id', $id)->inc('clicks', 1)->update();;

        $prev = CasesModel::prev($id);
        $next = CasesModel::next($id);

        View::assign('info',$info);
        View::assign('prev',$prev);
        View::assign('next',$next);
        return view('info');
    }
}
