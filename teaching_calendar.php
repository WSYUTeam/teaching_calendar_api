<?php
header('content-type:application/json;charset=utf-8');
include_once "config.php"; 
// $dbh = new database_config();
// //定义空函数  start
// $obj = new stdClass();
// //定义空函数  end
// $obj->getMessage = $dbh->getMessage;
// echo json_encode($obj);
/**
 * 链接XNXQ数据表 和 链接XLRQ数据表
 */
class table_data extends database_config
{
	//private $dbh;
	function __construct()
	{
		global $db;
		$dbh = parent::__construct();
		//print_r($this->dbh);
		//定义空函数  start
		$obj = new stdClass();
		//定义空函数  end
		$obj->getMessage = $dbh;
		// print_r(json_encode($obj)) ;
		if($obj->getMessage=='1000') {
			if(isset($_GET['table_name'])) {
				if($_GET['table_name'] == 'XNXQ') {
					$sql = 'SELECT * FROM moodle_xiaoli.XNXQ  where  CURRENT_DATE() BETWEEN KXRQ AND FJRQ ORDER BY FJRQ ASC;';
					$obj->getMessage = '1002' ;//链接XNXQ数据表成功！
					$obj->data = array();
					$sth = $db->prepare($sql);
					$sth->execute();
					$result = $sth->fetchAll(PDO::FETCH_CLASS);
					$obj->data[] = $result;
					$json=json_encode($obj);
					echo $json;
				} else if($_GET['table_name'] == 'XLRQ') {
					$sql = 'SELECT * FROM moodle_xiaoli.XLRQ where  CURRENT_DATE() < JSSJ ORDER BY JSSJ ASC;';
					$obj->getMessage = '1003' ;//链接XLRQ数据表成功！
					$obj->data = array();
					$sth = $dbh->prepare($sql);
					$sth->execute();
					$result = $sth->fetchAll(PDO::FETCH_CLASS);
					$obj->data[] = $result;
					$json=json_encode($obj);
					echo $json;
				} 
			}
		}
	}
}
new table_data();
exit;


// if(isset($_GET['table_name'])) {
// 	if($_GET['table_name'] == 'XNXQ') {
// 		$sql = 'SELECT * FROM moodle_xiaoli.XNXQ  where  CURRENT_DATE() BETWEEN KXRQ AND FJRQ ORDER BY FJRQ ASC;';
// 		$obj->getMessage = '1002' ;//链接XNXQ数据表成功！
// 		$obj->data = array();
// 		$sth = $dbh->prepare($sql);
// 		$sth->execute();
// 		$result = $sth->fetchAll(PDO::FETCH_CLASS);
// 		$obj->data[] = $result;
// 		$json=json_encode($obj);
// 		echo $json;
// 	} else if($_GET['table_name'] == 'XLRQ') {
// 		$sql = 'SELECT * FROM moodle_xiaoli.XLRQ where  CURRENT_DATE() < JSSJ ORDER BY JSSJ ASC;';
// 		$obj->getMessage = '1003' ;//链接XLRQ数据表成功！
// 		$obj->data = array();
// 		$sth = $dbh->prepare($sql);
// 		$sth->execute();
// 		$result = $sth->fetchAll(PDO::FETCH_CLASS);
// 		$obj->data[] = $result;
// 		$json=json_encode($obj);
// 		echo $json;
// 	} 
// }
?> 