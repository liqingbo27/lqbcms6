<?php
declare (strict_types = 1);

namespace app\index\controller;
use app\common\model\CasesModel;
use app\common\model\MessagesModel;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;


class Messages extends Common
{


    public function add(){
        $nickname = input('nickname');
        $remark = input('remark');
        $phone = input('phone');

        $nowTime = time();
        $last_messages_time = Session::get('last_messages_time');
        if(!empty($last_messages_time)){
            if($last_messages_time+10>$nowTime){
                return json(['code'=>1, 'msg'=>'你留言太快了，休息一下吧']);
            }
        }


        MessagesModel::create([
            'nickname' => $nickname,
            'content'  => $remark,
            'phone'    => $phone,
        ]);
        Session::set('last_messages_time',$nowTime);
        return json(['code'=>0, 'msg'=>'提交成功，客服会在1-2个工作日内与您联系，请保证您所填手机号无误并畅通']);

    }
}
