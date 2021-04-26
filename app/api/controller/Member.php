<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\common\model\MemberModel;

class Member extends Common
{
    public function getList()
    {
        $keyword = input('keyword');
        $map = [];
        if(!empty($keyword)){
            $map[] = ['title','like','%'.$keyword.'%'];
        }
        $list = MemberModel::pageList($map,30);
        return json(['code'=>0,'msg'=>'success','data'=>$list]);
    }

    public function del(){
        $id = $this->request->param('ids');
        $res = MemberModel::destroy($id,true);
        if($res){
            return json(['code'=>0,'msg'=>'删除成功']);
        }else{
            return json(['code'=>1,'msg'=>'删除失败']);
        }
    }

    public function add(){
        $data = $this->request->param('data');
        if(!empty($data['id'])){
            MemberModel::update($data);
        }else{
            unset($data['id']);

            //如果用户名为空，则自动创建用户名
            if(empty($data['username'])){
                $data['username'] = MemberModel::createUserName();
            }
            MemberModel::create($data);
        }
        return json(['code'=>0,'msg'=>'操作成功']);
    }

    public function upload(){

        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        //$savename = \think\facade\Filesystem::putFile( 'topic', $file);
        $savename = \think\facade\Filesystem::disk('storage')->putFile( 'report', $file);

        $path = '/storage/'.str_replace("\\","/",$savename);
        $fullpath = $this->request->scheme().'://'.$this->request->host().$path;
        $data['src'] = $path;
        $data['title'] = '图片';

        return json(['code'=>0, 'msg'=>'登入成功', 'data'=>$data]);
    }


}
