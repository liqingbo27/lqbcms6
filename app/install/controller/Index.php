<?php
declare (strict_types = 1);

namespace app\install\controller;
use app\common\model\AdvertModel;
use app\common\model\FriendlinkModel;
use app\common\model\NewsModel;
use app\common\model\TeamModel;
use think\facade\Db;
use think\facade\Request;
use think\facade\Route;
use think\facade\View;

class Index extends Common
{

	/**
	 * Created by LQBCSM.
	 * Site：https://www.liqingbo.cn
	 * Author: 李清波
	 * Date: 2021-4-26 19:32
	 */
    public function index()
    {

	    return view();
    }

    public function a(){
	    $env_items = array();
	    $dirfile_items = array(
		    array('type' => 'dir', 'path' => 'data'),
		    array('type' => 'dir', 'path' => 'install'),
	    );

	    $func_items = array(
		    array('name' => 'mysqli_connect'),
		    array('name' => 'fsockopen'),
		    array('name' => 'gethostbyname'),
		    array('name' => 'file_get_contents'),
		    array('name' => 'mb_convert_encoding'),
		    array('name' => 'json_encode'),
		    array('name' => 'curl_init'),
	    );

	    env_check($env_items);

	    dirfile_check($dirfile_items);
	    function_check($func_items);

	    return view('',[
	    	'env_items'=>$env_items,
	    	'func_items'=>$func_items,
	    	'dirfile_items'=>$dirfile_items
		    ]);
    }

    public function b(){
	    return view('',[

	    ]);
    }

	public function c(){
		$install_error = '';
		$install_recover = '';
		$demo_data = '';

		View::assign('install_error',$install_error);
		View::assign('nstall_recover',$install_recover);
		View::assign('demo_data',$demo_data);

		return view('');
	}

