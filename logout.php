<?php
	include "header.php";
	$_SESSION['yhgl']="";
	setcookie("yhgl","");
	setcookie("zz",""  );
	session_unset();
	echo "<script language=JavaScript>" .chr(13) . "alert('您已经成功退出管理状态！');top.location='login.php';</script>";
?>
