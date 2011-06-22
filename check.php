<?php
session_start();
include_once "header.php";
//include_once "cscheck.php"; // for dev
include_once "function/conn.php";
include_once "function/function.php";

include_once "function/xdownpage.php";

?>


<?php
        $action = getFormValue("action");
        if($action == "pcheck") proxy_check(); // 检查代理商 是否存在
	else if($action="ztchange") change_zt();
	else { echo "2"; return; }


function change_zt()
{
	$id = getFormValue("id");
	$sql = "select zt from admin where id=".$id;
	$handle = openConn();
	if($handle ==NULL) die( "mysql error". mysql_error() );
	$result = mysql_query($sql,$handle) or die("sql error".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_NUM);
	if( intval($row[0]) == 1)
	{
		$sql2 = "update admin set zt = 0 where id=".$id;
	}else if( intval($row[0]) == 0)
	{
		$sql2 = "update admin set zt = 1 where id=".$id;
	}
	$result = mysql_query($sql2,$handle) or die("2");
	echo "0";
	closeConn($handle);
	return;
}
function proxy_check()
{
        $name = getFormValue("pname");
        //var_dump($_GET);
        $sql = "select count(id) from admin where username ='".$name."'";
        $handle = openConn();
        if($handle ==NULL) die( "mysql error". mysql_error() );
        $result = mysql_query($sql,$handle);
        if( $result !== false)
        {   
                $row1 = mysql_fetch_array($result,MYSQL_NUM);
                if($row1[0] > 0){ closeConn($handle); echo "1"; return; }
                else { closeConn($handle); echo "0"; return; }
        }   
        else {
                closeConn($handle);
                echo "2";
                return;
        }   
}

?>
