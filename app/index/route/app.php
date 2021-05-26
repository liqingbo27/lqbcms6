<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});


// 绑定当前的URL到 index模块
Route::bind('index');

//Route::get('/','index/index');
//Route::rule('news/','news/index');
Route::get('news/show-:id','news/show');
Route::get('news/list-:cid','news/index');
Route::get('news/list-:cid','news/index');
Route::get('xiuxing','about/show')->pattern(['var' => 'xiuxing']);



