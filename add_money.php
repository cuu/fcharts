<?php
session_start();
include_once "header.php";
include_once "waibu.php";
include_once "cscheck.php";
?>

<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" type="text/css" href="images/css.css">
<script language="javascript" src="images/time.js" type="text/javascript"></script>
<script language="javascript" src="images/js.js" type="text/javascript"></script>
<?php
include "jq_ui.php";
?>


<style type="text/css">
body{   background:url("images/dang.jpg") no-repeat bottom right;}
#container tr
{
  margin-top:8px;
  margin-bottom:8px;
}

</style>
<title>记录钞票</title>
</head>

<body  topmargin="0">
	<form action="add_money_db.php" method="POST" >
		<div align="center"><p>　</p><p>　</p>
		<input name="add_money" type="hidden" value="add" >
		<table id="container" border="0" width="368" cellspacing="4" cellpadding="1"  style="border: 1px solid #ccc;border-right:1px solid #999;border-bottom:1px solid #999;  padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
			<tr>
				<td id="dr_title" height="25"  width="358" colspan="2" class="biaoti">记录目前钞票数目</td>
				
			</tr>
		</table>
		</div>
	</form>
</body>
</html>

