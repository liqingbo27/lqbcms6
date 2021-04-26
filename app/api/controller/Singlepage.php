<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\common\model\SinglepageModel;

class Singlepage extends Common
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
        $list = SinglepageModel::pageList($this->comMap);
        return json(['code'=>0,'msg'=>'success','data'=>$list,'map'=>$this->comMap]);
    }

    public function del(){
        $id = $this->request->param('ids');
        $res = SinglepageModel::destroy($id,true);
        if($res){
          return json(['code'=>0,'msg'=>'删除成功']);
        }else{
            return json(['code'=>1,'msg'=>'删除失败']);
        }
    }

    public function add(){
        $data = $this->request->param('data');
        /*print_r($data);
        exit;*/

        if(!empty($data['id'])){
            SinglepageModel::update($data);
        }else{
            unset($data['id']);
            $data['admin_id'] = session('admin_id');
            SinglepageModel::create($data);
        }
        return json(['code'=>0,'msg'=>'操作成功']);
    }

    public function getVarList(){
    	$lang = input('lang');
    	if($lang=='en'){
		    $list = SinglepageModel::$varArrEn;
	    }else{
		    $list = SinglepageModel::$varArr;
	    }

	    return json(['code'=>0,'msg'=>'success','data'=>$list]);
    }


}
