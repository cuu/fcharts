<?php
	include "header.php";
	$_SESSION['yhgl']="";
	setcookie("yhgl","");
	setcookie("zz",""  );
	session_unset();
	echo "<script language=JavaScript>" .chr(13) . "alert('���Ѿ��ɹ��˳�����״̬��');top.location='login.php';</script>";
?>
