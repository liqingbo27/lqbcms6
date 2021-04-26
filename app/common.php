<?php
// 应用公共文件
function my_response($code=0,$msg='success',$data=[]){
  return json([
    'code' => $code,
    'msg'  => $msg,
    'data' => $data,
  ]);
}


function get_client_ip(){
    $ip=false;
    if(!empty($_SERVER["REMOTE_ADDR"])){
        $ip = $_SERVER["REMOTE_ADDR"];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && !$ip){
        $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if($ip){
            array_unshift($ips, $ip);
            $ip = false;
        }
        for($i = 0; $i < count($ips); $i++){
            if (!preg_match ("/^(10|172.16|192.168).$/", $ips[$i])){
                $ip = $ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip : $_SERVER['HTTP_CLIENT_IP']);
}


/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function list_to_tree($list, $pk='id', $pid = 'pid', $child = '_child', $root = 0) {
  // 创建Tree
  $tree = array();

  if(is_array($list)) {

    // 创建基于主键的数组引用
    $refer = array();
    foreach ($list as $key => $val) {
      $refer[$val[$pk]] =& $list[$key];
    }


    foreach ($list as $key => $val) {
      // 判断是否存在parent
      $parentId =  $val[$pid];
      if ($root == $parentId) {
        $tree[] =& $list[$key];
      }else{
        if (isset($refer[$parentId])) {
          $parent =& $refer[$parentId];
          $parent[$child][] =& $list[$key];
        }
      }
    }
  }
  return $tree;
}

/**
 * 将list_to_tree的树还原成列表
 * @param  array $tree  原来的树
 * @param  string $child 孩子节点的键
 * @param  string $order 排序显示的键，一般是主键 升序排列
 * @param  array  $list  过渡用的中间数组，
 * @return array        返回排过序的列表数组
 * @author yangweijie <yangweijiester@gmail.com>
 */
function tree_to_list($tree, $child = '_child', $order='id', &$list = array()){
  if(is_array($tree)) {
    $refer = array();
    foreach ($tree as $key => $value) {
      $reffer = $value;
      if(isset($reffer[$child])){
        unset($reffer[$child]);
        tree_to_list($value[$child], $child, $order, $list);
      }
      $list[] = $reffer;
    }
    $list = list_sort_by($list, $order, $sortby='asc');
  }
  return $list;
}


function dates_to_date($date){
  if(!empty($date)){
    return date('Y-m-d',strtotime($date));
  }else{
    return '';
  }
}



/**
 * 生成随机字符串
 * @param string $lenth 长度
 * @return string 字符串
 */
function get_randomstr($lenth = 6) {
    return get_random($lenth, '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
}

/**
 * 随机生成16位字符串
 * @return string 生成的字符串
 */
function get_random_str() {

    $str = "";
    $str_pol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen($str_pol) - 1;
    for ($i = 0; $i < 16; $i++) {
        $str .= $str_pol[mt_rand(0, $max)];
    }
    return $str;
}

/**
 * 产生随机字符串
 *
 * @param    int        $length  输出长度
 * @param    string     $chars   可选的 ，默认为 0123456789
 * @return   string     字符串
 */
function get_random($length, $chars = '0123456789') {
    $hash = '';
    $max = strlen($chars) - 1;
    for($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}

function build_order_no() {
    return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
}


function postData($url,$data){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $tmpInfo = curl_exec($ch);
    if (curl_errno($ch)) {
        return curl_error($ch);
    }
    curl_close($ch);
    return $tmpInfo;
}

function mypassword($password){
     return password_hash($password, PASSWORD_DEFAULT);
}

function lang_version($key=''){
	$arr = [
		'cn' => '中文',
		'en' => 'English',
	];
	if(!empty($key)){
		return $arr[$key];
	}
	return $arr;
}


//字符串截取

function cut_str($sourcestr,$cutlength)

{

	$returnstr='';

	$i=0;

	$n=0;

	$str_length=strlen($sourcestr);//字符串的字节数

	while (($n<$cutlength) and ($i<=$str_length))

	{

		$temp_str=substr($sourcestr,$i,1);

		$ascnum=Ord($temp_str);//得到字符串中第$i位字符的ascii码

		if ($ascnum>=224)    //如果ASCII位高与224，

		{

			$returnstr=$returnstr.substr($sourcestr,$i,3); //根据UTF-8编码规范，将3个连续的字符计为单个字符

			$i=$i+3;            //实际Byte计为3

			$n++;            //字串长度计1

		}

		elseif ($ascnum>=192) //如果ASCII位高与192，

		{

			$returnstr=$returnstr.substr($sourcestr,$i,2); //根据UTF-8编码规范，将2个连续的字符计为单个字符

			$i=$i+2;            //实际Byte计为2

			$n++;            //字串长度计1

		}

		elseif ($ascnum>=65 && $ascnum<=90) //如果是大写字母，

		{

			$returnstr=$returnstr.substr($sourcestr,$i,1);

			$i=$i+1;            //实际的Byte数仍计1个

			$n++;            //但考虑整体美观，大写字母计成一个高位字符

		}

		else                //其他情况下，包括小写字母和半角标点符号，

		{

			$returnstr=$returnstr.substr($sourcestr,$i,1);

			$i=$i+1;            //实际的Byte数计1个

			$n=$n+0.5;        //小写字母和半角标点等与半个高位字符宽...

		}

	}

	if ($str_length>$i){

		$returnstr = $returnstr . "...";//超过长度时在尾处加上省略号

	}

	return $returnstr;

}

function default_thumb($path=''){
	if(!empty($path)){
		return $path;
	}else{
    return '';
		// return '/static/images/no_thumb.jpg';
	}


}