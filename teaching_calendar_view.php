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