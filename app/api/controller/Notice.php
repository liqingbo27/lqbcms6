<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\common\model\NewsModel;
use app\common\model\NoticeCategoryModel;
use app\common\model\NoticeModel;

class Notice extends Common
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

        $list = NoticeModel::pageList($this->comMap);
        return json(['code'=>0,'msg'=>'success','data'=>$list]);
    }

    public function del(){
        $id = $this->request->param('ids');
        NoticeModel::destroy($id);
        return json(['code'=>0,'msg'=>'删除成功']);
    }

    public function add(){
        $data = $this->request->param('data');
        if(!empty($data['create_time'])){
            $data['create_time'] = strtotime($data['create_time']);
        }
        
        if(!empty($data['id'])){
            NoticeModel::update($data);
        }else{
            unset($data['id']);
            $data['admin_id'] = session('admin_id');
            NoticeModel::create($data);
        }
        return json(['code'=>0,'msg'=>'操作成功']);
    }

	public function changeStatus(){
		$id = $this->request->param('id');
		$info = NoticeModel::find($id);
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

	/**
	 * 获取分类列表
	 * 2020-01-14 09:09:40 李清波
	 */
	public function getCategoryList(){
		//$map[] = ['status','=',1];
		$NoticeCategory =  new NoticeCategoryModel();
		$list = $NoticeCategory->getFullList();
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
			NoticeCategoryModel::create($data);
		}else{
			NoticeCategoryModel::update($data);
		}
		return json(['code'=>0,'msg'=>'操作成功']);
	}

	/**
	 * 删除分类
	 * 2020-01-14 09:09:40 李清波
	 */
	public function categoryDel(){
		$ids = $this->request->param('ids');
		NoticeCategoryModel::destroy($ids);
		return json(['code'=>0,'msg'=>'删除成功']);
	}




}