	public function d(){
		$install_error = '';
		$install_recover = '';
		View::assign('install_error',$install_error);
		View::assign('nstall_recover',$install_recover);


		global $html_title,$html_header,$html_footer;
		if(!Request::isPost()){
			return redirect('/install/index/c');
		}


		$postData = input();
		//dump($postData);
		//exit;


		$db_host = input('db_host');
		$db_port = input('db_port');
		$db_user = input('db_user');
		$db_pwd = input('db_pwd');
		$db_name = input('db_name');
		$db_prefix = input('db_prefix');
		$admin = input('admin');
		$password = input('password');
		$install_recover = input('install_recover');
		$demo_data = input('demo_data');

		$install_error = '';
		if (!$db_host || !$db_port || !$db_user || !$db_pwd || !$db_name || !$db_prefix || !$admin || !$password){
			$install_error = '输入不完整，请检查';
		}
		if(strpos($db_prefix, '.') !== false) {
			$install_error .= '数据表前缀为空，或者格式错误，请检查';
		}

		if(strlen($admin) > 15 || preg_match("/^$|^c:\\con\\con$|　|[,\"\s\t\<\>&]|^游客|^Guest/is", $admin)) {
			$install_error .= '非法用户名，用户名长度不应当超过 15 个英文字符，且不能包含特殊字符，一般是中文，字母或者数字';
		}
		if ($install_error != '') return;

		$mysqli = @mysqli_connect($db_host, $db_user, $db_pwd, $db_name);

		if (mysqli_connect_errno($mysqli))
		{
			"连接 MySQL 失败: " . mysqli_connect_error();
			return view('c');
		}

		if($mysqli->get_server_info()> '5.0') {
			$mysqli->query("CREATE DATABASE IF NOT EXISTS `$db_name` DEFAULT CHARACTER SET UTF8");
		} else {
			$install_error = '数据库必须为MySQL5.0版本以上';return;
		}
		if($mysqli->error) {
			$install_error = $mysqli->error;return ;
		}


		/*if($install_recover != 'yes' && ($query = $mysqli->query("SHOW TABLES FROM $db_name"))) {
			while($row = mysqli_fetch_array($query)) {
				if(preg_match("/^$db_prefix/", $row[0])) {
					$install_error = '数据表已存在，继续安装将会覆盖已有数据';
					$install_recover = 'yes';
					return;
				}
			}
		}*/

		$sitepath = strtolower(substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')));
		$sitepath = str_replace('install',"",$sitepath);
		$auto_site_url = strtolower('http://'.$_SERVER['HTTP_HOST'].$sitepath);
		//$this->write_config($auto_site_url);
		$this->write_env($auto_site_url,$postData);

		$_charset = strtolower('UTF8');
		$mysqli->select_db($db_name);
		$mysqli->set_charset($_charset);
		if(!file_exists("../lqbcms_demo.sql")){
			print_r('未找到数据库文件');
			exit;
		}
		$sql = file_get_contents("../lqbcms_demo.sql");
		if(empty($sql)){
			print_r('未找到数据库文件');
			exit;
		}
		//判断是否安装测试数据
		/*if ($_POST['demo_data'] == '1'){
			$sql .= file_get_contents("data/{$_charset}_add.sql");
		}*/
		$sql = str_replace("\r\n", "\n", $sql);
		$this->runquery($sql,$db_prefix,$mysqli);
		/**
		 * 转码
		 */
		$sitename = input('site_name');
		$username = input('admin');
		$password = input('password');
		/**
		 * 产生随机的md5_key，来替换系统默认的md5_key值
		 */
		$time = time();

		$md5_key = md5(random(4).substr(md5($_SERVER['SERVER_ADDR'].$_SERVER['HTTP_USER_AGENT'].$db_host.$db_user.$db_pwd.$db_name.substr("$time", 0, 6)), 8, 6).random(10));
		//$mysqli->query("UPDATE {$db_prefix}setting SET value='".$sitename."' WHERE name='site_name'");

		//管理员账号密码

		$res = Db::name('admin')->where('id',1)->update([
			'role_id' => 1,
			'username' => $username,
			'password' => mypassword($password),
			'create_time' => time(),
			'update_time' => time()
		]);

		//测试数据
		/*if ($demo_data == '1'){
			$sql .= file_get_contents("data/{$_charset}_add.sql");
		}*/

		//新增一个标识文件，用来屏蔽重新安装
		$fp = @fopen('lock','wb+');
		@fclose($fp);

		return redirect('/install/index/e');
	}

	public function e(){
		$sitepath = strtolower(substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')));
		$sitepath = str_replace('install',"",$sitepath);
		$auto_site_url = strtolower('http://'.$_SERVER['HTTP_HOST'].$sitepath);

		View::assign('sitepath',$sitepath);
		View::assign('auto_site_url',$auto_site_url);
		return view('');
	}

//execute sql
	function runquery($sql, $db_prefix, $mysqli) {
//  global $lang, $tablepre, $db;
		if(!isset($sql) || empty($sql)) return;
		$sql = str_replace("\r", "\n", str_replace('#__', $db_prefix, $sql));
		$ret = array();
		$num = 0;
		foreach(explode(";\n", trim($sql)) as $query) {
			$ret[$num] = '';
			$queries = explode("\n", trim($query));
			foreach($queries as $query) {
				$ret[$num] .= (isset($query[0]) && $query[0] == '#') || (isset($query[1]) && isset($query[1]) && $query[0].$query[1] == '--') ? '' : $query;
			}
			$num++;
		}
		unset($sql);
		foreach($ret as $query) {
			$query = trim($query);
			if($query) {
				if(substr($query, 0, 12) == 'CREATE TABLE') {
					$line = explode('`',$query);
					$data_name = $line[1];
					$mysqli->query(droptable($data_name));
					$mysqli->query($query);
					unset($line,$data_name);
				} else {
					$mysqli->query($query);
				}
			}
		}
	}
//抛出JS信息
	function showjsmessage($message) {
		echo '<script type="text/javascript">showmessage(\''.addslashes($message).' \');</script>'."\r\n";
		flush();
		ob_flush();
	}


//写入config文件
	function write_config($url) {
		extract($GLOBALS, EXTR_SKIP);
		$config = 'data/config.php';
		$configfile = @file_get_contents($config);
		$configfile = trim($configfile);
		$configfile = substr($configfile, -2) == '?>' ? substr($configfile, 0, -2) : $configfile;
		$charset = 'UTF-8';
		$db_host = $_POST['db_host'];
		$db_port = $_POST['db_port'];
		$db_user = $_POST['db_user'];
		$db_pwd = $_POST['db_pwd'];
		$db_name = $_POST['db_name'];
		$db_prefix = $_POST['db_prefix'];
		$admin = $_POST['admin'];
		$password = $_POST['password'];
		$db_type = 'mysql';
		$cookie_pre = strtoupper(substr(md5(random(6).substr($_SERVER['HTTP_USER_AGENT'].md5($_SERVER['SERVER_ADDR'].$db_host.$db_user.$db_pwd.$db_name.substr(time(), 0, 6)), 8, 6).random(5)),0,4)).'_';
		$configfile = str_replace("===url===",          $url, $configfile);
		$configfile = str_replace("===db_prefix===",    $db_prefix, $configfile);
		$configfile = str_replace("===db_charset===",   $charset, $configfile);
		$configfile = str_replace("===db_host===",      $db_host, $configfile);
		$configfile = str_replace("===db_user===",      $db_user, $configfile);
		$configfile = str_replace("===db_pwd===",       $db_pwd, $configfile);
		$configfile = str_replace("===db_name===",      $db_name, $configfile);
		$configfile = str_replace("===db_port===",      $db_port, $configfile);
		@file_put_contents('../conf/config.php', $configfile);
	}

	function write_env($url,$postData){
		$env = '../.env';

		$content = 'APP_DEBUG = true'."\n"."\n";
		$content .= '[APP]';
		$content .= 'DEFAULT_TIMEZONE = Asia/Shanghai'."\n";
		$content .= '[DATABASE]'."\n";
		$content .= 'TYPE = mysql'."\n";
		$content .= 'HOSTNAME = '.$postData['db_host']."\n";
		$content .= 'DATABASE = '.$postData['db_name']."\n";
		$content .= 'USERNAME = '.$postData['db_user']."\n";
		$content .= 'PASSWORD = '.$postData['db_pwd']."\n";
		$content .= 'PREFIX = '.$postData['db_prefix']."\n";
		$content .= 'HOSTPORT = '.$postData['db_port']."\n";
		$content .= 'CHARSET = utf8'."\n";
		$content .= 'DEBUG = true'."\n"."\n";
		$content .= '[FILESYSTEM]'."\n";
		$content .= 'storage = /storage'."\n";
		$content .= ''."\n"."\n";
		$content .= '[LANG]'."\n";
		$content .= 'default_lang = zh-cn';
		@file_put_contents($env, $content);
		//$configfile = @file_get_contents($env);
	}
}
