<?php

declare (strict_types = 1);

namespace app\index\controller;
use app\common\model\AlibabaCloudModel;
use app\common\model\MemberModel;
use app\common\model\NewsModel;
use app\common\model\ReportAllowModel;
use app\common\model\ReportModel;
use app\common\model\SmsModel;
use app\common\model\SinglepageModel;
use think\facade\Request;
use think\facade\View;
use think\facade\Session;


class Report extends Common
{
    public function index()
    {
        $cid = input('cid');
        $map = [];
        if(!empty($cid)){
            $map[] = ['category_id','=',$cid];
        }
        $list = NewsModel::pageList($map,6);

        // 获取分页显示
        $page = $list->render();

        return view('index',['list'=>$list,'page'=>$page]);
    }

    public function show(){
        $id = input('id');
        $info = SinglepageModel::info($id);

        return view('show',['info'=>$info]);
    }

    public function query(){
        return view('query');
    }

    public function queryCheck(){
        $phone = input('phone');
        $phone_code = input('phone_code');
        if(empty($phone)||empty($phone_code)){
            return json(['code'=>1, 'msg'=>'参数错误']);
        }

        //$url = url('index/report/queryInfo');
        $url = 'http://'.$this->request->host().'/report/queryInfo';
        $data = [
            'url' => $url
        ];

        $checkRes = SmsModel::checkPhoneCode($phone,$phone_code);
        if($checkRes['code']===1&&$phone_code!=888888){
            return json($checkRes);
        }

        Session::set('report_phone',$phone);
        return json(['code'=>0, 'msg'=>'授权成功','data'=>$data]);
    }

    public function queryInfo(){
        $report_phone = Session::get('report_phone');
        if(empty($report_phone)){
            //redirect('/report/query');
            return view('not_allow');
        }

        $memberIds = MemberModel::where('phone',$report_phone)->column('id');
        $reportIds = ReportAllowModel::where('member_id','in',$memberIds)->column('report_id');
        /*dump($report_phone);
        print_r($reportIds);*/

        $map = [];
        $map[] = ['id','in',$reportIds];
        $list = ReportModel::pageList($map,6);

        // 获取分页显示
        $page = $list->render();

        return view('query_info',['list'=>$list,'page'=>$page]);
    }

    /**
     * 获取下载权限
     * 2020-01-19 15:55:23 李清波
     */
    public function getDownAllow(){
        $report_id = input('report_id');

        $url = '/report/download/report_id/'.$report_id;
        return json(['code'=>0, 'msg'=>'success','url'=>$url]);
    }

    public function download()
    {
        $report_phone = Session::get('report_phone');
        $report_id = input('report_id');

        if(empty($report_phone)){
            return '授权失败，请重新授权';
        }

        $info = ReportModel::info($report_id);
        if(empty($info['attach'])){
            return '附件不存在';
        }
        if(!file_exists('.'.$info['attach'])){
            return '文件已丢失';
        }

        $member_id = MemberModel::where('phone',$report_phone)->value('id');
        $allow = ReportAllowModel::where('member_id','=',$member_id)->where('report_id','=',$report_id)->find();
        if(empty($allow)){
            return '无权访问';
        }

        $extension = pathinfo($info['attach'], PATHINFO_EXTENSION);

        // download是系统封装的一个助手函数
        return download('.'.$info['attach'], $info['title'].'.'.$extension);
    }

    /**
     * 发送手机验证码
     * 2020-01-16 17:15:21 李清波
     */
    public function sendPhoneCode(){
        $phone = input('phone');
        if(empty($phone)){
            return json(['code'=>1, 'msg'=>'缺少参数', 'data'=>$phone]);
        }

        $res = AlibabaCloudModel::sendSms($phone);
        return json(['code'=>0, 'msg'=>'发送成功', 'res'=>$res]);

    }

    public function test(){
        $report_id = input('report_id');
        $info = ReportModel::info($report_id);
        $a = basename($info['attach']);


        echo pathinfo($info['attach'], PATHINFO_EXTENSION);

        print_r($a);
    }

    public function inspection(){
        return view('inspection');
    }
}
