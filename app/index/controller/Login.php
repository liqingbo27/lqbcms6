<?php
declare (strict_types = 1);

namespace app\index\controller;
use app\BaseController;
use app\common\model\AdvertModel;
use app\common\model\SettingModel;
use think\captcha\facade\Captcha;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;

class Login extends BaseController
{

    protected function initialize()
    {

    }

    public function verify()
    {

        //'myverify'1
        return Captcha::create();
    }
	
}
