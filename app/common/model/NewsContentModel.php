<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Cache;
use think\facade\Session;
use think\Model;

class NewsContentModel extends Model
{
	protected $name = 'news_content';
	protected $pk = 'id';

	// 开启自动写入时间戳字段
	protected $autoWriteTimestamp = false;


	public static function getContentById($id){
		return self::where('id',$id)->value('content');
	}

	public static function updateByMain($id,$content){
		$cInfo = self::find($id);
		if(!empty($cInfo)){
			self::where('id',$id)->update([
				'content' => $content
			]);
		}else{
			self::create([
				'id' => $id,
				'content' => $content
			]);
		}

	}
}
