<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\common\model\ServiceModel;
use think\facade\View;

class Service extends Common
{
    public function index()
    {

        $map = [];
        $list = ServiceModel::pageList($map);
        View::assign('list',$list);
        return view();
    }

    public function show(){
        $id = input('id');
        $info = ServiceModel::info($id);

        $prev = ServiceModel::prev($id);
        $next = ServiceModel::next($id);

        View::assign('info',$info);
        View::assign('prev',$prev);
        View::assign('next',$next);

        ServiceModel::where('id', $id)->inc('clicks', 1)->update();
        return view('info');
    }
}
