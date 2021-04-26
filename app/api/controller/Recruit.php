<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\common\model\RecruitModel;

class Recruit extends Common
{
    public function getList()
    {
        $keyword = input('keyword');
        if(!empty($keyword)){
            $this->comMap[] = ['title','like','%'.$keyword.'%'];
        }
        $list = RecruitModel::pageList($this->comMap);
        return json(['code'=>0,'msg'=>'success','data'=>$list]);
    }

    public function del(){
        $id = $this->request->param('ids');
        $res = RecruitModel::destroy($id,true);
        if($res){
            return json(['code'=>0,'msg'=>'删除成功']);
        }else{
            return json(['code'=>1,'msg'=>'删除失败']);
        }
    }

    public function add(){
        $data = $this->request->param('data');

	    if(!empty($data['create_time'])){
		    $data['create_time'] = strtotime($data['create_time']);
	    }
        if(!empty($data['id'])){
            RecruitModel::update($data);
        }else{
            unset($data['id']);
            RecruitModel::create($data);
        }
        return json(['code'=>0,'msg'=>'操作成功']);
    }

}
