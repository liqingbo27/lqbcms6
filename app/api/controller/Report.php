<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\common\model\MemberModel;
use app\common\model\ReportAllowModel;
use app\common\model\ReportModel;

class Report extends Common
{
    public function getList()
    {
        $keyword = input('keyword');
        $map = [];
        if(!empty($keyword)){
            $map[] = ['title','like','%'.$keyword.'%'];
        }
        $list = ReportModel::pageList($map);
        return json(['code'=>0,'msg'=>'success','data'=>$list]);
    }

    public function del(){
        $id = $this->request->param('ids');
        $res = ReportModel::destroy($id,true);
        if($res){
            return json(['code'=>0,'msg'=>'删除成功']);
        }else{
            return json(['code'=>1,'msg'=>'删除失败']);
        }
    }

    public function add(){
        $data = $this->request->param('data');
        if(!empty($data['attach'])){
            $data['attach_name'] = basename($data['attach']);;
        }
        if(!empty($data['id'])){
            $data['code'] = self::createCode();
            ReportModel::update($data);
        }else{
            unset($data['id']);
            $data['admin_id'] = session('admin_id');
            $data['code'] = self::createCode();
            ReportModel::create($data);
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

    public function getUserList(){
        $report_id = input('report_id');
        $memberArr = ReportAllowModel::getMemberIds($report_id);
        $map = [];
        $memberList = MemberModel::where($map)->limit(100)->select();
        foreach ($memberList as $key=>$val){
            if(in_array($val->id,$memberArr)){
                $val->checked = 'checked=""';
            }
        }
        return json(['code'=>0, 'msg'=>'success', 'data'=>$memberList]);
    }

    public function setAllow(){
        $report_id = input('report_id');
        $member_id = input('member_id');
        $checked = input('checked');

        $data = [
            'report_id' => $report_id,
            'member_id' => $member_id
        ];

        $info = ReportAllowModel::where('report_id',$report_id)->where('member_id',$member_id)->find();
        if($checked==1){
            if(empty($info)){
                ReportAllowModel::create($data);
            }
        }else{
            if(!empty($info)){
                ReportAllowModel::destroy($info->id);
            }
        }

        return json(['code'=>0, 'msg'=>'操作成功','data'=>$data,'checked'=>$checked]);
    }

    public function createCode(){
        return md5(time().rand(10000,99999));
    }

}
