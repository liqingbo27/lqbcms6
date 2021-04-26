<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\common\model\CasesCategoryModel;
use app\common\model\CasesModel;
use think\console\Input;

class Cases extends Common
{
    public function getList()
    {
        $keyword = input('keyword');
        $category_id = input('category_id');

        $map = [];
        if(!empty($keyword)){
            $map[] = ['title','like','%'.$keyword.'%'];
        }
        if(!empty($category_id)){
            $map[] = ['category_id','=',$category_id];
        }
        $list = CasesModel::pageList($map);
        return json(['code'=>0,'msg'=>'success','data'=>$list]);
    }

    public function del(){
        $id = $this->request->param('ids');
        CasesModel::destroy($id);
        return json(['code'=>0,'msg'=>'删除成功']);
    }

    public function add(){
        $data = $this->request->param('data');

        if(!empty($data['id'])){
            CasesModel::update($data);
        }else{
            unset($data['id']);
            $data['admin_id'] = session('admin_id');
            CasesModel::create($data);
        }
        return json(['code'=>0,'msg'=>'操作成功']);
    }

    /**
     * 获取分类列表
     * 2020-01-14 09:09:40 李清波
     */
    public function getCategoryList(){
        $map[] = ['status','=',1];
        $list = CasesCategoryModel::where($map)->select();
        return json(['code'=>0,'msg'=>'操作成功','data'=>$list]);
    }

    /**
     * 添加分类
     * 2020-01-14 09:09:40 李清波
     */
    public function categoryAdd(){
        $data = $this->request->param();
        if(empty($data['id'])){
            unset($data['id']);
            CasesCategoryModel::create($data);
        }else{
            CasesCategoryModel::update($data);
        }
        return json(['code'=>0,'msg'=>'操作成功']);
    }

    /**
     * 删除分类
     * 2020-01-14 09:09:40 李清波
     */
    public function categoryDel(){
        $ids = $this->request->param('ids');
        CasesCategoryModel::destroy($ids);
        return json(['code'=>0,'msg'=>'删除成功']);
    }

    public function upload(){

        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        //$savename = \think\facade\Filesystem::putFile( 'topic', $file);
        $savename = \think\facade\Filesystem::disk('storage')->putFile( 'cases', $file);

        $path = '/storage/'.str_replace("\\","/",$savename);
        $fullpath = $this->request->scheme().'://'.$this->request->host().$path;
        $data['src'] = $path;
        $data['title'] = '图片';

        return json(['code'=>0, 'msg'=>'登入成功', 'data'=>$data]);
    }



}
