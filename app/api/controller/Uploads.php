<?php
declare (strict_types = 1);

namespace app\api\controller;
use app\BaseController;

use app\common\model\UserfilesModel;
use think\facade\Db;
use app\api\model\MenuModel;

class Uploads extends BaseController
{
    public function edit(){

        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');

        /*print_r($_FILES);
        print_r($file);
        exit;*/

        // 上传到本地服务器
        //$savename = \think\facade\Filesystem::putFile( 'topic', $file);
        $savename = \think\facade\Filesystem::disk('storage')->putFile( 'edit', $file);

        $fullname = $this->request->scheme().'://'.$this->request->host().'/storage/'.$savename;

        $data['src'] = $fullname;
        $data['title'] = '图片';

        return json(['code'=>0, 'msg'=>'登入成功', 'data'=>$data]);
    }

    public function thumb(){
	    $file = request()->file('file');
	    $column = input('column','pool');

	    $savename = \think\facade\Filesystem::disk('public')->putFile( $column, $file);

	    $path = env('filesystem.storage','/storage').'/'.str_replace("\\","/",$savename);
	    $fullpath = $this->request->scheme().'://'.$this->request->host().$path;

	    $data['src'] = $path;
	    $data['fullpath'] = $fullpath;
	    $data['title'] = '图片';

	    UserfilesModel::add($path);

	    return json(['code'=>0, 'msg'=>'登入成功', 'data'=>$data]);
    }

}
