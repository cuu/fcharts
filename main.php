<?php
include_once "header.php";
include_once "cscheck.php";

?>

<html>
<head>
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="images/css.css" type="text/css" rel="stylesheet"/>
<title>后台管理</title>
<?php
include "jq_ui.php";
?>
</head>

<frameset FRAMEBORDER=NO  rows="38,*"  cols="*"  framespacing="0"   >
  <frame src="left.php" id="leftFrame" name="leftFrame" scrolling="no" noresize>
  <frame src="right.php" id="RSframe" name="mainFrame">
</frameset>
 <NOFRAMES></NOFRAMES>

</html>
