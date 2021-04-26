<?php
declare (strict_types = 1);

namespace app\api\controller;

use think\facade\Db;
use app\api\model\MenuModel;

class Index
{

	/**
	 * Created by LQBCSM.
	 * Site：https://www.liqingbo.cn
	 * Author: 李清波
	 * Date: 2021-4-26 19:02
	 *
	 */
    public function index()
    {
        $info = MenuModel::getTree();
        return my_response(0,'',$info);
    }


}
