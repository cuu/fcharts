<?php
session_start();
include_once "header.php";
//include_once "waibu.php";
include_once "cscheck.php";

include_once "function/conn.php";
include_once "function/md5.php"; // for crc32

// array(3) { ["add_money"]=> string(3) "123" ["add_username"]=> string(5) "admin" ["2B"]=> string(8) "ȷ����¼" }
var_dump($_POST);
$add_money    = trim( $_POST["add_money"]    );
$add_username = trim( $_POST["add_username"] ); 
if( strlen( trim ($add_money) ) < 1) 
{
	echo "<script language=javascript>alert('����д��Ʊ��Ŀ��');window.history.back();</script>";
	die(); 
}

if( strlen( trim ($add_username) ) < 1) 
{
	echo "<script language=javascript>alert('����д�����̱�ţ�');window.history.back();</script>";
	die(); 
}

	$handle = openConn();
	if($handle == NULL) die("openConn error".mysql_error());
	$sql = "insert into money (name,time,money) values('".$add_username."','".date("Y-m-d H:i:s")."',".intval($add_money).")";
	$result = mysql_query($sql,$handle);
    
	if($result !== false)
	{
		echo "��¼�ɹ�~";
		return;
	}else
	{
		 die("mysql_query failed".mysql_error());
	}


?>