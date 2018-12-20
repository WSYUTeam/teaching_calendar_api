<?php
// $dsn = 'mysql:dbname=moodle_xiaoli;host=218.199.144.142';
// $user = 'moodle_xiaoli';//sqlmoodle
// $password = 'EKzn2LB4NfCSNwbp';//wsyumoodle
// $obj = new stdClass();
// try {
//     $dbh = new PDO($dsn, $user, $password);
//     // echo "连接成功";
// } catch (PDOException $e) {
//     $obj->status = '1001' ;//链接远程数据库失败
//     echo json_encode($obj);
//     exit;
// }
/**
 * 链接服务器配置
 */
class database_config 
{
	public $status = '';
	// public $dbh;
	//数据库配置信息  start
	private $dsn = 'mysql:dbname=moodle_xiaoli;host=218.199.144.142';
	private $user = 'moodle_xiaoli';//sqlmoodle
	private $password = 'EKzn2LB4NfCSNwbp';//wsyumoodle
	//数据库配置信息  end
	public function __construct()
	{
		global $db;
		try {
		    $db = new PDO($this->dsn, $this->user, $this->password);
		    return $this->status = '1000' ;//链接远程数据库成功
		    //return true;
		} catch (PDOException $e) {
		    return $this->status = '1001' ;//链接远程数据库失败
		    //print "连接失败le \n";
		    // return false;
		}
	}
}
//数据库配置信息  start
// $dsn = 'mysql:dbname=moodle_xiaoli;host=218.199.144.142';
// $user = 'moodle_xiaoli';//sqlmoodle
// $password = 'EKzn2LB4NfCSNwbp';//wsyumoodle
// $dbh = new database_config();
//数据库配置信息  end
?> 