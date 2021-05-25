<?php
declare (strict_types = 1);

namespace app\index\controller;
use app\common\model\AdvertModel;
use app\common\model\FriendlinkModel;
use app\common\model\NewsModel;
use app\common\model\TeamModel;
use think\facade\Route;
use think\facade\View;

class Index extends Common
{
	/**
	 * Created by LQBCSM.
	 * Site：https://www.liqingbo.cn
	 * Author: 李清波
	 * Date: 2021-4-26 19:32
	 *
	 * @return \think\response\View
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\DbException
	 * @throws \think\db\exception\ModelNotFoundException
	 */
    public function index()
    {

	    $advertList = AdvertModel::allList([['place','=',1]],999);
	    View::assign('advertList',$advertList);

	    $friendlinkList = FriendlinkModel::allList([],14);
	    View::assign('friendlinkList',$friendlinkList);

	    $newsToppedList = NewsModel::getToppedList(6);
	    $newsRecommendedList = NewsModel::getRecommendedList(8);


	    $nMap = [];
	    $nMap[] = ['recommended','=',0];
	    $nMap[] = ['hotted','=',0];
	    $nMap[] = ['topped','=',0];
	    $nMap[] = ['status','=',1];
	    $newsList = NewsModel::pageList($nMap,6);

	    $i = 1;
	    $up = 0;
	    $newsRecommendedTree = [];
	    foreach ($newsRecommendedList as $key => $val) {
		    $newsRecommendedTree[$i]['sub'][] = $val;
		    if($up>=1){
				$up=0;
			    $i++;
		    }else{
			    $up++;
		    }
	    }

	    $i = 0;
	    $up = 0;
	    $newsTree = [];
	    foreach ($newsList as $key => $val) {
		    $newsTree[$i]['sub'][] = $val;
		    if($up==1){
			    $up=0;
			    $i++;
		    }else{
			    $up++;
		    }
	    }

        return view('',[
        	'newsToppedList' => $newsToppedList,
        	'newsRecommendedList' => $newsRecommendedList,
        	'newsRecommendedTree' => $newsRecommendedTree,
        	'newsList' => $newsList,
        	'newsTree' => $newsTree
        ]);
    }

    public function test(){
    	echo app()->getRuntimePath();
    	echo env('filesystem.storage', 'public/storage');
    }
}
