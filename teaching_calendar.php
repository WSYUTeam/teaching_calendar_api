<?php
header('content-type:application/json;charset=utf-8');
$dsn = 'mysql:dbname=moodle_xiaoli;host=218.199.144.142';
$user = 'moodle_xiaoli';//sqlmoodle
$password = 'EKzn2LB4NfCSNwbp';//wsyumoodle
$obj = new stdClass();
try {
    $dbh = new PDO($dsn, $user, $password);
    // echo "连接成功";
} catch (PDOException $e) {
    $obj->getMessage = '1001' ;//链接远程数据库失败
    echo json_encode($obj);
    exit;
}
if(isset($_GET['table_name'])) {
	if($_GET['table_name'] == 'XNXQ') {
		$sql = 'SELECT * FROM moodle_xiaoli.XNXQ  where  CURRENT_DATE() BETWEEN KXRQ AND FJRQ ORDER BY FJRQ ASC;';
		$obj->getMessage = '1002' ;//链接XNXQ数据表成功！
		$obj->data = array();
		$sth = $dbh->prepare($sql);
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
?> 