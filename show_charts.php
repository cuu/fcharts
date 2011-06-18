<?php
session_start();
include_once "header.php";
//include_once "waibu.php";
//include_once "cscheck.php";
include_once "function/conn.php";
include_once "function/function.php";
include_once "function/xdownpage.php";
?>
<?php
	$id     = getFormValue("id"     );
	$action = getFormValue("action" );
	$sql = "select  username from admin where id=".$id;
	
        $handle = openConn();
        if($handle == NULL) die( "mysql_error".mysql_error());
        $result = mysql_query($sql,$handle)   or die('Error in query $query.' .mysql_error());
	$row = mysql_fetch_array($result,MYSQL_NUM);
	$NAME = $row[0];
	$sql2 = "select time,money from money where name='".$NAME."'";
        $result2 = mysql_query($sql2,$handle)   or die('Error in query $query.' .mysql_error());	
	$num = mysql_num_rows($result2);
	if($num > 0)
	{
		$arr = array();
		$arr2 = array();
		for($i = 0; $i < $num; $i++)
		{
			$row2 = mysql_fetch_array($result2, MYSQL_NUM);
			$arr[$i] = "\"".$row2[0]."\"";
			$arr2[$i] = $row2[1];
		}
	
		$cate = implode(",", $arr );
		$data = implode(",", $arr2);
		
	}
	else
	{
		$cate = "\"".date("Y-m-d")."\"";
		$data = "0";
	}
	closeConn($handle);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html> 
	<head> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" type="text/css" href="images/css.css">
<!--[if IE]>
  <link rel="stylesheet" type="text/css" href="images/all-ie.css" />
<![endif]-->

<script language="javascript" src="images/time.js" type="text/javascript"></script>
<script language="javascript" src="images/js.js" type="text/javascript"></script>
<?php
	include "jq_ui.php";
	include_once "highcharts.php";
?>

		<title>Highcharts Example</title> 
		
		
		<!-- 1. Add these JavaScript inclusions in the head of your page --> 

		
		<!-- 1a) Optional: add a theme file --> 
		<!--
			<script type="text/javascript" src="../js/themes/gray.js"></script>
		--> 
		
		<!-- 1b) Optional: the exporting module --> 
		<script type="text/javascript" src="../js/modules/exporting.js"></script> 
		
		
		<!-- 2. Add the JavaScript to initialize the chart on document ready --> 
		<script type="text/javascript"> 
		
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						defaultSeriesType: 'line',
						marginRight: 130,
						marginBottom: 33
					},
					credits: {
      		 				text: 'Guu 2011 CopyRight',
        					href: 'http://guu.github.com'
    					},
					title: {
						text: 'Record of Money',
						x: -20 //center
					},
					subtitle: {
						text: 'Source: <?php echo $NAME; ?>',
						x: -20
					},
					xAxis: {
						categories: [<?php echo $cate; ?>]
					},
					yAxis: {
						title: {
							text: 'Money in RMB'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
					},
					tooltip: {
						formatter: function() {
				                return '<b>'+ this.series.name +'</b><br/>'+
								this.x +': '+ this.y +'гд';
						}
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'top',
						x: -10,
						y: 100,
						borderWidth: 0
					},
					series: [{
						name: '<?php echo $NAME;?>',
						data: [ <?php echo $data; ?>]
					}]
				});
				
				
			});
				
		</script> 
		
	</head> 
	<body> 
		
		<!-- 3. Add the container --> 
		<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div> 
		
				
	</body> 
</html> 