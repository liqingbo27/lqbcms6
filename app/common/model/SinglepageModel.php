<?php
declare (strict_types = 1);

namespace app\common\model;

use think\facade\Request;
use think\Model;

/**
 * @mixin think\Model
 */
class SinglepageModel extends Model
{
    protected $name = 'singlepage';

    public static $varArr = [
    	'intro' => '研究院简介',
    	// 'lishihui' => '理事会成员',
    	'dashiji' => '大事记',
    	// 'zhuanjia' => '专家团队',
    	'zhici' => '理事长致辞',
    	'jiyu' => '院长寄语'
    ];
	public static $varArrEn = [
		'intro' => 'Introduction',
		'lishihui' => 'Board Members',
		'dashiji' => 'Events',
		'zhuanjia' => 'Experts',
		'zhici' => 'Message from the Chairman',
		'jiyu' => 'Message from the Dean'
	];

    //
    public static function pageList($map = []){
        $limit = Request::param('limit',25);
        $list = self::where($map)->order('sort', 'asc')->paginate([
            'list_rows'=> $limit,
            'var_page' => 'page',
        ])->each(function($item, $key){
            //$item->category_name = NewsCategoryModel::where('id',$item->category_id)->value('name');
            $item->admin_name = AdminModel::where('id',$item->admin_id)->value('username');

        });
        return $list;
    }

    public static function info($id){
        $info = self::find($id);
        return $info;
    }
}
