<?php
declare (strict_types = 1);

namespace app\api\controller;
use app\BaseController;

use think\facade\Db;
use app\api\model\MenuModel;
use app\common\model\AdminModel;

use think\captcha\facade\Captcha;
use think\facade\Session;


class Login extends BaseController
{
    public function login(){

        $username = input('username');
        $password = input('password');
        $vercode = input('vercode');


        if( !Captcha::check($vercode)) {
            return json(['code'=>1001, 'msg'=>'验证码错误']);
        }

        $userinfo = AdminModel::where('username',$username)->find();
        if(empty($userinfo)){
            return json(['code'=>1001, 'msg'=>'用户不存在']);
        }

        if(!password_verify( $password, $userinfo->password)){
            return json(['code'=>1001, 'msg'=>'密码错误']);
        }

        Session::set('admin_id', $userinfo->id);
        Session::set('adminInfo', $userinfo);

        $access_token = 'my_access_token';
        $data = [
            'access_token' => $access_token
        ];
        return json(['code'=>0, 'msg'=>'登入成功', 'data'=>$data]);
    }

    /**
     * 判断是否还是登录状态
     * 2020-01-16 15:57:27 李清波
     */
    public function checkLogin(){
        $admin_id = Session::get('admin_id');
        if(empty($admin_id)){
            return json(['code'=>111, 'msg'=>'登录失效']);
        }else{
            return json(['code'=>0, 'msg'=>'登录状态']);
        }
    }

    public function logout(){
        Session::delete('admin_id');
        Session::delete('adminInfo');
        return json(['code'=>0, 'msg'=>'退出成功']);
    }

    public function verify()
    {
        //'myverify'
        return Captcha::create();
    }

    public function chushihua(){
        return 1;
        $passowrd = password_hash('123456',PASSWORD_DEFAULT);

        $res = AdminModel::update(['id'=>1,'passowrd'=>$passowrd]);
        print_r($res);
        return 1;
    	AdminModel::create([
    		'role_id' => 1,
    		'username' => 'admin',
    		'nickname' => 'admin',
    		'password' => password_hash('123456',PASSWORD_DEFAULT),
    		'phone' => '18888888888'
    	]);
    }

    public function test(){
        return 1;
        $list = AdminModel::select();
        print_r($list);
        exit;
        $p = '123456';
        // return $ps = mypassword($p);

        $ps = '$2y$10$ycAv./KeM5OoZ.tfm6NDYev6q2aa1c6yk.l3JroWIUFD8XZd6nVCq';
        $verify = password_verify('123456', $ps);
        if($verify){
            echo 1;
        }else{
            echo 0;
        }
    }
}
