<?php
include_once "function.php";

$Fy_Post = ""; $Fy_Get = "";$Fy_cook=""; $Fy_In="";
$Fy_In="exec|insert|select|delete|update|count|chr|truncate|char|declare|script|set";
$Fy_Inf = array();
$Fy_Xh=0;
$errFileName="/heike.txt";

$Fy_Inf = explode("|",$Fy_In);

function showErr()
{
	echo  "<br><br><center><table border=1 cellpadding=10 bordercolor=black bgcolor=#EEEEEE width=450>";
	echo "<tr><td align=center style=font:9pt Verdana>";
	echo "非法参数提交！";
	echo  "</td></tr></table></center>";
	die();
}

function write_to_file($fname,$str)
{
	$handle = fopen ($fname,"a");
	if(!$handle) { die("error fopen".$fname); }
	else
	{
		$str.="\n";
		fputs($handle,$str);
		fclose($handle);
	}

}

/// StopInjection  check $_GET $_COOKIE $_POST  $var must be array to passby 

function StopInjection($var)
{
	global $Fy_Xh;

	if( strcmp(gettype($var),"array") !=0) return;

	$request_form = http_build_query($var);
	if( $request_form  != "")
	{
		foreach ($var as $key => $Fy_Post)
		{
			for($Fy_Xh =0; $Fy_Xh < count($Fy_Inf); $Fy_Xh++)
			{
				if( strpos(lcase( $Fy_Post), $Fy_Inf[$Fy_Xh]) !=0)
				{
					$flyaway1=date("Y-m-d H:i:s").$_SERVER['REMOTE_ADDR'].",".$_SERVER['REQUEST_URI']."+'post'+".$key."=".$Fy_post;
					write_to_file($errFileName,$flyaway1);
					showErr();
				}
			}
		}
	}	
	
}


function openConn()
{
        // 如果my.cnf中启用了skip-networking,即表示拒绝tcp/ip的mysql连接,就要用sqlsockect来处理,这样更安全
	$Server = "127.0.0.1";
        $socket = "localhost:/Applications/xampp/xamppfiles/var/mysql/mysql.sock";
	//$sqlsocket = "localhost:/var/lib/mysql/mysql.sock";

	$SqlUser="root";
	$SqlPasswd="";
	$SqlDatabase = "golden";
	$link = mysql_connect($socket, $SqlUser, $SqlPasswd);
	if (!$link) {
		echo "<script>window.status=\"SQL Server 数据库连接失败 ".mysql_error()."\";</script>";
		return NULL;
	}

	else 
	{
		//mysql_set_charset("gb2312");// php >= 5.2.3
		mysql_query("SET NAMES 'gb2312'",$link);
		mysql_select_db($SqlDatabase,$link);
		return $link;
	}
	return NULL;

}

function closeConn($d)
{
	if($d !=NULL) mysql_close($d);
}














?>
