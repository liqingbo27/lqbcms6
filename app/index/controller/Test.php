<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\common\model\CasesModel;
use app\common\model\NewsModel;
use app\common\model\NoticeModel;
use app\common\model\RecruitModel;

class Test extends Common
{
    public function index()
    {
    	echo get_current_lang();
    	$newsList3 = NewsModel::listByCategory(3,12);

    	print_r($newsList3);
        /*NewsModel::where('id','>',0)->update(['lang'=>'zh']);
        RecruitModel::where('id','>',0)->update(['lang'=>'zh']);
        CasesModel::where('id','>',0)->update(['lang'=>'zh']);
        NoticeModel::where('id','>',0)->update(['lang'=>'zh']);*/
    }

}
