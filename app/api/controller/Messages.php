<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\common\model\MessagesModel;

class Messages extends Common
{
    public function getList()
    {
        $keyword = input('keyword');
        $map = [];
        if(!empty($keyword)){
            $map[] = ['nickname|phone','like','%'.$keyword.'%'];
        }
        $list = MessagesModel::pageList($map);
        return json(['code'=>0,'msg'=>'success','data'=>$list]);
    }

    public function del(){
        $id = $this->request->param('ids');
        $res = MessagesModel::destroy($id,true);
        if($res){
            return json(['code'=>0,'msg'=>'删除成功']);
        }else{
            return json(['code'=>1,'msg'=>'删除失败']);
        }
    }

    public function add(){
        $data = $this->request->param('data');

        if(!empty($data['id'])){
            MessagesModel::update($data);
        }else{
            unset($data['id']);
            MessagesModel::create($data);
        }
        return json(['code'=>0,'msg'=>'操作成功']);
    }

}
