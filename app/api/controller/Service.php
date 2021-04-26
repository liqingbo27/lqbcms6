<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\common\model\ServiceModel;
use think\console\Input;

class Service extends Common
{
    public function getList()
    {
        $keyword = input('keyword');
        $map = [];
        if(!empty($keyword)){
            $map[] = ['title','like','%'.$keyword.'%'];
        }
        $list = ServiceModel::pageList($map);
        return json(['code'=>0,'msg'=>'success','data'=>$list]);
    }

    public function del(){
        // return json(['code'=>0,'msg'=>'有些页面需要固定文章链接，所以暂时不开放删除功能']);

        $id = $this->request->param('ids');
        $res = ServiceModel::destroy($id,true);
        if($res){
            return json(['code'=>0,'msg'=>'删除成功']);
        }else{
            return json(['code'=>1,'msg'=>'删除失败']);
        }
    }

    public function add(){
        $data = $this->request->param('data');

        if(!empty($data['id'])){
            ServiceModel::update($data);
        }else{
            unset($data['id']);
            $data['admin_id'] = session('admin_id');
            ServiceModel::create($data);
        }
        return json(['code'=>0,'msg'=>'操作成功']);
    }

}
