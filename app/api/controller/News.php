<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\common\model\NewsCategoryModel;
use app\common\model\NewsContentModel;
use app\common\model\NewsModel;
use think\console\Input;

class News extends Common
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

        $list = NewsModel::pageList($this->comMap);
        return json(['code'=>0,'msg'=>'success','data'=>$list,'map'=>$this->comMap]);
    }

    public function del(){
        $id = $this->request->param('ids');
        NewsModel::destroy($id);
        return json(['code'=>0,'msg'=>'删除成功']);
    }

	public function recommending(){
		$ids = $this->request->param('ids');
		$status = $this->request->param('status',1);
		NewsModel::recommending($ids,$status);
		return json(['code'=>0,'msg'=>'操作成功']);
	}

	public function topping(){
		$ids = $this->request->param('ids');
		$status = $this->request->param('status',1);
		NewsModel::topping($ids,$status);
		return json(['code'=>0,'msg'=>'操作成功']);
	}

    public function add(){
        $data = $this->request->param('data');
        if(!empty($data['create_time'])){
            $data['create_time'] = strtotime($data['create_time']);
        }

        if(!empty($data['id'])){
            NewsModel::update($data);
            NewsContentModel::updateByMain($data['id'],$data['content']);
        }else{
            unset($data['id']);
            $data['admin_id'] = session('admin_id');
            $Info = NewsModel::create($data);
	        NewsContentModel::updateByMain($Info->id,$data['content']);
        }
        return json(['code'=>0,'msg'=>'操作成功']);
    }

    /**
     * 获取分类列表
     * 2020-01-14 09:09:40 李清波
     */
    public function getCategoryList(){
        $lang = input('lang');
        $NewsCategory =  new NewsCategoryModel();
        $list = $NewsCategory->getFullList();
        foreach ($list as $key=>$val){
			if($lang=='en'){
				$list[$key]['name'] = $val['ename'];
			}
        }
        return json(['code'=>0,'msg'=>'操作成功','data'=>$list]);
    }

    /**
     * 添加分类
     * 2020-01-14 09:09:40 李清波
     */
    public function categoryAdd(){
        $data = $this->request->param();
        if(empty($data['id'])){
            unset($data['id']);
            NewsCategoryModel::create($data);
        }else{
            NewsCategoryModel::update($data);
        }
        return json(['code'=>0,'msg'=>'操作成功']);
    }

    /**
     * 删除分类
     * 2020-01-14 09:09:40 李清波
     */
    public function categoryDel(){
        $ids = $this->request->param('ids');
        NewsCategoryModel::destroy($ids);
        return json(['code'=>0,'msg'=>'删除成功']);
    }


	/**
	 * Created by LQBCSM.
	 * Site：https://www.lqbcms.com
	 * Author: 李清波
	 * Date: 2021-5-21 15:57
	 *
	 */
    public function changeStatus(){
	    $id = $this->request->param('id');
	    $info = NewsModel::find($id);
	    if($info->status==1){
		    $info->status=0;
		    $msg = '已禁用';
	    }else{
		    $info->status=1;
		    $msg = '已启用';
	    }
	    $info->save();
	    return json(['code'=>0,'msg'=>$msg]);
    }

}
