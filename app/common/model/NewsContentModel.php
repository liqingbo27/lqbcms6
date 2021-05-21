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


}
