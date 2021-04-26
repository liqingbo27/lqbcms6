<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Cache;
use think\Model;

class NoticeCategoryModel extends Model
{
	protected $name = 'notice_category';
	protected $pk = 'id';

	// 开启自动写入时间戳字段
	protected $autoWriteTimestamp = false;

	protected $list;                                                           //分类的数据表模型
	protected $rawList = array();                                              //原始的分类数据
	protected $formatList = array();                                           //格式化后的分类
	protected $error = "";                                                      //错误信息
	protected $icon = array('&nbsp;&nbsp;│', '&nbsp;&nbsp;├ ', '&nbsp;&nbsp;└ ');  //格式化的字符
	protected $fields = array();


	public function getList() {
		return $this->order('pid ASC,sort ASC,id ASC')->paginate();
	}

	public function add($param) {
		if(empty($param['name'])){
			return ['code' => 1, 'msg' => '请输入分类名'];
		}
		if(empty($param['id'])){
			unset($param['id']);
			$result =  $this->allowField(true)->save($param);
		}else{
			$result =  $this->allowField(true)->save($param,['id' => $param['id']]);
		}

		if(false === $result){
			return ['code' => 1, 'msg' => $this->getError(), 'url' => ''];
		}else{
			return ['code' => 0, 'msg' => '操作成功！', 'url' => url('classify/index',['pid'=>$param['pid']])];
		}
	}

	public function getOneNewsCategory($id) {
		return $this->where('id', $id)->find();
	}

	public function delNewsCategory($id) {
		try{
			$this->where('id', $id)->delete();
			return ['code' => 1, 'data' => '', 'msg' => '操作成功'];
		}catch( PDOException $e){
			return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
		}
	}

	public function  getFullList($pid=0){
		$this->rawList = self::order('sort ASC')->select()->toArray();
		$this->_searchList($pid);
		return $this->formatList;
	}

	/**
	 * 递归格式化分类前的字符
	 * @param   int     $cid    分类cid
	 * @param   string  $space
	 */
	private function _searchList($pid = 0, $space = "") {
		$childs = $this->getChild($pid);

		//下级分类的数组
		//如果没下级分类，结束递归
		if (!($n = count($childs))) return;

		$m = 1;
		foreach ($childs as $key => $val) {
			$pre = "";
			$pad = "";
			if ($n == $m) {
				$pre = $this->icon[2];
			} else {
				$pre = $this->icon[1];
				$pad = $space ? $this->icon[0] : "";
			}

			$childs[$key]['fullname'] = ($space ? $space . $pre : "") . $val['name'];
			$this->formatList[] = $childs[$key];
			$this->_searchList($val['id'], "&nbsp;&nbsp;".$space); //递归下一级分类
			$m++;
		}
	}

	/**
	 * 返回给定上级分类$pid的所有同一级子分类
	 * @param   int     $pid    传入要查询的pid
	 * @return  array           返回结构信息
	 */
	public function getChild($pid) {
		$childs = array();
		foreach ($this->rawList as $val) {
			if ($val['pid'] == $pid)
				$childs[] = $val;
		}
		return $childs;
	}


	public static function childIdArr($pid=0){
		return self::where('pid',$pid)->column('id');
	}

	public static function groupIdArr($pid=0){
		$idArr = self::childIdArr($pid);
		array_push($idArr,$pid);
		return $idArr;
	}

	public static function getAllList($map=[]){
		return self::where($map)->order('sort ASC')->select()->toArray();
	}

	public static function getTree(){
		$list = self::getAllList();
		return list_to_tree($list);
	}

	public static function updateCache(){
		$list = self::getAllList();
		$tree = list_to_tree($list->toArray());
		Cache::set('notice_list',$list->toArray());
		Cache::set('notice_tree',$tree);
	}



}
