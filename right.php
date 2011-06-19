<?php
/*\
|*|  dexterguu#yahoo.com
|*|  Display some infos when root login in
|*|  charts, total number
\*/
?>
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
	$sql1 = "select count(id) from admin where type=1"; // 1 for root
	$sql2 = "select count(id) from admin where type=2";// 2 for proxy
	$sql3 = "select count(id) from admin where type=3"; //3 for normal root
	$sql4 = "select name,time,money from money order by time desc LIMIT 10";
        $handle = openConn();
        if($handle == NULL) die( "mysql_error".mysql_error());
        $result = mysql_query($sql1,$handle)   or die('Error in query $query.' .mysql_error());
	$row = mysql_fetch_array($result,MYSQL_NUM);
	$ROOTS = $row[0];
        $result = mysql_query($sql2,$handle)   or die('Error in query $query.' .mysql_error());	
	$row = mysql_fetch_array($result,MYSQL_NUM);
	$PROXYS = $row[0];
        $result = mysql_query($sql3,$handle)   or die('Error in query $query.' .mysql_error());	
	$row = mysql_fetch_array($result,MYSQL_NUM);
	$NROOTS = $row[0];
	
	$result = mysql_query($sql4,$handle)   or die('Error in query $query.' .mysql_error());		
	$num1 = mysql_num_rows($result);
	if($num1 > 0)
	{
		$log_arr = array();
		for($i= 0; $i < $num1; $i++)
		{
			$row = mysql_fetch_array($result,MYSQL_NUM);
			$log_arr[$i] = $row;
		}
	}
	closeConn($handle );

?>
<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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

<style type="text/css">
body{   background:url("images/dang.jpg") no-repeat bottom right;}

body {
	font-family:Arial,Helvetica,sans-serif;
}

</style>
</head>

<body>
	<div style="margin-top:20px;padding-left:8px;padding-right:4px;height:26px;width:800px;font-size:1em;line-height:1.6em;clear:both;margin-left:10px;background:#ebeff9;border-top:1px solid #6b90da;">
		<div style="float:left;  width:49.9999%">概况</div>
		<div style="text-align:right;float:right; width:49.999%"><?php echo date("Y年m月d日"); ?> </div> 
	</div>
	<div style="margin-left:10px;">
		<div style="clear:both;height:15px; width:799px;"></div>
		<div> 总共有<?php echo $ROOTS; ?>位超级管理员</div>
		<div> <span style="color:white;">总共有</span><?php echo $NROOTS; ?>位普通管理员</div>
		<div>  <span style="color:white;">总共有</span><?php echo $PROXYS; ?>位代理商</div>
	</div>
	<hr size=1 style="width:700px;margin-left:50px;" />
	<div style="margin-left:50px;line-height:1.6em;">
	<span style="color:gray;">The Last 10 records:</span> <br />
	<?php
		for($i=0;$i< count($log_arr); $i++)
		{
			echo $log_arr[$i][0]." 在".$log_arr[$i][1]."记录了".$log_arr[$i][2]."￥<br />";
		}
	?>
	</div>

</body>
</html>
