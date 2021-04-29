<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Cache;
use think\facade\Session;
use think\Model;

class UserfilesModel extends Model
{
	protected $name = 'userfiles';
	protected $pk = 'id';

	// 开启自动写入时间戳字段
	protected $autoWriteTimestamp = true;

	public static function add($filepath){
		self::create([
			'savepath' => $filepath,
			'path' => $filepath,
		]);
	}
}
