<?php
declare (strict_types = 1);

namespace app\api\controller;
use app\common\model\AdminModel;
use think\facade\Session;


class Admin extends Common
{
    public function getInfo(){
        return json(['code'=>0, 'msg'=>'success', 'data'=>'data']);
    }

    public function getInfoBySession(){
    	$admin_id = Session::get('admin_id');
    	$info = Session::get('adminInfo');
    	if(!empty($admin_id)){
    		return json(['code'=>0, 'msg'=>'success','data'=>$info]);
    	}else{
    		return json(['code'=>1, 'msg'=>'success','data'=>[]]);
    	}
    }

    public function saveInfoBySession(){
        $admin_id = Session::get('admin_id');
        $info = Session::get('adminInfo');
        $data = $this->request->param('data');

        if(empty($admin_id)){
            return json(['code'=>1, 'msg'=>'请先登录','data'=>[]]);
        }

        $adminData = AdminModel::find($admin_id);
        $adminData->nickname = $data['nickname'];
        $adminData->phone = $data['phone'];
        $adminData->email = $data['email'];
        $adminData->remark = $data['remark'];
        $res = $adminData->save();

        if($res){
            Session::set('adminInfo', $adminData);
            return json(['code'=>0, 'msg'=>'操作成功','data'=>$adminData]);
        }else{
            return json(['code'=>1, 'msg'=>'操作失败','data'=>[]]);
        }
    }

    public function changePasswordBySession(){
        $admin_id = Session::get('admin_id');
        $info = Session::get('adminInfo');
        $data = $this->request->param('data');

        if(empty($admin_id)){
            return json(['code'=>1, 'msg'=>'请先登录','data'=>[]]);
        }

        if($data['password']!=$data['repassword']){
            return json(['code'=>1, 'msg'=>'两次密码不一致']);
        }

        $adminData = AdminModel::find($admin_id);

        if(!password_verify( $data['oldPassword'], $adminData->password)){
            return json(['code'=>1, 'msg'=>'密码错误']);
        }

        $adminData->password = password_hash($data['password'],PASSWORD_DEFAULT);
        $res = $adminData->save();

        if($res){
            Session::delete('admin_id');
            Session::delete('adminInfo');
            return json(['code'=>0, 'msg'=>'操作成功,请重新登录']);
        }else{
            return json(['code'=>1, 'msg'=>'操作失败','data'=>[]]);
        }
    }

}
