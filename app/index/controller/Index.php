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
	    $newsList = NewsModel::pageList([],12);

        return view('',[
        	'newsToppedList' => $newsToppedList,
        	'newsRecommendedList' => $newsRecommendedList,
        	'newsList3' => $newsList
        ]);
    }

    public function baidutuisong(){

        $urls = array(
		    'http://www.hnhzykj.com',
		    'http://www.hnhzykj.com/news',
		    'http://www.hnhzykj.com/service',
		    'http://www.hnhzykj.com/cases',
		    'http://www.hnhzykj.com/report/show/id/9',
		    'http://www.hnhzykj.com/report/show/id/10',
		    'http://www.hnhzykj.com/recruit/',
		    'http://www.hnhzykj.com/contact/',
		);
        $api = 'http://data.zz.baidu.com/urls?site=www.hnhzykj.com&token=TjvIBK2dRt1eFlOm';
        $ch = curl_init();
        $options =  array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch); //json格式
        $result = json_decode($result,true); //数组格式

        if(isset($result['success'])){
            return json(['code' => 0,  'msg' => '推送'.$result['success'].'条,剩余'.$result['remain'].'条。']);
        }else{
            return json(['code' => 1,  'msg' => '推送：'.$result['message']]);
        }
        exit;


    	$urls = array(
		    'http://www.hnhzykj.com',
		    'http://www.hnhzykj.com/news',
		    'http://www.hnhzykj.com/service',
		    'http://www.hnhzykj.com/cases',
		    'http://www.hnhzykj.com/report/show/id/9',
		    'http://www.hnhzykj.com/report/show/id/10',
		    'http://www.hnhzykj.com/recruit/',
		    'http://www.hnhzykj.com/contact/',
		);
		// update urls
		$api = 'http://data.zz.baidu.com/urls
		site=www.hnhzykj.com&token=TjvIBK2dRt1eFlOm';
		$ch = curl_init();
		$options =  array(
		    CURLOPT_URL => $api,
		    CURLOPT_POST => true,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POSTFIELDS => implode("\n", $urls),
		    CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
		);
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		print_r($result);
    }

    public function test(){
    	echo app()->getRuntimePath();
    	echo env('filesystem.storage', 'public/storage');
    }
}
