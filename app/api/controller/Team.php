<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\common\model\TeamModel;

class Team extends Common
{
    public function getList()
    {
        $keyword = input('keyword');
        $category_id = input('category_id');


        if(!empty($keyword)){
            $this->comMap[] = ['title','like','%'.$keyword.'%'];
        }
        if(!empty($category_id)){
            $this->comMap[] = ['category_id','=',$category_id];
        }

        $list = TeamModel::pageList($this->comMap);
        return json(['code'=>0,'msg'=>'success','data'=>$list]);
    }

    public function del(){
        $id = $this->request->param('ids');
        TeamModel::destroy($id);
        return json(['code'=>0,'msg'=>'删除成功']);
    }

    public function add(){
        $data = $this->request->param('data');
        if(!isset($data['status'])){
	        $data['status'] = 0;
        }
        if(!empty($data['id'])){
            TeamModel::update($data);
        }else{
            unset($data['id']);
            $data['admin_id'] = session('admin_id');
            TeamModel::create($data);
        }
        return json(['code'=>0,'msg'=>'操作成功']);
    }


}
