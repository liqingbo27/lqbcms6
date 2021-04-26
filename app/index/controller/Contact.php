<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\common\model\NewsModel;
use app\common\model\SinglepageModel;
use think\facade\View;

class Contact extends Common
{
    public function index(){
        return view('contact/index');
    }
}
