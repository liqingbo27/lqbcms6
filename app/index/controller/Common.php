<?php
declare (strict_types = 1);

namespace app\index\controller;
use app\BaseController;
use app\common\model\AdvertModel;
use app\common\model\AdminModel;
use app\common\model\SettingModel;
use app\common\model\NewsCategoryModel;
use app\common\model\SinglepageModel;
use think\facade\Route;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;

class Common extends BaseController
{

	protected  $lang = 'zh';

    protected function initialize()
    {
    	$controllerName = Request::controller(true);
    	$actionName = Request::action(true);

        View::assign('controllerName',$controllerName);
        View::assign('actionName',$actionName);
	    $this->lang = 'default';

	    View::config(['view_path' => '../view/'.$this->lang.'/']);


		if(!empty($lang)){
			// 手动输入语言参数不存在的时候默认显示中文
			if(!in_array($lang,['zh','en'])){
				$lang = 'zh';
			}
			Session::set('lang',$lang);
			$this->lang = $lang;
		}else{
			$this->lang = Session::get('lang');
		}
	    if(empty($this->lang)){
		    $this->lang = 'zh';
	    }

        if($this->lang=='en'){
        	$switchLang = 'zh';
        }else{
	        $switchLang = 'en';
        }
	    View::assign('switchLang',$switchLang);




	    $config = SettingModel::where('group',$this->lang)->column('value','name');
	    View::assign('config',$config);


	    //获取文章分类 存入变量中
	    $newsCategoryList = NewsCategoryModel::order('sort ASC')->select();
	    foreach ($newsCategoryList as $key=>$val){
	    	if($this->lang=='zh'){
			    $newsCategoryArr[$val->id] = $val->name;
		    }else{
			    $newsCategoryArr[$val->id] = $val->ename;
		    }
	    }
	    View::assign('newsCategoryArr',$newsCategoryArr);


	    $singlepageList = SinglepageModel::where('lang',$this->lang)->field('id,varname,title')->order('sort asc')->select();
	    foreach ($singlepageList as $key=>$val){
		    $singlepageArr[$val->varname] = $val->title;
	    }
	    View::assign('singlepageArr',$singlepageArr);


	    $advertList2 = AdvertModel::allList([['place','=',2]],4);
	    View::assign('advertList2',$advertList2);
    }


	
}
