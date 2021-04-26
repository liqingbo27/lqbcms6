<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\common\model\FriendlinkModel;

class Friendlink extends Common
{
    public function getList()
    {
        $keyword = input('keyword');

        $map = [];
        if(!empty($keyword)){
            $map[] = ['title','like','%'.$keyword.'%'];
        }
        $list = FriendlinkModel::pageList($map);
        return json(['code'=>0,'msg'=>'success','data'=>$list]);
    }

    public function del(){
        $id = $this->request->param('ids');
        FriendlinkModel::destroy($id);
        return json(['code'=>0,'msg'=>'删除成功']);
    }

    public function add(){
        $data = $this->request->param('data');
        if(!empty($data['id'])){
            FriendlinkModel::update($data);
        }else{
            unset($data['id']);
            $data['admin_id'] = session('admin_id');
            FriendlinkModel::create($data);
        }
        return json(['code'=>0,'msg'=>'操作成功']);
    }

}
