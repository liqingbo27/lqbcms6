<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\common\model\NewsCategoryModel;
use app\common\model\NewsModel;
use app\common\model\SettingModel;

class Setting extends Common
{
    public function myUpdate()
    {
        $group = input('group');
        $data = $this->request->param();

        if(empty($group)){
            return json(['code'=>1, 'msg'=>'参数错误']);
        }
        if(empty($data)||!is_array($data)){
            return json(['code'=>1, 'msg'=>'参数错误']);
        }

        unset($data['group']);
        unset($data['file']);
        SettingModel::singleUpdate($data,$group,'add');

        return json(['code'=>0,'msg'=>'操作成功','data'=>$group]);
    }

    public function getSettingList(){
    	$group = input('group');
        $map = [
        	['group','=',$group]
        ];
        $list = SettingModel::where($map)->column('value','name');
        return json(['code'=>0,'msg'=>'操作成功','data'=>$list]);
    }


    /**
     * 上传二维码
     * 2020-01-13 10:52:51 李清波
     */
    public function uploadQrcode(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');

        // 上传到本地服务器
        //$savename = \think\facade\Filesystem::putFile( 'topic', $file);
        $savename = \think\facade\Filesystem::disk('sti')->putFile( 'images', $file);

        $path = '/uploads/'.str_replace("\\","/",$savename);
        $fullpath = $this->request->scheme().'://'.$this->request->host().$path;

        $data['url'] = $path;
        $data['title'] = '图片';

        return json(['code'=>0, 'msg'=>'上传成功', 'data'=>$data, 'fullpath'=>$fullpath]);
    }


}
