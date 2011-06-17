<?php
session_start();
include_once "header.php";
//include_once "waibu.php";
include_once "cscheck.php";

include_once "function/conn.php";
include_once "function/md5.php"; // for crc32

// array(3) { ["add_money"]=> string(3) "123" ["add_username"]=> string(5) "admin" ["2B"]=> string(8) "确定记录" }
//var_dump($_POST);
$add_money    = trim( $_POST["add_money"]    );
$add_username = trim( $_POST["add_username"] ); 
if( strlen( trim ($add_money) ) < 1) 
{
	echo "<script language=javascript>alert('请填写钞票数目！');window.history.back();</script>";
	die(); 
}

if( strlen( trim ($add_username) ) < 1) 
{
	echo "<script language=javascript>alert('请填写代理商编号！');window.history.back();</script>";
	die(); 
}

	$handle = openConn();
	if($handle == NULL) die("openConn error".mysql_error());
	$time = date("Y-m-d");
	$sql = "INSERT INTO money(name,time,money)   select '{$add_username}','{$time}',{$add_money} from DUAL  WHERE NOT EXISTS(SELECT * FROM money WHERE name='".$add_username."'  and time='".$time."' LIMIT 1)";


	$result = mysql_query($sql,$handle)  or die('Error in query $query.' .mysql_error());
	
	$num = mysql_affected_rows();
	
	if($num ==0) {
		// 有重复数据
		echo show_inf("已经记录过,今天,当成更新");
		$sql = "update money set money={$add_money} where name='{$add_username}' and time='{$time}'";
		$result = mysql_query($sql,$handle)  or die('Error in query $query.' .mysql_error());
	}
	else 
	{
		//插入成功
		echo show_inf("记录成功~");
	}
	
	closeConn($handle);

?>