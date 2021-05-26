<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\common\model\MessagesModel;
use app\common\model\NewsModel;
use app\common\model\SinglepageModel;
use think\facade\Request;
use think\facade\View;

class About extends Common
{
    public function index()
    {
        $info = SinglepageModel::where('varname','intro')->where('lang','=',$this->lang)->find();
        if(!empty($info)){
        	$info->creater = 'editor';
        	$info->source = $info->source ? $info->source : 'internet';
        }else{
	        SinglepageModel::create([
	        	'varname' => 'intro',
	        	'lang' => $this->lang,
	        	'title' => SinglepageModel::$varArr['intro']
	        ]);
        }

        if($info->status==0){
        	$info->content = '';
        	$info->description = '';
        }

        View::assign('info',$info);

	    SinglepageModel::where('id', $info->id)->inc('clicks', 1)->update();
        return view();
    }

    public function info(){
        $id = input('id');
        $info = SinglepageModel::find($id);
	    if($info->status==0){
		    $info->content = '';
		    $info->description = '';
	    }
        View::assign('info',$info);

	    SinglepageModel::where('id', $info->id)->inc('clicks', 1)->update();
        return view();
    }

	public function show(){
		$var = input('var','');
		$info = SinglepageModel::where('varname',$var)->find();
		View::assign('info',$info);

		return view();
	}

	//取消
    public function contact(){
    	if(request()->isPost()){
		    $data = Request::only(['nickname','phone','content']);
			if(empty($data['nickname'])){
				return json(['code'=>1, 'msg'=>'请输入联系人姓名']);
			}
		    if(empty($data['phone'])){
			    return json(['code'=>1, 'msg'=>'请输入联系电话']);
		    }
		    if(empty($data['content'])){
			    return json(['code'=>1, 'msg'=>'请输入留言内容']);
		    }

		    MessagesModel::create($data);
		    return json(['code'=>1, 'msg'=>'留言成功，我们将在第一时间及时回复您的反馈']);
	    }
        return view();
    }
}
