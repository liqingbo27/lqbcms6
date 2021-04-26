<?php
declare (strict_types = 1);

namespace app\common\model;

use think\Model;

/**
 * @mixin think\Model
 */
class ClientModel extends Model
{
  protected $name = 'client';

  public static $sexArr = [
    0 => '女',
    1 => '男',
    2 => '保密',
  ];

    public static function pageList(){
      $list = self::limit(25)->page(1)->order('id', 'DESC')->paginate([
        'list_rows'=> 20,
        'var_page' => 'page',
      ])->each(function($item, $key){
        $item->sex_text = self::$sexArr[$item->sex];
        $item->category_name = '';
        $item->admin_name = '';
        $item->last_call_time = !empty($item->last_call) ? date('Y-m-d H:i:s',$item->last_call) : '';
      });
      return $list;
    }
}
