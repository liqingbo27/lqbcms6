<?php
declare (strict_types = 1);

namespace app\api\controller;
use app\common\model\ClientModel;

class Client extends Common
{
    public function getList()
    {
      $list = ClientModel::pageList();
      return json(['code'=>0,'msg'=>'success','data'=>$list]);
    }
}
