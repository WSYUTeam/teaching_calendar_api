<?php
if(!isset($_GET['year'])) {
	$_GET['year'] = date('Y');
}
if(!isset($_GET['month'])) {
	$_GET['month'] = date('m');
}
?>
<form action="" method="get">
	<input type="text" value="<?php echo $_GET['year'];?>" name="year">  年
	<input type="text" value="<?php echo $_GET['month'];?>" name="month"> 月
	<input type="submit">
</form>
<?php
//$dsn = 'mysql:dbname=sqlmoodle;host=127.0.0.1';
$dsn = 'mysql:dbname=moodle_xiaoli;host=218.199.144.142';
$user = 'moodle_xiaoli';//sqlmoodle
$password = 'EKzn2LB4NfCSNwbp';//wsyumoodle

try {
    $dbh = new PDO($dsn, $user, $password);
    // echo "连接成功";
    ?>
    <script type="text/javascript" src="jquery-1.10.2.min.js"></script>
	<body>
		<!-- XNXQ:<br> -->
		status:
		<div id="status">
		</div>
		weekly:
		<div id="weekly">
		</div>
		<!-- XLRQ:<br>
		<div id="data_XLRQ">
		</div> -->
	</body>
    <script>
    $(document).ready(function() {
	    $.get("teaching_calendar.php", { year:"<?php echo $_GET['year'];?>", month:"<?php echo $_GET['month'];?>" } , function(data){
	    	// alert(data['status']);
		  $("#status").html(data['status']);
			//alert(data['weekly'].length);
			$weekly_html = '';
			for($weekly_i=0; $weekly_i<data['weekly'].length; $weekly_i++) {
				$weekly_html += "<div>"+data['weekly'][$weekly_i]+"</div>";
				//日历获取对应值
				$(".teaching_calendar:eq("+$weekly_i+")").text(data['weekly'][$weekly_i]);
				// alert($weekly_html);
			}	
		  $("#weekly").html($weekly_html);
		},"json");
		// $.get("teaching_calendar.php?XLRQ=1", function(data){
		//   $("#data_XLRQ").html(data);
		// });
	})
	</script>
	<?php
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?> 
<table class="minicalendar calendartable">
            <caption class="calendar-controls">
                    <h3>
                        <a href="http://study.wsyu.edu.cn/moodle/calendar/view.php?view=month&amp;time=1545288912" title="本月">2018年12月</a>
                    </h3>
            </caption>
            <thead>
              <tr>
                    <th class="header text-xs-center" scope="col">
                        <abbr title="zhouci">周次</abbr>
                    </th>
     
                    <th class="header text-xs-center" scope="col">
                        <abbr title="星期一">周一</abbr>
                    </th>
                    <th class="header text-xs-center" scope="col">
                        <abbr title="星期二">周二</abbr>
                    </th>
                    <th class="header text-xs-center" scope="col">
                        <abbr title="星期三">周三</abbr>
                    </th>
                    <th class="header text-xs-center" scope="col">
                        <abbr title="星期四">周四</abbr>
                    </th>
                    <th class="header text-xs-center" scope="col">
                        <abbr title="星期五">周五</abbr>
                    </th>
                    <th class="header text-xs-center" scope="col">
                        <abbr title="星期六">周六</abbr>
                    </th>
                    <th class="header text-xs-center" scope="col">
                        <abbr title="星期日">周日</abbr>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr data-region="month-view-week">
    		    <td class="dayblank teaching_calendar"></td>
                        <td class="dayblank">&nbsp;</td>
                        <td class="dayblank">&nbsp;</td>
                        <td class="dayblank">&nbsp;</td>
                        <td class="dayblank">&nbsp;</td>
                        <td class="dayblank">&nbsp;</td>
                        <td class="day text-center weekend" data-day-timestamp="1543593600">
                                1
                            </td>
                        <td class="day text-center weekend" data-day-timestamp="1543680000">
                                2
                            </td>
                </tr>
                <tr data-region="month-view-week">
    		    <td class="dayblank teaching_calendar"></td>
                        <td class="day text-center" data-day-timestamp="1543766400">
                                3
                            </td>
                        <td class="day text-center" data-day-timestamp="1543852800">
                                4
                            </td>
                        <td class="day text-center" data-day-timestamp="1543939200">
                                5
                            </td>
                        <td class="day text-center" data-day-timestamp="1544025600">
                                6
                            </td>
                        <td class="day text-center" data-day-timestamp="1544112000">
                                7
                            </td>
                        <td class="day text-center weekend" data-day-timestamp="1544198400">
                                8
                            </td>
                        <td class="day text-center weekend" data-day-timestamp="1544284800">
                                9
                            </td>
                </tr>
                <tr data-region="month-view-week">
    		    <td class="dayblank teaching_calendar"></td>
                        <td class="day text-center" data-day-timestamp="1544371200">
                                10
                            </td>
                        <td class="day text-center" data-day-timestamp="1544457600">
                                11
                            </td>
                        <td class="day text-center" data-day-timestamp="1544544000">
                                12
                            </td>
                        <td class="day text-center" data-day-timestamp="1544630400">
                                13
                            </td>
                        <td class="day text-center" data-day-timestamp="1544716800">
                                14
                            </td>
                        <td class="day text-center weekend" data-day-timestamp="1544803200">
                                15
                            </td>
                        <td class="day text-center weekend" data-day-timestamp="1544889600">
                                16
                            </td>
                </tr>
                <tr data-region="month-view-week">
    		    <td class="dayblank teaching_calendar"></td>
                        <td class="day text-center" data-day-timestamp="1544976000">
                                17
                            </td>
                        <td class="day text-center" data-day-timestamp="1545062400">
                                18
                            </td>
                        <td class="day text-center" data-day-timestamp="1545148800">
                                19
                            </td>
                        <td class="day text-center today" data-day-timestamp="1545235200">
                                    <a href="http://study.wsyu.edu.cn/moodle/calendar/view.php?view=month&amp;time=1545288912" id="calendar-day-popover-link-1-2018-353-5c1b3cd0b70255c1b3cd0b70281" data-container="body" data-toggle="popover" data-html="true" data-trigger="hover" data-placement="top" data-title="Today 12月20日 Thursday" data-alternate="没有事件" data-original-title="" title="">20</a>
    <div class="hidden">
        
    </div>
                            </td>
                        <td class="day text-center" data-day-timestamp="1545321600">
                                21
                            </td>
                        <td class="day text-center weekend" data-day-timestamp="1545408000">
                                22
                            </td>
                        <td class="day text-center weekend" data-day-timestamp="1545494400">
                                23
                            </td>
                </tr>
                <tr data-region="month-view-week">
    		    <td class="dayblank teaching_calendar"></td>
                        <td class="day text-center" data-day-timestamp="1545580800">
                                24
                            </td>
                        <td class="day text-center" data-day-timestamp="1545667200">
                                25
                            </td>
                        <td class="day text-center" data-day-timestamp="1545753600">
                                26
                            </td>
                        <td class="day text-center" data-day-timestamp="1545840000">
                                27
                            </td>
                        <td class="day text-center" data-day-timestamp="1545926400">
                                28
                            </td>
                        <td class="day text-center weekend" data-day-timestamp="1546012800">
                                29
                            </td>
                        <td class="day text-center weekend" data-day-timestamp="1546099200">
                                30
                            </td>
                </tr>
                <tr data-region="month-view-week">
    		    <td class="dayblank teaching_calendar"></td>
                        <td class="day text-center" data-day-timestamp="1546185600">
                                31
                            </td>
                        <td class="dayblank">&nbsp;</td>
                        <td class="dayblank">&nbsp;</td>
                        <td class="dayblank">&nbsp;</td>
                        <td class="dayblank">&nbsp;</td>
                        <td class="dayblank">&nbsp;</td>
                        <td class="dayblank">&nbsp;</td>
                </tr>
            </tbody>
        </table>