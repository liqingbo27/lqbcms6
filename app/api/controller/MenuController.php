<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: pl125 <xskjs888@163.com>
// +----------------------------------------------------------------------

namespace app\manage\controller;

use app\common\model\MenuModel;

class MenuController extends BaseController
{
	public function getTree()
	{
		$tree = MenuModel::getTree();
		return my_response(0,'',$tree);
	}

	public function getMenuList(){
		$list = MenuModel::getList();
		return my_response(0,'',$list);
	}

	public function getAllList(){
		$pid = input('pid');
		$Menu = new MenuModel();
		$list = $Menu->getFullList($pid);
		return json(['code'=>0,'msg'=>'操作成功','data'=>$list,'total'=>count($list)]);
	}

	/**
	 * 获取分类列表
	 * 2020-01-14 09:09:40 李清波
	 */
	public function getGroupList(){

		$Category = new MenuModel();
		$list = $Category->getFullList();
		return json(['code'=>0,'msg'=>'操作成功','data'=>$list]);
	}

	/**
	 * 添加分类
	 * 2020-01-14 09:09:40 李清波
	 */
	public function add(){
		$data = $this->request->param();
		if(empty($data['id'])){
			unset($data['id']);
			$data['status'] = 1;
			MenuModel::create($data);
		}else{
			MenuModel::update($data);
		}
		return json(['code'=>0,'msg'=>'操作成功']);
	}

	/**
	 * 删除分类
	 * 2020-01-14 09:09:40 李清波
	 */
	public function del(){
		$ids = $this->request->param('ids');
		MenuModel::destroy($ids);
		return json(['code'=>0,'msg'=>'删除成功']);
	}
}
