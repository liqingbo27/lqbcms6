<?php
declare (strict_types = 1);

namespace app\index\controller;
use app\BaseController;
use app\common\model\AdvertModel;
use app\common\model\SettingModel;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;

class Api extends BaseController
{


	public function changeLange(){
		$lang = input('lang','cn');
		Session::set('lang',$lang);
		return my_response(0,'success',$lang);
	}
	
}
