<?php
declare (strict_types = 1);

namespace app\api\controller;


use app\common\model\AdminModel;
use app\common\model\AdvertModel;

class Advert extends Common
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
        $list = AdvertModel::pageList($this->comMap);
        return json(['code'=>0,'msg'=>'success','data'=>$list]);
    }

    public function del(){
        $id = $this->request->param('ids');
        AdvertModel::destroy($id,true);
        return json(['code'=>0,'msg'=>'删除成功']);
    }

    public function add(){
        $data = $this->request->param();
        if(empty($data)||!is_array($data)){
            return json(['code'=>1,'msg'=>'数据错误','data'=>$data]);
        }

        if(!empty($data['id'])){
            AdvertModel::update($data);
        }else{
            unset($data['id']);
            AdvertModel::create($data);
        }
        return json(['code'=>0,'msg'=>'操作成功']);
    }

    public function upload(){

        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        //$savename = \think\facade\Filesystem::putFile( 'topic', $file);
        $savename = \think\facade\Filesystem::disk('storage')->putFile( 'advert', $file);

        $path = '/storage/'.str_replace("\\","/",$savename);
        $fullpath = $this->request->scheme().'://'.$this->request->host().$path;
        $data['src'] = $path;
        $data['title'] = '图片';

        return json(['code'=>0, 'msg'=>'登入成功', 'data'=>$data]);
    }

    public function changeField(){
    	$param = input();
    	$data[$param['field']] = $param['value'];
    	AdvertModel::where('id','=',$param['id'])->update($data);

	    return json(['code'=>0, 'msg'=>'success','param'=>$param,'data'=>$data]);
    }


}
