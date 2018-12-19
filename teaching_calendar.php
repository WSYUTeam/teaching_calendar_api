<?php
header('content-type:application/json;charset=utf-8');
require_once "config.php"; 
// if(!isset($_GET['year'])) {
// 	$_GET['year'] = date('Y');
// }
// if(!isset($_GET['month'])) {
// 	$_GET['month'] = date('m');
// }
// $dbh = new database_config();
// //定义空函数  start
// $obj = new stdClass();
// //定义空函数  end
// $obj->status = $dbh->status;
// echo json_encode($obj);
/**
 * 链接XNXQ数据表 和 链接XLRQ数据表
 */
class table_data extends database_config
{
	//private $dbh;
	public $obj = array();
	function __construct()
	{
		global $db;
		$dbh = parent::__construct();
		$year_month = 1;
		//print_r($this->dbh);
		//定义空函数  start
		// $obj = new stdClass();
		//定义空函数  end
		// ->status = $dbh;
		$this->obj['status'] = $dbh;
		// print_r(json_encode($obj)) ;
		if(!isset($_GET['year'])) {
			$this->obj['status'] = '1003' ;//无年份参数传递！
			$year_month = 0;
		}
		if(!isset($_GET['month'])) {
			$this->obj['status'] = '1004' ;//无月份参数传递！
			$year_month = 0;
		}
		if($this->obj['status']=='1000' && $year_month==1) {
			// if(isset($_GET['table_name'])) {
				// if($_GET['table_name'] == 'XNXQ') {
					//取当前时间范围内的值
					$sql = 'SELECT * FROM moodle_xiaoli.XNXQ  where  CURRENT_DATE() BETWEEN KXRQ AND FJRQ ORDER BY FJRQ ASC;';
					$this->obj['status'] = '1002' ;//链接XNXQ数据表成功！
					// $obj->data = array();
					$sth = $db->prepare($sql);
					$sth->execute();
					$result = $sth->fetchAll(PDO::FETCH_CLASS);
					// print_r($result[0]->KXRQ);
					//$obj->data['KXRQ'] = $result[0]->KXRQ;
					//$obj->data['FJRQ'] = $result[0]->FJRQ;
					//开学日期
					$time1 = strtotime($result[0]->KXRQ); 
					$time1_val = strtotime($result[0]->KXRQ); 
					//结束日期 
					$time2 = strtotime($result[0]->FJRQ);
					$time2_val = strtotime($result[0]->FJRQ);
					$monarr = array();
					$total_week = array();
					//初始化第一个月数据   start 
					$weeks = $this->weeks($time1, $time1_val, $time2_val, $_GET['year'], $_GET['month']);
					//初始化第一个月数据   end
					while (strtotime(date('Y-m',$time1)) < strtotime(date('Y-m',$time2))) {
					    $time1 = strtotime('+1 month', $time1);
					    $weeks = $this->weeks($time1, $time1_val, $time2_val, $_GET['year'], $_GET['month'], $weeks);
					}
					// $json=json_encode($this->obj);
					// echo $json;
				// } else if($_GET['table_name'] == 'XLRQ') {
				// 	$sql = 'SELECT * FROM moodle_xiaoli.XLRQ where  CURRENT_DATE() < JSSJ ORDER BY JSSJ ASC;';
				// 	$obj->status = '1003' ;//链接XLRQ数据表成功！
				// 	$obj->data = array();
				// 	$sth = $db->prepare($sql);
				// 	$sth->execute();
				// 	$result = $sth->fetchAll(PDO::FETCH_CLASS);
				// 	$obj->data = $result;
				// 	$json=json_encode($obj);
				// 	echo $json;
				// } 
			// }
		}
		$json=json_encode($this->obj);
		echo $json;
	}
	function weeks($time1, $time1_val, $time2_val, $url_year, $url_month, $weeks_i=1) {
		$current_year=date('Y',$time1);//date('Y')
		$current_month=date('m',$time1);

		$firstday = strtotime($current_year.'-'.$current_month.'-01');
		//计算本月头一天的星期一
		$monday=$firstday-86400*(date('N',$firstday)-1);//计算第一个周一的日期
		//由于每个月只有四周 让 $i 从 1 到 5 增加即可
		for ($i=1; $i <= 5; $i++) {
		    $start=date("Y-m-d",$monday+($i-1)*86400*7);//起始周一
		    $end=date("Y-m-d",$monday+$i*86399*7);//结束周日
		    if(date('m',$monday+$i*86399*7)!=$current_month) {
		        continue;
		    }
		    /**
		     * 去掉开始日期多余的部分
		     * echo $end .'<'. date('Y-m-d',$time1).'=======';
		     */
		    if(strtotime($end) < strtotime(date('Y-m-d',$time1_val))) {
		    	 continue;
		    }
		    //显示所有的, 调试可以打开
		    //$weeks_i.':'.$start.'---'.$end."<br/>";//开始结束放入数组
		    if((date('Y', strtotime($start))==$url_year && date('m', strtotime($start))==$url_month) || (date('Y', strtotime($end))==$url_year && date('m', strtotime($end))==$url_month)) {
		    	//echo $weeks_i.':'.$start.'---'.$end."<br/>";//开始结束放入数组
		    	$this->obj['weekly'][] = $weeks_i;
		    }
		    /**
		     * 去掉结束日期多余的部分
		     * echo $end .'<'. date('Y-m-d',$time1).'=======';
		     */
		    if(strtotime($end) >= strtotime(date('Y-m-d',$time2_val))) {
		    	 break;
		    }
		    $weeks_i++;
		}
		return $weeks_i;
	}
}
new table_data();
?> 