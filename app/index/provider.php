<?php
use app\ExceptionHandle;
use app\Request;

// 这是系统自动生成的provider定义文件

return [
	'think\Request'          => Request::class,
	'think\exception\Handle' => ExceptionHandle::class,
	'think\Paginator'    =>    'app\common\Bootstrap'
];
